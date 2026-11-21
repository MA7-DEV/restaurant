<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * حفظ الطلب الجديد (Checkout)
     */

    /**
     * Save a new order (Checkout).
     */
    public function store(Request $request)
    {
        // Prevent admin accounts from placing orders.
        if (auth()->user()->isAdmin()) {
            return back()->with('error', 'Admin accounts cannot place orders.');
        }

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart) || ! is_array($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        try {
            $order = DB::transaction(function () use ($cart, $validated) {
                $mealIds = [];

                // Validate cart structure and quantities.
                foreach ($cart as $id => $item) {
                    if (
                        ! is_numeric($id) ||
                        ! is_array($item) ||
                        ! isset($item['quantity']) ||
                        filter_var($item['quantity'], FILTER_VALIDATE_INT) === false ||
                        (int) $item['quantity'] < 1 ||
                        (int) $item['quantity'] > 99
                    ) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'cart' => 'Your cart contains invalid quantities. Please review your cart.',
                        ]);
                    }

                    $mealIds[] = (int) $id;
                }

                // Lock meal records while checking availability and prices.
                $meals = Meal::whereIn('id', $mealIds)
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                // Make sure every meal still exists and is available.
                foreach ($cart as $id => $item) {
                    $meal = $meals->get((int) $id);

                    if (! $meal || ! $meal->is_available) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'cart' => 'One or more meals are unavailable. Please review your cart.',
                        ]);
                    }
                }

                $totalPrice = 0;

                // Calculate the total using database prices.
                foreach ($cart as $id => $item) {
                    $meal = $meals->get((int) $id);
                    $quantity = (int) $item['quantity'];

                    $totalPrice += (float) $meal->price * $quantity;
                }

                // Create the order.
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'status' => 'pending',
                    'address' => $validated['address'],
                    'phone' => $validated['phone'],
                    'total_price' => $totalPrice,
                ]);

                // Create order items using trusted database data.
                foreach ($cart as $id => $item) {
                    $meal = $meals->get((int) $id);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'meal_id' => $meal->id,
                        'quantity' => (int) $item['quantity'],
                        'price' => $meal->price,
                    ]);
                }

                return $order;
            });

            session()->forget('cart');

            return redirect()
                ->route('customer.dashboard')
                ->with('success', 'Order placed successfully! Your cart is now empty.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Something went wrong while placing your order. Please try again.'
            );
        }
    }

    /**
     * عرض الطلبات في لوحة تحكم الأدمن
     */
    public function adminIndex()
    {
        $orders = Order::with(['user', 'items.meal'])->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * تحديث حالة الطلب
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,delivering,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully!');
    }
}
