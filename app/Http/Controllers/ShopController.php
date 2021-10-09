<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\FlowerSize;
use App\Models\FlowerType;
use App\Models\FlowerWrap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public static function getShop(string $attr = null)
    {
        if ($attr) {
            $shop = Shop::find(Auth::user()->shopID)->toArray();
            return $shop[$attr];
        }
        return Shop::find(Auth::user()->shopID);
    }

    public static function searchShopbyURL($url)
    {
        return Shop::where('url', $url)->first();
    }

    public static function getProductsbyShopID($shopID)
    {
        return Product::where('shopID', $shopID)->get();
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'url' => 'required|alpha_dash|min:5|unique:shops',
        ]);
        $sameAddress = (isset($request->sameAddress)) ? true : false;

        if ($sameAddress) {
            $address = Address::find(Auth::user()->addressID);
            $address = Address::create([
                'provinceID' => $address->provinceID,
                'city' => $address->city,
                'rt' => $address->rt,
                'rw' => $address->rw,
                'address' => $address->address,
                'postcode' => $address->postcode,
            ]);
        } else {
            $address = Address::create([
                'provinceID' => $request->provinceID,
                'city' => $request->city,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'address' => $request->address,
                'postcode' => $request->postcode,
            ]);
        }
        $addressID = $address->id;

        $shop = Shop::create([
            'name' => $request->nama,
            'url' => $request->url,
            'addressID' => $addressID,
        ]);

        $user = User::find(Auth::user()->id);
        $user->shopID = $shop->id;
        $user->save();

        return redirect()->route('shop.dashboard');
    }

    public function dashboardView()
    {
        $shop = $this->getShop();
        $address = Address::find($shop->addressID);
        return view('shop.dashboard', [
            'shop' => $shop,
            'address' => $address,
        ]);
    }

    public function orderListView()
    {
        $shopID = $this->getShop('id');
        $orderitems = DB::table('order_items')
            ->select('orderID')
            ->where('shopID', $shopID)
            ->get();
        $orders = array();

        foreach ($orderitems as $item) {
            $order = Order::find($item->orderID);
            $order->orderItems;
            $orders[] = $order;
        }
        rsort($orders);
        return view('shop.orders', [
            'orders' => $orders,
        ]);
    }

    public function orderView($uuid)
    {
        $order = Order::where('orderUUID', $uuid)->first();
        if ($order == null)
            return redirect()->route('shop.orders')->with('danger', 'Order tersebut tidak ditemukan');

        $orderitems = OrderItem::where('orderUUID', $uuid)
            ->where('shopID', $this->getShop()->id)
            ->get();
        if ($orderitems == null)
            return redirect()->route('shop.orders')->with('danger', 'Order tersebut tidak ditemukan');

        return view('shop.order', [
            'order' => $order,
            'orderitems' => $orderitems,
        ]);
    }

    public function orderActions($uuid, Request $request)
    {
        $orderitem = OrderItem::find($request->orderItemID);
        $orderitem->statusID = $request->statusID;
        $orderitem->save();

        OrderController::checkOrder($orderitem->orders, $request->statusID);
        
        return redirect()->route('shop.orderUUID', ['uuid' => $uuid]);
    }

    public function salesView()
    {
        return view('shop.sales');
    }

    public function aboutView()
    {
        return view('shop.about');
    }

    public function shopSettings()
    {
        return view('shop.shopsettings');
    }

    public function readProductList()
    {
        $product = Product::where('shopID', $this->getShop()->id)->get();
        return view('shop.product-list', [
            'products' => $product->toArray(),
        ]);
    }

    public function readProductByID($id)
    {
        $product = Product::find($id);
        $types = FlowerType::where('productID', $product->id)->get();
        $wraps = FlowerWrap::where('productID', $product->id)->get();
        $sizes = FlowerSize::where('productID', $product->id)->get();
        return view('shop.product-action', [
            'product' => $product,
            'types' => $types,
            'wraps' => $wraps,
            'sizes' => $sizes,
        ]);
    }

    public function createProductView()
    {
        return view('shop.product-add');
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:300',
            'desc' => 'required|string',
        ]);

        $shop = $this->getShop();

        $product = Product::create([
            'shopID' => $shop->id,
            'name' => $request->nama,
            'description' => $request->desc,
            'rating' => 0,
            'viewers' => 0,
        ]);

        return redirect()->route('shop.product.byID', ['id' => $product->id]);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->productID);

        if (strcmp($product->description, $request->desc) == 0)
            return back()->with('danger', "No changes found");

        $product->description = $request->desc;
        $product->save();

        return back()->with('success', "Product " . $product->name . " sucessfully updated");
    }

    public function deleteProduct(Request $request)
    {
        FlowerType::where('productID', $request->productID)->delete();
        FlowerWrap::where('productID', $request->productID)->delete();
        FlowerSize::where('productID', $request->productID)->delete();

        $product = Product::find($request->productID)->delete();
        if ($product == 0)
            return "None Deleted";

        return redirect()->route('shop.product.list');
    }

    public function createProductSpec(Request $request)
    {
        if ($request->price < 1000)
            return back()->with($request->specification . 'Danger', 'Harga tidak boleh kurang dari Rp1000');
        switch ($request->specification) {
            case 'type':
                $spec = 'type';
                $object = FlowerType::create([
                    'productID' => $request->productID,
                    'name' => $request->name,
                    'color' => $request->variable,
                    'stock' => $request->stock,
                    'price' => $request->price,
                ]);
                break;
            case 'wrap':
                $spec = 'wrap';
                $object = FlowerWrap::create([
                    'productID' => $request->productID,
                    'name' => $request->name,
                    'color' => $request->variable,
                    'stock' => $request->stock,
                    'price' => $request->price,
                ]);
                break;
            case 'size':
                $spec = 'size';
                $object = FlowerSize::create([
                    'productID' => $request->productID,
                    'name' => $request->name,
                    'flower_amount' => $request->variable,
                    'stock' => $request->stock,
                    'price' => $request->price,
                ]);
                break;

            default:
                $spec = null;
                $object = null;
                break;
        }

        if ($object)
            return back()->with('success', "Produk " . $spec . " berhasil ditambahkan");
        else
            return back()->with('danger', "an Error occured");
    }

    public function updateProductSpec(Request $request)
    {
        switch ($request->btn) {
            case 'edit':
                $return = $this->editProductSpec($request);
                break;
            case 'delete':
                $return = $this->deleteProductSpec($request->specification, $request->specID);
                break;

            default:
                return back()->with('danger', "No Action Found");
                break;
        }

        if ($return == -5) return back()->with('danger', "No Specification Found");
        return back()->with('success', "Product " . ucwords($return) . " Successfully");
    }

    public function editProductSpec($request)
    {
        switch ($request->specification) {
            case 'type':
                $spec = FlowerType::find($request->specID);
                $spec->name = $request->name;
                $spec->color = $request->variable;
                $spec->stock = $request->stock;
                $spec->price = $request->price;
                $spec->save();
                $message = 'type';
                break;

            case 'wrap':
                $spec = FlowerWrap::find($request->specID);
                $spec->name = $request->name;
                $spec->color = $request->variable;
                $spec->stock = $request->stock;
                $spec->price = $request->price;
                $spec->save();
                $message = 'wrap';
                break;

            case 'size':
                $spec = FlowerSize::find($request->specID);
                $spec->name = $request->name;
                $spec->flower_amount = $request->variable;
                $spec->stock = $request->stock;
                $spec->price = $request->price;
                $spec->save();
                $message = 'size';
                break;

            default:
                $message = '';
                return -5;
        }
        return $message . " updated";
    }

    public function deleteProductSpec($spec, $id)
    {
        switch ($spec) {
            case 'type':
                FlowerType::find($id)->delete();
                $message = 'type';
                break;
            case 'wrap':
                FlowerWrap::find($id)->delete();
                $message = 'wrap';
                break;
            case 'size':
                FlowerSize::find($id)->delete();
                $message = 'size';
                break;

            default:
                return -5;
                break;
        }

        return $message . " deleted";
    }
}
