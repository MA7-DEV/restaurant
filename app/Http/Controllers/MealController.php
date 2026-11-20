<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // تأكد من استخدام paginate() وليس get() أو all()
        $meals = Meal::with('category')->latest()->paginate(10);
        $categories = Category::all();
        $averagePrice = Meal::avg('price');

        return view('meals.index', compact('meals', 'categories', 'averagePrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('meals.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // أضف هذا لرؤية البيانات المرسلة
        Log::info('Store Request Data:', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01', // تغيير من min:0 إلى min:0.01
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_available' => 'sometimes|boolean' // تغيير من 'boolean' إلى 'sometimes|boolean'
        ]);

        Log::info('Validated Data:', $validated);

        // معالجة الصورة
        if ($request->hasFile('image')) {
            try {
                $validated['image'] = $request->file('image')->store('meals', 'public');
                Log::info('Image uploaded to:', ['path' => $validated['image']]);
            } catch (\Exception $e) {
                Log::error('Image upload failed:', ['error' => $e->getMessage()]);
                return back()->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()])
                             ->withInput();
            }
        }

        // معالجة حالة is_available
        $validated['is_available'] = $request->has('is_available') ? true : false;
        Log::info('is_available set to:', ['value' => $validated['is_available']]);

        try {
            $meal = Meal::create($validated);
            Log::info('Meal created successfully:', ['meal_id' => $meal->id, 'meal_name' => $meal->name]);

            return redirect()->route('meals.index')
                ->with('success', 'Meal "' . $meal->name . '" created successfully.');

        } catch (\Exception $e) {
            Log::error('Meal creation failed:', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            // حذف الصورة إذا تم رفعها وفشل الإنشاء
            if (isset($validated['image'])) {
                try {
                    Storage::disk('public')->delete($validated['image']);
                } catch (\Exception $deleteException) {
                    Log::error('Failed to delete uploaded image:', ['error' => $deleteException->getMessage()]);
                }
            }

            return back()->withErrors(['error' => 'Failed to create meal: ' . $e->getMessage()])
                         ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        $meal->load('category');
        return view('meals.show', compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        $categories = Category::all();
        return view('meals.edit', compact('meal', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meal $meal)
    {
        Log::info('Update Request Data for meal ' . $meal->id . ':', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_available' => 'sometimes|boolean'
        ]);

        Log::info('Validated Update Data:', $validated);

        // معالجة الصورة الجديدة
        if ($request->hasFile('image')) {
            try {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($meal->image) {
                    Storage::disk('public')->delete($meal->image);
                    Log::info('Old image deleted:', ['path' => $meal->image]);
                }

                $validated['image'] = $request->file('image')->store('meals', 'public');
                Log::info('New image uploaded:', ['path' => $validated['image']]);
            } catch (\Exception $e) {
                Log::error('Image update failed:', ['error' => $e->getMessage()]);
                return back()->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()])
                             ->withInput();
            }
        }

        // معالجة حالة is_available
        $validated['is_available'] = $request->has('is_available') ? true : false;
        Log::info('is_available updated to:', ['value' => $validated['is_available']]);

        try {
            $meal->update($validated);
            Log::info('Meal updated successfully:', ['meal_id' => $meal->id, 'meal_name' => $meal->name]);

            return redirect()->route('meals.index')
                ->with('success', 'Meal "' . $meal->name . '" updated successfully.');

        } catch (\Exception $e) {
            Log::error('Meal update failed:', [
                'error' => $e->getMessage(),
                'meal_id' => $meal->id,
                'data' => $validated
            ]);

            // حذف الصورة الجديدة إذا تم رفعها وفشل التحديث
            if (isset($validated['image']) && $request->hasFile('image')) {
                try {
                    Storage::disk('public')->delete($validated['image']);
                } catch (\Exception $deleteException) {
                    Log::error('Failed to delete uploaded image:', ['error' => $deleteException->getMessage()]);
                }
            }

            return back()->withErrors(['error' => 'Failed to update meal: ' . $e->getMessage()])
                         ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        Log::info('Deleting meal:', ['meal_id' => $meal->id, 'meal_name' => $meal->name]);

        try {
            // Delete image if exists
            if ($meal->image) {
                try {
                    Storage::disk('public')->delete($meal->image);
                    Log::info('Meal image deleted:', ['path' => $meal->image]);
                } catch (\Exception $e) {
                    Log::error('Failed to delete meal image:', ['error' => $e->getMessage()]);
                }
            }

            $mealName = $meal->name;
            $meal->delete();

            Log::info('Meal deleted successfully:', ['meal_name' => $mealName]);

            return redirect()->route('meals.index')
                ->with('success', 'Meal "' . $mealName . '" deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Meal deletion failed:', [
                'error' => $e->getMessage(),
                'meal_id' => $meal->id
            ]);

            return redirect()->route('meals.index')
                ->with('error', 'Failed to delete meal: ' . $e->getMessage());
        }
    }
}