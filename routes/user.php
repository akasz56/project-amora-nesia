<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
