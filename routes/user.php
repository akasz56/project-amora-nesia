<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('u/')->middleware(['auth', 'verified'])
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboardView'])
            ->name('dashboard');
        Route::get('/wishlist', [UserController::class, 'wishlistView'])
            ->name('wishlist');
        Route::get('/cart', [UserController::class, 'cartView'])
            ->name('cart');
        Route::get('/history', [UserController::class, 'historyView'])
            ->name('history');
        Route::get('/account-settings', [UserController::class, 'accSettings'])
            ->name('account-settings');
        Route::get('/notification-settings', [UserController::class, 'notifSettings'])
            ->name('notification-settings');

        Route::prefix('biodata/')
            ->name('bio.')
            ->group(function () {
                Route::post('updateAddress/', [UserController::class, 'updateAddress'])
                    ->name('updateAddress');
            });

        Route::prefix('wishlist/')
            ->name('wishlist.')
            ->group(function () {
                Route::post('addWishlist/', [UserController::class, 'addWishlist'])
                    ->name('addWishlist');
                Route::post('deleteWishlist/', [UserController::class, 'deleteWishlist'])
                    ->name('deleteWishlist');
            });
    });
