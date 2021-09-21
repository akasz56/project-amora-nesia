<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\returnSelf;

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/shop.php';


Route::view('/', 'home')
    ->name('home');

Route::get('/home', function () {
    return redirect('/');
});


Route::get('/categories', function () {
    $shops = Shop::all();

    return view('categories', [
        'shops' => $shops,
    ]);
})->name('categories');

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

    $prodName = str_replace("-", " ", $prodName);
    $product = Product::where('shopID', $shop->id)->where('name', $prodName)->first();

    $types = $product->types;
    $wraps = $product->wraps;
    $sizes = $product->sizes;
    
    return view('product', [
        'product' => $product,
        'types' => $types,
        'wraps' => $wraps,
        'sizes' => $sizes,
    ]);
})->name('product');

Route::post('/product', [OrderController::class, 'test'])->name('product.buy');
