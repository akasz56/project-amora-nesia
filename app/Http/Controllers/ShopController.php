<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\FlowerSize;
use App\Models\FlowerType;
use App\Models\FlowerWrap;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Util\SpecReader;

class ShopController extends Controller
{
    public static function getShop(string $attr = null)
    {
        if ($attr) {
            dd($attr);
        }
        return Shop::find(Auth::user()->shopID);
    }

    public static function searchShopbyURL($url)
    {
        return Shop::where('url', $url)->first();
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'url' => 'required|alpha_dash|min:5|unique:shops',
        ]);
        $sameAddress = (isset($request->sameAddress)) ? true : false;

        if ($sameAddress) $addressID = Auth::user()->addressID;
        else {
            $address = Address::create([
                'provinceID' => null,
                // 'provinceID' => $request->provinceID,
                'city' => null,
                // 'city' => $request->city,
                'rt' => null,
                // 'rt' => $request->rt,
                'rw' => null,
                // 'rw' => $request->rw,
                'address' => null,
                // 'address' => $request->address,
                'postcode' => null,
                // 'postcode' => $request->postcode,
            ]);
            $addressID = $address->id;
        }

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
        return view('shop.dashboard');
    }

    public function ordersView()
    {
        return view('shop.orders');
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

    public function readProductByID($prodID)
    {
        $product = Product::where('publicID', $prodID)->first();
        $types = FlowerType::where('productID', $product->publicID)->get();
        $wraps = FlowerWrap::where('productID', $product->publicID)->get();
        $sizes = FlowerSize::where('productID', $product->publicID)->get();
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

        $product = Product::create([
            'shopID' => $this->getShop()->id,
            'name' => $request->nama,
            'description' => $request->desc,
            'rating' => 0,
            'viewers' => 0,
        ]);

        return redirect()->route('shop.product.byID', ['id' => $product->id]);
    }

    public function updateProduct(Request $request)
    {
    }

    public function deleteProduct()
    {
    }

    public function createProductSpec(Request $request)
    {
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
            return back()->with('done', "Product " . $spec . " sucessfully added");
        else
            return false;
    }
}
