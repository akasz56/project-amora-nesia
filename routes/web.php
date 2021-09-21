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

Route::get('/{shopURL}', function ($shopURL) {
    $shop = ShopController::searchShopbyURL($shopURL);
    $product = ShopController::getProductsbyShopID($shop->id);
    return view('shop', [
        'shop' => $shop,
        'product' => $product,
    ]);
})->name('shop');

Route::get('/{shopURL}/{prodName}', function ($shopURL, $prodName) {
    $shop = ShopController::searchShopbyURL($shopURL);
    $product = Product::where('shopID', $shop->id)->where('name', $prodName)->first();
    $types = FlowerType::where('productID', $product->id)->get();
    $wraps = FlowerWrap::where('productID', $product->id)->get();
    $sizes = FlowerSize::where('productID', $product->id)->get();
    return view('product', [
        'product' => $product,
        'types' => $types,
        'wraps' => $wraps,
        'sizes' => $sizes,
    ]);
})->name('product');

Route::post('/product', [OrderController::class, 'test'])->name('product.buy');
