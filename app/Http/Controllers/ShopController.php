<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ProductSize;
use App\Models\ProductType;
use App\Models\ProductWrap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    // -------------------------------------------------------- Statics

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

    // -------------------------------------------------------- Misc

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

    // -------------------------------------------------------- Views

    public function dashboardView()
    {
        $shop = $this->getShop();
        return view('shop.dashboard', [
            'shop' => $shop,
            'isAddressSame' => ($shop->addressID == Auth::user()->addressID) ? true : false,
        ]);
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

    // -------------------------------------------------------- ShopIdentity

    public function addShopEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $shop = $this->getShop();
        $shop->email = $request->email;
        $shop->save();

        return back()->with('success', 'Email toko berhasil ditambahkan');
    }

    public function updateBiodata(Request $request)
    {
        if (!isset($request->desc) && !isset($request->phone) && !isset($request->whatsapp))
            return back()->with('danger', "Tidak ada perubahan yg disimpan");
        else
            $shop = $this->getShop();

        $changes = '';

        if (isset($request->whatsapp)) {
            $request->validate(['whatsapp' => 'numeric|digits_between:10,15']);
            $shop->whatsapp = $request->whatsapp;
            $shop->save();
            $changes = "Nomor Whatsapp, " . $changes;
        }
        if (isset($request->phone)) {
            $request->validate(['phone' => 'numeric|digits_between:10,15']);
            $shop->phone = $request->phone;
            $shop->save();
            $changes = "Nomor Telepon, " . $changes;
        }
        if (isset($request->desc)) {
            $request->validate(['desc' => 'required']);
            $shop->desc = $request->desc;
            $shop->save();
            $changes = "Deskripsi Toko, " . $changes;
        }
        return back()->with('success', 'Perubahan ' . $changes . 'berhasil tersimpan');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'provinceID' => 'required|numeric',
            'city' => 'required',
            'rw' => 'required|numeric',
            'rt' => 'required|numeric',
            'address' => 'required',
            'postcode' => 'required|numeric',
        ]);

        $address = $this->getShop()->address;
        $address->provinceID = $request->provinceID;
        $address->city = $request->city;
        $address->rw = $request->rw;
        $address->rt = $request->rt;
        $address->address = $request->address;
        $address->postcode = $request->postcode;
        $address->save();

        return back()->with('success', 'Alamat berhasil diubah');
    }

    // -------------------------------------------------------- ShopOrderViews + CRUD

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

    // -------------------------------------------------------- ProductCRUD

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
        return view('shop.product-action', [
            'product' => $product,
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
        ProductType::where('productID', $request->productID)->delete();
        ProductWrap::where('productID', $request->productID)->delete();
        ProductSize::where('productID', $request->productID)->delete();

        $product = Product::find($request->productID)->delete();
        if ($product == 0)
            return "None Deleted";

        return redirect()->route('shop.product.list');
    }

    // -------------------------------------------------------- ProductSpecCRUD

    public function createProductSpec(Request $request)
    {
        if ($request->price < 1000)
            return back()->with($request->specification . 'Danger', 'Harga tidak boleh kurang dari Rp1000');
        switch ($request->specification) {
            case 'type':
                $spec = 'type';
                $object = ProductType::create([
                    'productID' => $request->productID,
                    'name' => $request->name,
                    'color' => $request->variable,
                    'stock' => $request->stock,
                    'price' => $request->price,
                ]);
                break;
            case 'wrap':
                $spec = 'wrap';
                $object = ProductWrap::create([
                    'productID' => $request->productID,
                    'name' => $request->name,
                    'color' => $request->variable,
                    'stock' => $request->stock,
                    'price' => $request->price,
                ]);
                break;
            case 'size':
                $spec = 'size';
                $object = ProductSize::create([
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
                $spec = ProductType::find($request->specID);
                $spec->name = $request->name;
                $spec->color = $request->variable;
                $spec->stock = $request->stock;
                $spec->price = $request->price;
                $spec->save();
                $message = 'type';
                break;

            case 'wrap':
                $spec = ProductWrap::find($request->specID);
                $spec->name = $request->name;
                $spec->color = $request->variable;
                $spec->stock = $request->stock;
                $spec->price = $request->price;
                $spec->save();
                $message = 'wrap';
                break;

            case 'size':
                $spec = ProductSize::find($request->specID);
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
                ProductType::find($id)->delete();
                $message = 'type';
                break;
            case 'wrap':
                ProductWrap::find($id)->delete();
                $message = 'wrap';
                break;
            case 'size':
                ProductSize::find($id)->delete();
                $message = 'size';
                break;

            default:
                return -5;
                break;
        }

        return $message . " deleted";
    }

    // -------------------------------------------------------- ProductPhotoCRUD

    public function postProductPhoto(Request $request)
    {
        $request->validate([
            'productID' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,pdf',
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file_path = "public/images/products";
            $file_name = Str::random("25") . "." . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs($file_path, $file_name);

            ProductPhoto::create([
                'productID' => $request->productID,
                'blob' => "storage\images\products\\" . $file_name,
                'caption' => (isset($request->caption)) ? $request->caption : null,
            ]);
            return back()->with('success', 'Upload foto berhasil');
        } else {
            return back()->with('danger', 'Kesalahan dalam upload file, Silahkan coba lagi');
        }
    }

    public function updateProductPhoto(Request $request)
    {
        switch ($request->btn) {
            case 'edit':
                $photo = ProductPhoto::find($request->photoID);
                $photo->caption = $request->caption;
                $photo->save();
                $message = "Caption Foto berhasil diubah";
                break;

            case 'delete':
                $photo = ProductPhoto::find($request->photoID)->delete();
                $message = "Foto berhasil dihapus";
                break;

            default:
                return back()->with('danger', "No Action Found");
                break;
        }
        return back()->with('success', $message);
    }
}
