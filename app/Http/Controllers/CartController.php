<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private const MAX_QUANTITY = 99;

    /**
     * Display the cart and refresh item data from the database.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return view('cart.index', [
                'cart' => [],
                'total' => 0,
            ]);
        }

        $meals = Meal::whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        foreach ($cart as $id => $item) {
            $meal = $meals->get($id);

            // Remove meals that no longer exist.
            if (!$meal) {
                unset($cart[$id]);
                continue;
            }

            // Refresh meal data from the database.
            $cart[$id]['id'] = $meal->id;
            $cart[$id]['name'] = $meal->name;
            $cart[$id]['price'] = $meal->price;
            $cart[$id]['image'] = $meal->image_url;
            $cart[$id]['is_available'] = $meal->is_available;
        }

        session()->put('cart', $cart);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a meal to the cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'meal_id' => 'required|integer|exists:meals,id',
            'quantity' => 'required|integer|min:1|max:' . self::MAX_QUANTITY,
        ]);

        $meal = Meal::findOrFail($validated['meal_id']);

        if (!$meal->is_available) {
            return response()->json([
                'success' => false,
                'message' => 'This meal is currently unavailable.',
            ], 422);
        }

        $cart = session()->get('cart', []);
        $mealId = $meal->id;
        $quantity = (int) $validated['quantity'];

        $currentQuantity = isset($cart[$mealId])
            ? (int) $cart[$mealId]['quantity']
            : 0;

        if (($currentQuantity + $quantity) > self::MAX_QUANTITY) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum quantity per meal is ' . self::MAX_QUANTITY . '.',
            ], 422);
        }

        $cart[$mealId] = [
            'id' => $meal->id,
            'name' => $meal->name,
            'price' => $meal->price,
            'image' => $meal->image_url,
            'quantity' => $currentQuantity + $quantity,
            'is_available' => $meal->is_available,
        ];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart!',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    /**
     * Update the quantity of a cart item.
     * Quantity 0 removes the item.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'meal_id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:0|max:' . self::MAX_QUANTITY,
        ]);

        $cart = session()->get('cart', []);
        $mealId = (int) $validated['meal_id'];
        $quantity = (int) $validated['quantity'];

        if (!isset($cart[$mealId])) {
            return response()->json([
                'success' => false,
                'message' => 'This item is not in your cart.',
            ], 404);
        }

        // Quantity 0 means remove the item.
        if ($quantity === 0) {
            unset($cart[$mealId]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        $meal = Meal::find($mealId);

        // Remove deleted meals from the cart.
        if (!$meal) {
            unset($cart[$mealId]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'This meal no longer exists and was removed from your cart.',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        if (!$meal->is_available) {
            return response()->json([
                'success' => false,
                'message' => 'This meal is currently unavailable.',
            ], 422);
        }

        // Refresh the item using current database information.
        $cart[$mealId] = [
            'id' => $meal->id,
            'name' => $meal->name,
            'price' => $meal->price,
            'image' => $meal->image_url,
            'quantity' => $quantity,
            'is_available' => $meal->is_available,
        ];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'meal_id' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $mealId = (int) $validated['meal_id'];

        unset($cart[$mealId]);

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    /**
     * Clear all cart items.
     */
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully.',
            'cart_count' => 0,
        ]);
    }
}
