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
    public function confirmOrder(Request $request)
    {
        $request->validate([
            'ID' => 'required',
            'type' => 'required',
            'wrap' => 'required',
            'size' => 'required',
        ]);

        $product = Product::find($request->ID);
        $type = $product->types->where('name', $request->type)->first();
        $wrap = $product->wraps->where('name', $request->wrap)->first();
        $size = $product->sizes->where('name', $request->size)->first();

        return view('order.confirm', [
            'product' => $product,
            'type' => $type,
            'wrap' => $wrap,
            'size' => $size,
        ]);
    }

    public function confirmOrderfromCart(Request $request)
    {
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'type' => 'required',
            'wrap' => 'required',
            'size' => 'required',
            'payment' => 'required',
            'alamat' => 'required',
            'pengiriman' => 'required',
        ]);

        $address = Address::find(Auth::user()->addressID);
        $user = Auth::user();

        $order = Order::create([
            'orderUUID' => Str::uuid(),
            'userID' => $user->id,
            'bankID' => ($request->payment == 1) ? rand(1, 3) : 0,
            'invoiceID' => rand(111111, 999999),
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

        $product = Product::find($request->product);
        OrderItem::create([
            'statusID' => 1,
            'orderID' => $order->id,
            'orderUUID' => $order->orderUUID,
            'userID' => $order->userID,
            'shopID' => $product->shopID,
            'productID' => $product->id,
            'productTypeID' => $request->type,
            'productWrapID' => $request->wrap,
            'productSizeID' => $request->size,
        ]);

        // return redirect()->route('user.history');
        return redirect()->route('order.actions', ['uuid' => $order->orderUUID]);
    }

    public function createOrderfromCart(Request $request)
    {
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::where('orderUUID', $request->uuid)->first();

        foreach ($order->orderitems as $item) {
            $item->statusID = 10;
            $item->save();
        }

        $order->status = 10;
        $order->save();

        return back()->with('success', "Order Canceled");
    }

    public function updateOrder(Request $request)
    {
        switch ($request->status) {
            case 'paid':
                $status = 2;
                break;

            case 'accepted':
                $status = 3;
                break;

            case 'processed':
                $status = 4;
                break;

            case 'done':
                $status = 5;
                break;

            default:
                dd("error");
                return redirect()->route('order.actions', ['uuid' => $request->uuid])->with('danger', "Action not Found");
                break;
        }

        $order = Order::where('orderUUID', $request->uuid)->first();

        foreach ($order->orderitems as $item) {
            $item->statusID = $status;
            $item->save();
        }

        $order->status = $status;
        $order->save();

        return back()->with('success', "Order " . ucwords($request->status) . " Sucessfully");
    }

    public function orderActions($uuid)
    {
        // Not found
        $order = Order::where('orderUUID', $uuid)->first();
        if ($order == null)
            return view('order.error', [
                'message' => "Order tidak ditemukan!",
            ]);

        // Doesnt belong to the user
        $userID = Auth::user()->id;
        if ($order->userID != $userID)
            return view('order.error', [
                'message' => "Ordernya tidak ditemukan!",
            ]);

        // payment pending
        if ($order->status == 1) {
            return view('order.payment', [
                'order' => $order,
            ]);
        }

        // order canceled page
        if ($order->status == 10) {
            return view('order.page', [
                'order' => $order,
            ]);
        }

        // order details page
        return view('order.page', [
            'order' => $order,
        ]);
    }

    public static function checkOrder($order, $status)
    {
        foreach ($order->orderItems as $item) {
            if ($item->statusID != $status)
            return 0;
        }
        $order->status = $status;
        $order->save();
        return 1;
    }
}
