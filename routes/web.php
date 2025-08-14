<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FooterSectionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductAttributeController;


/*
|--------------------------------------------------------------------------
| Public / Customer Routes
|--------------------------------------------------------------------------
*/

// Home -> customer product listing
Route::get('/', [CustomerController::class, 'index'])->name('customer.products.index');

// Customer product listing & details
Route::get('/customer/products', [CustomerController::class, 'index'])->name('customer.products.index');
Route::get('/customer/products/{id}', [CustomerController::class, 'show'])->name('customer.products.show');

// Public footer section (single, consistent route)
Route::get('/footer/{section_key}', [CustomerController::class, 'showFooterSection'])->name('footer.show');

// Category filter for products
Route::get('/category/{category}', [ProductController::class, 'categoryProducts'])->name('category.products');

/*
|--------------------------------------------------------------------------
| Auth Scaffolding
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Subcategories
    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Admin dashboard (optional landing)
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Footer sections (admin edit/update only here, no duplicates)
    Route::get('/footer/{section_key}/edit', [FooterSectionController::class, 'edit'])->name('footer.edit');
    Route::post('/footer/{section_key}/update', [FooterSectionController::class, 'update'])->name('footer.update');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Addresses (admin view)
    Route::get('/addresses', [AddressController::class, 'adminIndex'])->name('addresses.index');

    // Orders (admin)
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::patch('/products/{product}/availability', [ProductController::class, 'updateAvailability'])
    ->name('products.updateAvailability');

});

/*
|--------------------------------------------------------------------------
| Customer: Cart & Checkout (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{product}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.show');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('cart.checkout-index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Addresses (customer)
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::post('/addresses/{address}/default', [AddressController::class, 'setDefault'])->name('addresses.setDefault');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
});


// Public footer section (match footer.blade.php)
Route::get('/footer/{section}', [CustomerController::class, 'showFooterSection'])
    ->name('customer.footer');

    // If you use Route::resource() for ProductController (recommended):
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
    // ...other admin routes
});


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // ...other product admin routes
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    // ...
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    // ...
});

// routes/web.php
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');



Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    // Route for managing product attributes
    Route::resource('product-attributes', ProductAttributeController::class);

    // Route for fetching subcategories dynamically
    Route::get('/subcategories/getByCategory/{categoryId}', [ProductAttributeController::class, 'getSubcategoriesByCategory']);
});