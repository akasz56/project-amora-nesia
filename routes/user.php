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

        // Route::get('/myOrder/{uuid}', [UserController::class, 'myOrder'])
        //     ->name('myOrder');

        Route::get('/account-settings', [UserController::class, 'accSettings'])
            ->name('account-settings');

        Route::get('/notification-settings', [UserController::class, 'notifSettings'])
            ->name('notification-settings');
    });
