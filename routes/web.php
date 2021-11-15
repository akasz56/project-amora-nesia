<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/shop.php';


/* -------------------------------------
Test Routes
------------------------------------- */
Route::get('acastest', function () {

    dump("products");

    $product = Product::inRandomOrder()->limit(3)->get();
    foreach ($product as $item) {
        dump($item->id);
        foreach ($item->categories as $category) {
            dump($category->name);
        }
    }
});

Route::get('/delete/{id}', function ($id) {
    $order = Order::find($id);
    if ($order) {
        $orderItems = OrderItem::where('orderID', $order->id)->get();
        foreach ($orderItems as $item) {
            OrderItem::find($item->id)->delete();
        }
        Order::find($id)->delete();
        return "done";
    } else {
        return "Gaada gan";
    }
});



/* -------------------------------------
Main Routes
------------------------------------- */
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/home', function () {
    return redirect('/');
});
Route::view('/about', 'about')->name('about');
Route::get('/categories', [PublicController::class, 'categoriesView'])->name('categories');
Route::get('/catalog', [PublicController::class, 'catalogView'])->name('catalog');


/* -------------------------------------
Orders Routes
------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/order/submit', [OrderController::class, 'submitOrderOrCart'])->name('product.submit');
    Route::post('/order/submit-cart', [OrderController::class, 'confirmOrderfromCart'])->name('cart.submit');
    Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::post('/order/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');
    Route::post('/order/update', [OrderController::class, 'updateOrder'])->name('order.update');
    Route::get('/order/{uuid}', [OrderController::class, 'orderActions'])->name('order.actions');
});


/* -------------------------------------
Shop n Product Routes
------------------------------------- */
Route::get('/{shopURL}', [PublicController::class, 'shopView'])->name('shop');
Route::get('/{shopURL}/{prodName}', [PublicController::class, 'productView'])->name('product');
