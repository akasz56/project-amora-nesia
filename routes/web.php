<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/shop.php';


Route::view('/', 'home')
    ->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::view('/categories', 'categories')
    ->name('categories');

Route::get('/shop/{name}', function ($name) {
    $shop = ShopController::searchShopbyURL($name);
    $product = ShopController::getProductbyShopID($shop->id);
    return view('shop', [
        'shop' => $shop,
        'product' => $product,
    ]);
});