<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public static function getShop(string $attr = null)
    {
        return Shop::find(Auth::user()->shopID);
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

    public function productlistView()
    {
        return view('shop.product-list', [
            'products' => Product::where('shopID', $this->getShop()->id)->get()->toArray(),
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

        return redirect()->route('shop.product', ['id' => $product->id]);
    }
    
    public function updateProduct() {}

    public function deleteProduct() {}

    public function readProduct($id)
    {
        $product = Product::find($id);
        return view('shop.product-action', [
            'product' => $product,
        ]);
    }

    public function createProductSpec() {}
    
    public function updateProductSpec() {}
    
    public function deleteProductSpec() {}
    
    public function readProductSpec() {}
    
}
