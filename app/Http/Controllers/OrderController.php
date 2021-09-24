<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function confirmOrder()
    {
    }
    
    public function orderActions($uuid)
    {
        $order = Order::where('orderUUID', $uuid)->first();
        if ($order == null)
            return "Ganemu";

        $userID = Auth::user()->id;
        if ($order->userID != $userID)
            return "Bukan punya lu";

        // payment page
        // order status page
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'ID' => 'required',
            'type' => 'required',
            'wrap' => 'required',
            'size' => 'required',
        ]);

        $address = Address::find(Auth::user()->addressID);
        $user = Auth::user();

        $order = Order::create([
            'orderUUID' => Str::uuid(),
            'userID' => $user->id,
            'invoiceID' => rand(5000, 9999),
            'status' => 1,
            'nameSend' => 'Nama dikirim',
            'phone' => ($user->phone) ? $user->phone : "088888888888",
            'whatsapp' => ($user->whatsapp) ? $user->whatsapp : "088888888888",
            'provinceID' => $address->provinceID,
            'city' => $address->city,
            'rt' => $address->rt,
            'rw' => $address->rw,
            'address' => $address->address,
            'postcode' => $address->postcode,
        ]);

        $product = Product::find($request->ID);
        OrderItem::create([
            'orderID' => $order->id,
            'orderUUID' => $order->orderUUID,
            'userID' => $order->userID,
            'shopID' => $product->shopID,
            'productID' => $product->id,
            'productTypeID' => $product->types->where('name', $request->type)->first()->id,
            'productWrapID' => $product->wraps->where('name', $request->wrap)->first()->id,
            'productSizeID' => $product->sizes->where('name', $request->size)->first()->id,
        ]);

        return redirect()->route('user.history');
    }

    public function createOrderfromCart(Request $request)
    {
    }
}
