<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\Category;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route for authenticated users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Load authentication routes (login, registration)
require __DIR__.'/auth.php';


Route::middleware(['auth', 'is_admin'])->group(function () {
    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');


    // Product Routes
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


});
