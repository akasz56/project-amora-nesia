<?php

use App\Http\Controllers\ShopController;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::prefix('u/')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::view('/register-shop', 'auth.register-shop')
            ->name('shop.register');
        Route::post('/register-shop', [ShopController::class, 'register'])
            ->name('shop.register');
    });

Route::prefix('s/')
    ->middleware(['auth', 'verified', 'hasStore'])
    ->name('shop.')
    ->group(function () {
        Route::get('/dashboard', [ShopController::class, 'dashboardView'])
            ->name('dashboard');
        Route::get('/orders', [ShopController::class, 'orderListView'])
            ->name('orders');
        Route::get('orders/{uuid}', [ShopController::class, 'orderView'])
            ->name('orderUUID');
        Route::post('orders/{uuid}/actions', [ShopController::class, 'orderActions'])
            ->name('orderAction');
        Route::get('/sales', [ShopController::class, 'salesView'])
            ->name('sales');
        Route::get('/about', [ShopController::class, 'aboutView'])
            ->name('about');
        Route::get('/settings', [ShopController::class, 'shopSettings'])
            ->name('settings');

        Route::prefix('products/')
            ->name('product.')
            ->group(function () {
                Route::get('/add', [ShopController::class, 'createProductView'])
                    ->name('add');

                Route::post('/add', [ShopController::class, 'createProduct'])
                    ->name('add.post');

                Route::post('/update', [ShopController::class, 'updateProduct'])
                    ->name('update');

                Route::post('/delete', [ShopController::class, 'deleteProduct'])
                    ->name('delete');

                Route::get('', [ShopController::class, 'readProductList'])
                    ->name('list');

                Route::get('/{id}', [ShopController::class, 'readProductByID'])
                    ->name('byID');
            });

        Route::prefix('products/specifications/')
            ->name('product.spec.')
            ->group(function () {
                Route::post('add', [ShopController::class, 'createProductSpec'])
                    ->name('add');
            });
    });
