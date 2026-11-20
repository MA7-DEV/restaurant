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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_available' => 'sometimes|boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('meals', 'public');
        }

        $validated['is_available'] = $request->has('is_available') ? true : false;

        Meal::create($validated);

        return redirect()->route('meals.index')
            ->with('success', 'Meal created successfully.');
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_available' => 'sometimes|boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($meal->image) {
                Storage::disk('public')->delete($meal->image);
            }
            $validated['image'] = $request->file('image')->store('meals', 'public');
        }

        $validated['is_available'] = $request->has('is_available') ? true : false;

        $meal->update($validated);

        return redirect()->route('meals.index')
            ->with('success', 'Meal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        if ($meal->image) {
            Storage::disk('public')->delete($meal->image);
        }
        $meal->delete();

        return redirect()->route('meals.index')
            ->with('success', 'Meal deleted successfully.');
    }
}