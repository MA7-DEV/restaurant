<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Meal;

class HomeController extends Controller
{
    public function index()
    {
        // إذا كان المستخدم مسجل دخول
        if (auth()->check()) {
            // إذا كان أدمن، إذهب للإدارة
            if ($this->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            // إذا كان عميل عادي، إذهب للواجهة الخاصة به
            return redirect()->route('customer.dashboard');
        }

        // إذا كان زائر عادي، عرض الصفحة الرئيسية
        return view('welcome');
    }

    public function menu()
    {
        $categories = Category::withCount('meals')->get();
        $meals = Meal::with('category')->where('is_available', true)->get();

        return view('menu', compact('categories', 'meals'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $meals = Meal::where('category_id', $id)
                    ->where('is_available', true)
                    ->with('category')
                    ->get();

        return view('menu', compact('meals', 'categories'));
    }

    // دالة للتحقق إذا كان المستخدم أدمن
    private function isAdmin()
    {
        $user = auth()->user();

        // طريقة 1: التحقق بالإيميل
        $adminEmails = ['admin@restaurant.com', 'admin@laravel.com'];
        if (in_array($user->email, $adminEmails)) {
            return true;
        }

        // طريقة 2: التحقق بعمود is_admin
        if (isset($user->is_admin) && $user->is_admin === true) {
            return true;
        }

        return false;
    }
}