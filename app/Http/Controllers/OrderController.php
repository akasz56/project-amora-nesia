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
            'product' => 'required|numeric',
            'type' => 'required|numeric',
            'wrap' => 'required|numeric',
            'size' => 'required|numeric',
            'payment' => 'required|numeric',
            'pengiriman' => 'required|numeric',
            'nameSend' => 'required|alpha',
            'phone' => 'required|numeric'
        ]);

        // Order Identity Check
        if (isset($request->whatsapp)) {
            $request->validate(['whatsapp' => 'required|numeric']);
        }

        // Promo Code
        if ($request->promo) {
            dump("Promo Found");
            dd($request->promo);
        }

        // Alamat
        if (isset($request->sendToAcc)) {
            $address = Address::find(Auth::user()->addressID);
        } else {
            $address = new Address();
            $address->provinceID = $request->provinceID;
            $address->city = $request->city;
            $address->rt = $request->rt;
            $address->rw = $request->rw;
            $address->address = $request->address;
            $address->postcode = $request->postcode;
        }

        // Pembayaran
        switch ($request->payment) {
            case 1:
                dump('Bank');
                break;
            case 2:
                dump('Ewallet');
                break;

            default:
                dd("Opsi Pengiriman not Found");
                break;
        }

        // Pengiriman
        switch ($request->pengiriman) {
            case 1:
                dump('Kurir');
                break;
            case 2:
                dump('Agen');
                break;
            case 3:
                dump('COD');
                // Cek bisa COD apa ngga
                break;

            default:
                dd("Opsi Pengiriman not Found");
                break;
        }

        $user = Auth::user();

        $order = new Order();
        $order->orderUUID = Str::uuid();
        $order->userID = $user->id;
        $order->bankID = ($request->payment == 1) ? rand(1, 3) : 0;
        $order->invoiceID = rand(111111, 999999);
        $order->status = 1;
        $order->nameSend = $request->nameSend;
        $order->phone = $request->phone;
        $order->whatsapp = ($request->whatsapp) ? $request->whatsapp : null;
        $order->provinceID = $address->provinceID;
        $order->city = $address->city;
        $order->rt = $address->rt;
        $order->rw = $address->rw;
        $order->address = $address->address;
        $order->postcode = $address->postcode;

        $product = Product::find($request->product);
        $orderitem = new OrderItem();
        $orderitem->statusID = 1;
        $orderitem->orderID = $order->id;
        $orderitem->orderUUID = $order->orderUUID;
        $orderitem->userID = $order->userID;
        $orderitem->shopID = $product->shopID;
        $orderitem->productID = $product->id;
        $orderitem->productTypeID = $request->type;
        $orderitem->productWrapID = $request->wrap;
        $orderitem->productSizeID = $request->size;

        dump($address);
        dump($order);
        dd($orderitem);

        // $order = Order::create([
        //     'orderUUID' => Str::uuid(),
        //     'userID' => $user->id,
        //     'bankID' => ($request->payment == 1) ? rand(1, 3) : 0,
        //     'invoiceID' => rand(111111, 999999),
        //     'status' => 1,
        //     'nameSend' => $request->nameSend,
        //     'phone' => $request->phone,
        //     'whatsapp' => ($request->whatsapp) ? $request->whatsapp : null,
        //     'provinceID' => $address->provinceID,
        //     'city' => $address->city,
        //     'rt' => $address->rt,
        //     'rw' => $address->rw,
        //     'address' => $address->address,
        //     'postcode' => $address->postcode,
        // ]);

        // foreach(???????)

        // $product = Product::find($request->product);
        // OrderItem::create([
        //     'statusID' => 1,
        //     'orderID' => $order->id,
        //     'orderUUID' => $order->orderUUID,
        //     'userID' => $order->userID,
        //     'shopID' => $product->shopID,
        //     'productID' => $product->id,
        //     'productTypeID' => $request->type,
        //     'productWrapID' => $request->wrap,
        //     'productSizeID' => $request->size,
        // ]);

        // return redirect()->route('order.actions', ['uuid' => $order->orderUUID]);
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
