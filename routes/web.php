<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Models\FlowerSize;
use App\Models\FlowerType;
use App\Models\FlowerWrap;
use App\Models\Product;
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

Route::get('/shop/{url}', function ($url) {
    $shop = ShopController::searchShopbyURL($url);
    $product = ShopController::getProductsbyShopID($shop->id);
    return view('shop', [
        'shop' => $shop,
        'product' => $product,
    ]);
})->name('shop');

Route::get('/product/{id}', function ($id) {
    $product = Product::where('publicID', $id)->first();
    $types = FlowerType::where('productID', $product->publicID)->get();
    $wraps = FlowerWrap::where('productID', $product->publicID)->get();
    $sizes = FlowerSize::where('productID', $product->publicID)->get();
    return view('product', [
        'product' => $product,
        'types' => $types,
        'wraps' => $wraps,
        'sizes' => $sizes,
    ]);
})->name('product');

Route::post('/product', [OrderController::class, 'test'])->name('product.buy');
