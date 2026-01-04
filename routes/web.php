<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

// products 
Route::get('/', function () {
    $latestProducts = Product::with('category')
        ->latest()
        ->take(5)
        ->get();

    return view('welcome', compact('latestProducts'));
});
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('products', [ProductController::class, 'index'])->name('products.index');

// contact
Route::get('contact', function () {
    return view('contact');
})->name('contact');

// USER MIDDLEWARE
Route::middleware('auth')->group(function () {
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // order
    Route::get('my/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

    // user panel
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // categories 
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

    // cart
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('update-cart', [CartController::class, 'update'])->name('cart.update');
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

    Route::middleware('admin')->group(function () {
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
        Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');
    });
});

require __DIR__ . '/auth.php';