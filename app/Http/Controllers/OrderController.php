<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // -------------------------------------------------------- Statics

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

    public static function clearCart(Request $request)
    {
        $deletedRows = UserCart::where('userID', Auth::user()->id)->delete();
        return $deletedRows;
    }

    // -------------------------------------------------------- Actions

    public function submitOrderOrCart(Request $request)
    {
        if ($request->type == 0) return back()->with('typeError', "Silahkan Pilih Jenis Bunga");
        if ($request->wrap == 0) return back()->with('wrapError', "Silahkan Pilih Jenis Bungkus");
        if ($request->size == 0) return back()->with('sizeError', "Silahkan Pilih Ukuran");

        switch ($request->btn) {
            case 'order':
                return $this->confirmOrder($request);
                break;
            case 'cart':
                return $this->addToCart($request);
                break;

            default:
                return back()->with('danger', "No Action Found");
                break;
        }
        dd("Error Occured - OC101");
    }

    public function confirmOrder(Request $request)
    {
        $basket = new UserCart();
        $basket->userID = Auth::user()->id;
        $basket->productID = $request->ID;
        $basket->productTypeID = $request->type;
        $basket->productWrapID = $request->wrap;
        $basket->productSizeID = $request->size;
        $basket = collect([$basket]);

        return view('order.confirm', [
            'basket' => $basket,
            'payment' => DB::table('ref_payment')->select('*')->get()->toArray(),
            'shipment' => DB::table('ref_shipment')->select('*')->get()->toArray(),
        ]);
    }

    public function confirmOrderfromCart()
    {
        $basket = UserCart::where('userID', Auth::user()->id)->get();
        $basket = collect($basket);

        return view('order.confirm', [
            'basket' => $basket,
            'payment' => DB::table('ref_payment')->select('*')->get()->toArray(),
            'shipment' => DB::table('ref_shipment')->select('*')->get()->toArray(),
        ]);
    }

    // -------------------------------------------------------- OrderCRUD

    public function createOrder(Request $request)
    {
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
        if ($request->payment > DB::table('ref_payment')->count()) {
            dd("Opsi Pembayaran not Found");
        }

        // Pengiriman
        if ($request->pengiriman > DB::table('ref_shipment')->count()) {
            dd("Opsi Pengiriman not Found");
        }

        $user = Auth::user();
        $order = Order::create([
            'orderUUID' => Str::uuid(),
            'userID' => $user->id,
            'paymentID' => $request->payment,
            'shipmentID' => $request->pengiriman,
            'status' => 1,

            'nameSend' => $request->nameSend,
            'phone' => $request->phone,
            'whatsapp' => ($request->whatsapp) ? $request->whatsapp : null,

            'provinceID' => $address->provinceID,
            'city' => $address->city,
            'rt' => $address->rt,
            'rw' => $address->rw,
            'address' => $address->address,
            'postcode' => $address->postcode,
        ]);

        // OrderItems
        $productIDs = collect($request);
        $productIDs = $productIDs->filter(function ($value, $key) {
            return strpos($key, "product") !== false;
        });

        // Each OrderItem
        for ($i = 1; $i <= $productIDs->count(); $i++) {
            $product = Product::find($request['productID-' . $i]);
            OrderItem::create([
                'statusID' => 1,
                'orderID' => $order->id,
                'orderUUID' => $order->orderUUID,
                'userID' => $order->userID,
                'shopID' => $product->shopID,
                'productID' => $product->id,
                'productTypeID' => $request['typeID-' . $i],
                'productWrapID' => $request['wrapID-' . $i],
                'productSizeID' => $request['sizeID-' . $i],
            ]);
        }

        return redirect()->route('order.actions', ['uuid' => $order->orderUUID]);
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

    // -------------------------------------------------------- UserCart

    public function addToCart(Request $request)
    {
        $cart = UserCart::where('userID', Auth::user()->id)->get();
        if ($cart->count() > 10) {
            return back()->with('danger', 'Produk ini sudah ada dalam Keranjang');
        }

        $exists =
            $cart->where('productID', $request->ID)
            ->where('productTypeID', $request->type)
            ->where('productWrapID', $request->wrap)
            ->where('productSizeID', $request->size)
            ->first();
        if ($exists) {
            return back()->with('danger', 'Produk ini sudah ada dalam Keranjang');
        }

        $cart = UserCart::create([
            'userID' => Auth::user()->id,
            'productID' => $request->ID,
            'productTypeID' => $request->type,
            'productWrapID' => $request->wrap,
            'productSizeID' => $request->size,
        ]);
        if ($cart) {
            return redirect()->route('user.cart')->with('success', 'Produk berhasil ditambahkan ke dalam Keranjang');
        }
        return back()->with('danger', 'Terjadi kesalahan, mohon coba lagi');
    }

    public function deleteCart(Request $request)
    {
        $exists = UserCart::find($request->cartID);
        if (!$exists) {
            return redirect()->route('user.cart')->with('danger', 'Produk tersebut tidak ada dalam keranjang');
        }

        $exists->delete();
        return back()->with('success', 'Produk berhasil dihapus dari Keranjang');
    }

    public function deleteAllCart(Request $request)
    {
        $deletedRows = $this->clearCart($request);
        return back()->with('success', 'Keranjang berhasil dikosongkan');
    }
}
