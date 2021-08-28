<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home')->name('home');
Route::get('/home', function () {
    return redirect('/');
});
Route::view('/categories', 'categories')->name('categories');

require __DIR__ . '/auth.php';

// User
Route::prefix('u/')->middleware(['auth', 'verified'])->name('user.')->group(function () {
    Route::view('/dashboard', 'user.dashboard')->name('dashboard');
    Route::get('/cart', [UserController::class, 'Cart'])->name('cart');
});

// Shop
Route::view('/u/register-shop', 'auth.register-shop')->middleware(['auth', 'verified'])->name('shop.register');
Route::post('/u/register-shop', [ShopController::class, 'register'])->name('shop.register');
Route::prefix('s/')->middleware(['auth', 'verified', 'hasStore'])->name('shop.')->group(function () {
    Route::get('/dashboard', [ShopController::class, 'dashboardView'])->name('dashboard');
});
