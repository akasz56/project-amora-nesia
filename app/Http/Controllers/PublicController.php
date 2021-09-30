<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function home()
    {
        $products = Product::inRandomOrder()->limit(12)->get();
        return view('home', [
            'products' => $products,
        ]);
    }

    public function categoriesView()
    {
        $shops = Shop::all();

        return view('categories', [
            'shops' => $shops,
        ]);
    }

    public function shopView($shopURL)
    {
        $shop = ShopController::searchShopbyURL($shopURL);
        $product = ShopController::getProductsbyShopID($shop->id);
        return view('shop', [
            'shop' => $shop,
            'product' => $product,
        ]);
    }

    public function productView($shopURL, $prodName)
    {
        $shop = ShopController::searchShopbyURL($shopURL);
        $prodName = str_replace("-", " ", $prodName);
        $product = Product::where('shopID', $shop->id)->where('name', $prodName)->first();
        $types = $product->types;
        $wraps = $product->wraps;
        $sizes = $product->sizes;
        return view('product', [
            'product' => $product,
            'types' => $types,
            'wraps' => $wraps,
            'sizes' => $sizes,
        ]);
    }
}
