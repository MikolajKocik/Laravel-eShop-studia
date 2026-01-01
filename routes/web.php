<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    $latestProducts = Product::with('category')->latest()->take(4)->get();
    return view('welcome', compact('latestProducts'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// user routes
Route::get('my/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::resource('products', ProductController::class)->only(['index', 'show'])->middleware('auth');
Route::resource('products', ProductController::class)->except(['index', 'show'])->middleware(['auth', 'admin']);
Route::resource('categories', CategoryController::class)->middleware('auth');

// Cart Routes
Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('add-to-cart/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::patch('update-cart', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('remove-from-cart', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// auth middleware route 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/order', [OrderController::class, 'store'])->name('orders.store');
});

require __DIR__.'/auth.php';
