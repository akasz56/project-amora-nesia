<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/shop.php';


/* -------------------------------------
Test Routes
------------------------------------- */

/* -------------------------------------
Main Routes
------------------------------------- */
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/about', [PublicController::class, 'aboutView'])->name('about');
Route::get('/categories', [PublicController::class, 'categoriesView'])->name('categories');
Route::get('/categories/{key}', [PublicController::class, 'categoryView'])->name('category');
Route::get('/catalog', [PublicController::class, 'catalogView'])->name('catalog');


/* -------------------------------------
Orders Routes
------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/order/submit', [OrderController::class, 'submitOrderOrCart'])->name('product.submit');
    Route::post('/order/submit-cart', [OrderController::class, 'confirmOrderfromCart'])->name('cart.submit');
    Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::post('/order/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');
    Route::post('/order/update', [OrderController::class, 'updateOrder'])->name('order.update');
    Route::get('/order/{uuid}', [OrderController::class, 'orderActions'])->name('order.actions');
});


/* -------------------------------------
Payment Routes
------------------------------------- */
Route::post('/payments/notification', [PaymentController::class, 'notification']);
Route::get('/payments/completed', [PaymentController::class, 'completed']);
Route::get('/payments/unfinish', [PaymentController::class, 'unfinish']);
Route::get('/payments/failed', [PaymentController::class, 'failed']);


/* -------------------------------------
Shop n Product Routes
------------------------------------- */
Route::get('/{shopURL}', [PublicController::class, 'shopView'])->name('shop');
Route::get('/{shopURL}/{prodName}', [PublicController::class, 'productView'])->name('product');
