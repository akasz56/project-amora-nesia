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
        switch ($prodID) {
            case 'add':
                abort('404');
            case 'update':
                abort('404');
            case 'delete':
                abort('404');

            default:
                break;
        }
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

        $shop = $this->getShop();

        $lastproduct = Product::where('shopID', $shop->id)->get()->last();

        $shopcode = strtoupper(substr($shop->name, 0, 3)) . rand(0, 9);
        $prodID = (int)substr($lastproduct->publicID, 5, 6);
        $prodID += 301;

        $product = Product::create([
            'publicID' => $shopcode . $prodID,
            'shopID' => $shop->id,
            'name' => $request->nama,
            'description' => $request->desc,
            'rating' => 0,
            'viewers' => 0,
        ]);

        return redirect()->route('shop.product.byID', ['prodID' => $product->publicID]);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::where('publicID', $request->productID)->first();

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

        $product = Product::where('publicID', $request->productID)->delete();
        if ($product == 0)
            return "None Deleted";

        return redirect()->route('shop.product.list');
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
            return back()->with('success', "Product " . $spec . " sucessfully added");
        else
            return false;
    }
}
