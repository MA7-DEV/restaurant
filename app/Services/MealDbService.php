<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MealDbService
{
    protected $baseUrl = 'https://www.themealdb.com/api/json/v1/1';

    /**
     * جلب أكلات حسب التصنيف
     */
    public function getMealsByCategory($category = 'Seafood')
    {
        $cacheKey = 'mealdb_category_' . strtolower($category);

        return Cache::remember($cacheKey, 3600, function () use ($category) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/filter.php?c={$category}");

            if ($response->successful() && isset($response->json()['meals'])) {
                return $response->json()['meals'];
            }

            return [];
        });
    }

    /**
     * جلب تفاصيل أكلة معينة بالـ ID
     */
    public function getMealDetails($id)
    {
        return Cache::remember('mealdb_meal_' . $id, 3600, function () use ($id) {
            $response = Http::timeout(10)->get("{$this->baseUrl}/lookup.php?i={$id}");

            if ($response->successful() && isset($response->json()['meals'][0])) {
                return $response->json()['meals'][0];
            }

            return null;
        });
    }

    /**
     * جلب قائمة التصنيفات المتاحة
     */
    public function getCategories()
    {
        return Cache::remember('mealdb_categories', 86400, function () {
            $response = Http::timeout(10)->get("{$this->baseUrl}/categories.php");

            if ($response->successful() && isset($response->json()['categories'])) {
                return $response->json()['categories'];
            }

            return [];
        });
    }
}