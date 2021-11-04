<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;

class PublicController extends Controller
{
    public function home()
    {
        $products = Product::orderBy('viewers', 'desc')->limit(20)->get();
        return view('home', [
            'products' => $products,
        ]);
    }

    public function categoriesView()
    {
        return view('categories');
    }

    public function catalogView()
    {
        return view('catalog', [
            'shops' => Shop::all(),
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
        if ($shop === null) {
            abort('404');
        }
        $prodName = str_replace("-", " ", $prodName);

        $product = Product::where('shopID', $shop->id)->where('name', $prodName)->first();
        $product->viewers++;
        $product->save();

        return view('product', [
            'product' => $product,
            'shop' => $shop,
            'recommendations' => Product::inRandomOrder()->limit(20)->get(),
        ]);
    }
}
