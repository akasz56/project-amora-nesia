<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::prefix('u/')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::view('/u/register-shop', 'auth.register-shop')
            ->name('shop.register');
        Route::post('/u/register-shop', [ShopController::class, 'register'])
            ->name('shop.register');
    });

Route::prefix('s/')
    ->middleware(['auth', 'verified', 'hasStore'])
    ->name('shop.')
    ->group(function () {
        Route::get('/dashboard', [ShopController::class, 'dashboardView'])
            ->name('dashboard');
        Route::get('/orders', [ShopController::class, 'ordersView'])
            ->name('orders');
        Route::get('/sales', [ShopController::class, 'salesView'])
            ->name('sales');
        Route::get('/about', [ShopController::class, 'aboutView'])
            ->name('about');
        Route::get('/settings', [ShopController::class, 'shopSettings'])
            ->name('settings');

        Route::prefix('products/')
            ->name('product.')
            ->group(function () {
                Route::get('', [ShopController::class, 'productlistView'])
                    ->name('list');

                Route::get('/{prodID}', [ShopController::class, 'readProduct'])
                    ->name('byID');

                Route::get('/add', [ShopController::class, 'createProductView'])
                    ->name('add');

                Route::post('/add', [ShopController::class, 'createProduct'])
                    ->name('add.post');

                Route::post('/update', [ShopController::class, 'updateProduct'])
                    ->name('update');
            });

        Route::prefix('product/')->group(function () {
            Route::post('/products-spec/add', [ShopController::class, 'createProductSpec'])
                ->name('product-spec-add.post');
        });
    });
