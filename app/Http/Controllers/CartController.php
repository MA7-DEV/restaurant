<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // عرض السلة
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    // إضافة منتج للسلة
    public function add(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $meal = Meal::findOrFail($request->meal_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$meal->id])) {
            $cart[$meal->id]['quantity'] += $request->quantity;
        } else {
            $cart[$meal->id] = [
                'id' => $meal->id,
                'name' => $meal->name,
                'price' => $meal->price,
                'image' => $meal->image_url,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart!',
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    // تحديث كمية منتج
    public function update(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->meal_id])) {
            if ($request->quantity <= 0) {
                unset($cart[$request->meal_id]);
            } else {
                $cart[$request->meal_id]['quantity'] = $request->quantity;
            }
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    // حذف منتج من السلة
    public function remove(Request $request)
    {
        $request->validate(['meal_id' => 'required']);

        $cart = session()->get('cart', []);
        if (isset($cart[$request->meal_id])) {
            unset($cart[$request->meal_id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    // تفريغ السلة
    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }
}