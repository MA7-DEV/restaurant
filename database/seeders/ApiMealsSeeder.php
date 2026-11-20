<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\MealDbService;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Support\Str;

class ApiMealsSeeder extends Seeder
{
    public function run(): void
    {
        $mealDb = new MealDbService();

        // هنشوف التصنيفات اللي عايزين نجيب منها
        $categoriesToImport = ['Beef', 'Chicken', 'Seafood', 'Dessert', 'Pasta'];

        foreach ($categoriesToImport as $categoryName) {
            // 1. نجيب الأكلات من الـ API
            $apiMeals = $mealDb->getMealsByCategory($categoryName);

            if (empty($apiMeals)) continue;

            // 2. نعمل أو نجيب التصنيف في الداتابيز
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );

            // 3. نلف على الأكلات ونحفظها (هناخد أول 4 أكلات من كل تصنيف عشان الداتابيز متتملاش)
            $mealsToImport = array_slice($apiMeals, 0, 4);

            foreach ($mealsToImport as $apiMeal) {
                // نجيب تفاصيل الأكلة عشان نعرف السعر والوصف
                $details = $mealDb->getMealDetails($apiMeal['idMeal']);

                if (!$details) continue;

                // نحفظ الأكلة (لو موجودة قبل كده، منعملهاش تاني)
                Meal::firstOrCreate(
                    ['name' => $details['strMeal']],
                    [
                        'description' => Str::limit($details['strInstructions'], 150),
                        'price' => rand(15, 50) + 0.99, // سعر عشوائي
                        'category_id' => $category->id,
                        'image' => null, // مفيش صورة محلية، ممكن نحط رابط الصورة من الـ API
                        'is_available' => true,
                    ]
                );
            }
        }
    }
}