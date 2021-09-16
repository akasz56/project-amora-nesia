<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::view('/', 'home')
    ->name('home');
Route::get('/home', function () {
    return redirect('/');
});
Route::view('/categories', 'categories')
    ->name('categories');

require __DIR__ . '/auth.php';

// User
Route::prefix('u/')->middleware(['auth', 'verified'])
    ->name('user.')
    ->group(function () {
        Route::view('/dashboard', 'user.dashboard')
            ->name('dashboard');
        Route::get('/wishlist', [UserController::class, 'wishlist'])
            ->name('wishlist');
        Route::get('/cart', [UserController::class, 'cartView'])
            ->name('cart');
        Route::get('/history', [UserController::class, 'history'])
            ->name('history');
        Route::get('/account-settings', [UserController::class, 'accSettings'])
            ->name('account-settings');
        Route::get('/notification-settings', [UserController::class, 'notifSettings'])
            ->name('notification-settings');
    });

// Shop
Route::prefix('u/')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::view('/u/register-shop', 'auth.register-shop')
            ->name('shop.register');
        Route::post('/u/register-shop', [ShopController::class, 'register'])
            ->name('shop.register');
    });

Route::prefix('s/')->middleware(['auth', 'verified', 'hasStore'])->name('shop.')->group(function () {
    Route::get('/dashboard', [ShopController::class, 'dashboardView'])
        ->name('dashboard');
    Route::get('/orders', [ShopController::class, 'ordersView'])
        ->name('orders');
    Route::get('/sales', [ShopController::class, 'salesView'])
        ->name('sales');
    Route::get('/about', [ShopController::class, 'aboutView'])
        ->name('about');
    Route::get('/shop-settings', [ShopController::class, 'shopSettings'])
        ->name('shop-settings');

    Route::get('/products', [ShopController::class, 'productlistView'])
        ->name('product-list');
    Route::get('/products/add', [ShopController::class, 'createProductView'])
        ->name('product-add');
    Route::post('/products/add', [ShopController::class, 'createProduct'])
        ->name('product-add.post');
    Route::post('/products/update', [ShopController::class, 'updateProduct'])
        ->name('product-update');
    Route::get('/products/{id}', [ShopController::class, 'readProduct'])
        ->name('product');

    Route::post('/products-spec/add', [ShopController::class, 'createProductSpec'])
        ->name('product-spec-add.post');
});
