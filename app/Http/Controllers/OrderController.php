<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * حفظ الطلب الجديد (Checkout)
     */
    public function store(Request $request)
    {
        // 1. منع الأدمن من عمل أوردر
        if (auth()->user()->isAdmin()) {
            return back()->with('error', 'Admin accounts cannot place orders.');
        }

        // 2. التحقق من البيانات
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // 3. جلب السلة من الـ Session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        try {
            DB::beginTransaction();

            $totalPrice = 0;

            // 4. إنشاء الأوردر
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'address' => $request->address,
                'phone' => $request->phone,
                'total_price' => 0, // هنحدثها بعدين
            ]);

            // 5. إضافة الأصناف وحساب الإجمالي
            foreach ($cart as $id => $item) {
                $meal = Meal::findOrFail($id);
                $totalPrice += $meal->price * $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'meal_id' => $meal->id,
                    'quantity' => $item['quantity'],
                    'price' => $meal->price,
                ]);
            }

            // 6. تحديث إجمالي الأوردر
            $order->update(['total_price' => $totalPrice]);

            // 7. ✅ تفريغ السلة من الـ Session
            session()->forget('cart');

            DB::commit();

            // 8. التوجيه لصفحة الداشبورد مع رسالة نجاح
            return redirect()->route('customer.dashboard')->with('success', 'Order placed successfully! Your cart is now empty.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
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
            'status' => 'required|in:pending,preparing,delivering,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully!');
    }
}