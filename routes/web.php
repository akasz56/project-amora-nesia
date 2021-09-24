<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/shop.php';


/* -------------------------------------
Test Routes
------------------------------------- */
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
Route::view('/', 'home')->name('home');
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/categories', [PublicController::class, 'categoriesView'])->name('categories');


/* -------------------------------------
Orders Routes
------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/order', [OrderController::class, 'createOrder'])->name('product.buy');
});


/* -------------------------------------
Shop n Product Routes
------------------------------------- */
Route::get('/{shopURL}', [PublicController::class, 'shopView'])->name('shop');
Route::get('/{shopURL}/{prodName}', [PublicController::class, 'productView'])->name('product');
