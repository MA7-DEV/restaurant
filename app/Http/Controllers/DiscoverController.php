<?php

namespace App\Http\Controllers;

use App\Services\MealDbService;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscoverController extends Controller
{
    protected $mealDb;

    public function __construct(MealDbService $mealDb)
    {
        $this->mealDb = $mealDb;
    }

    public function index(Request $request)
    {
        $categories = $this->mealDb->getCategories();
        $selectedCategory = $request->query('category', 'Seafood');

        // جلب الأكلات حسب التصنيف المختار
        $meals = $this->mealDb->getMealsByCategory($selectedCategory);

        return view('discover.index', compact('categories', 'meals', 'selectedCategory'));
    }

    /**
     * إضافة أكلة من TheMealDB إلى قاعدة بياناتنا (للأدمن فقط)
     */
    public function import(Request $request)
    {
        // التحقق من صلاحية الأدمن
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $request->validate(['meal_id' => 'required|string']);

        $mealData = $this->mealDb->getMealDetails($request->meal_id);

        if (!$mealData) {
            return back()->with('error', 'Could not fetch meal details.');
        }

        // البحث عن التصنيف أو إنشاؤه
        $category = Category::firstOrCreate(
            ['name' => $mealData['strCategory'] ?? 'Imported'],
            ['slug' => Str::slug($mealData['strCategory'] ?? 'imported')]
        );

        // إنشاء الأكلة في قاعدة بياناتنا
        Meal::create([
            'name' => $mealData['strMeal'],
            'description' => $mealData['strInstructions'] ?? 'No description available.',
            'price' => rand(10, 50) + 0.99, // سعر عشوائي للتجربة
            'category_id' => $category->id,
            'image' => null,
            'is_available' => true,
        ]);

        return redirect()->route('meals.index')->with('success', 'Meal imported successfully from TheMealDB!');
    }
}