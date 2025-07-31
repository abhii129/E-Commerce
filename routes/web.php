<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\Category;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\FooterSectionController;



// Home route
Route::get('/', [CustomerController::class, 'index'])->name('customer.products.index'); // Correct route for customer product details page


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
        // Admin routes for categories, subcategories, and products management
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    });

    // Customer Routes
    Route::get('/customer/products', [CustomerController::class, 'index'])->name('customer.products.index'); // Correct route for customer products listing page
    Route::get('/customer/products/{id}', [CustomerController::class, 'show'])->name('customer.products.show'); // Correct route for customer product details page
    
    // In routes/web.php
    Route::get('/customer/products/{id}', [CustomerController::class, 'show'])->name('customer.products.show');

    
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin', function () {
        return view('admin.dashboard');
            });
        });

        //Footer
  

    Route::get('/admin/footer/{section_key}/edit', [FooterSectionController::class, 'edit'])->name('footer.edit');
    Route::post('/admin/footer/{section_key}/update', [FooterSectionController::class, 'update'])->name('footer.update');
    

Route::middleware(['auth', 'is_admin'])->group(function () {
    // Edit footer sections form:
    Route::get('/admin/footer/{section_key}/edit', [FooterSectionController::class, 'edit'])
        ->name('admin.footer.edit');

    // Update footer section submission:
    Route::post('/admin/footer/{section_key}/update', [FooterSectionController::class, 'update'])
        ->name('footer.update');
});


Route::get('/footer/{section_key}', [CustomerController::class, 'showFooterSection'])
    ->name('footer.show');


    Route::get('/footer/{section}', [CustomerController::class, 'showFooterSection'])
        ->name('customer.footer');
    