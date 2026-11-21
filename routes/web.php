<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/menu', [HomeController::class, 'menu'])
    ->name('menu');

Route::get('/category/{id}', [HomeController::class, 'category'])
    ->name('category.filter');

// Meal Details (Public)
Route::get('/meals/{meal}', [MealController::class, 'show'])
    ->name('meals.show');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard Redirect
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('customer.dashboard');
    })->name('dashboard');

    // Customer Dashboard
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update', [CartController::class, 'update'])
        ->name('cart.update');

    Route::post('/cart/remove', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::post('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');

    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', function () {
        return view('checkout.index');
    })->name('checkout.index');

    Route::post('/checkout', [OrderController::class, 'store'])
        ->name('checkout.store');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->middleware('admin')
        ->group(function () {

            // Admin Dashboard
            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');

            // Categories Management
            Route::resource('categories', CategoryController::class)
                ->except(['show']);

            // Meals Management
            Route::resource('meals', MealController::class)
                ->except(['show']);

            // Orders Management
            Route::get('/orders', [OrderController::class, 'adminIndex'])
                ->name('admin.orders.index');

            Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
                ->name('admin.orders.updateStatus');
        });
});
