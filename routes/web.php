<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{product}', [FrontController::class, 'show'])->name('front.product.details');
Route::get('/products/search', [FrontController::class, 'search'])->name('front.product.search');
Route::get('/products/category/{category}', [FrontController::class, 'category'])->name('front.product.category');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/comments', CommentController::class)->middleware('role:buyer');

    Route::resource('/cart', CartController::class)->middleware('role:buyer');
    Route::post('/cart/add/{productId}', [CartController::class, 'store'])->middleware('role:buyer')->name('cart.store');

    Route::resource('/product-transactions', ProductTransactionController::class)->middleware('role:owner|buyer');
    Route::put('/product-transactions/{productTransaction}/cancel', [ProductTransactionController::class, 'cancel'])->middleware('role:owner')->name('product-transactions.cancel');
    Route::get('/product-transactions/{productTransaction}/comment', [ProductTransactionController::class, 'comment'])->middleware('role:buyer')->name('product-transactions.comment');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class)->middleware('role:owner');
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
    });
});

require __DIR__ . '/auth.php';
