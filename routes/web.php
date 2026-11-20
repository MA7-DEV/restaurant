
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.filter');

// Authentication Routes
require __DIR__.'/auth.php';

// Authenticated Routes
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

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')
        ->middleware('admin')
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');

            Route::get('/stats', function () {
                return view('admin.stats');
            })->name('admin.stats');

            // Categories Management
            Route::resource('categories', CategoryController::class)
                ->except(['show']);

            // Meals Management
            Route::resource('meals', MealController::class)
                ->except(['show']);
        });
});
