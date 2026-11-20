<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return auth()->user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('customer.dashboard');
        }
        return view('welcome');
    }

   public function menu()
{
    // جلب الأقسام
    $categories = \App\Models\Category::withCount('meals')->get();

    // الفلترة حسب القسم
    $categoryId = request('category');

    if ($categoryId) {
        $meals = \App\Models\Meal::with('category')
            ->where('is_available', true)
            ->where('category_id', $categoryId)
            ->get();
    } else {
        $meals = \App\Models\Meal::with('category')
            ->where('is_available', true)
            ->get();
    }

    return view('menu', compact('categories', 'meals'));
}
}