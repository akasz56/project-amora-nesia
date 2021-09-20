<?php

namespace App\Http\Controllers;

use App\Models\FlowerSize;
use App\Models\FlowerType;
use App\Models\FlowerWrap;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function test(Request $request)
    {
        $request->validate([
            'ID' => 'required',
            'type' => 'required',
            'wrap' => 'required',
            'size' => 'required',
        ]);
        
        $product = Product::where('publicID',$request->ID)->first();
        $type = FlowerType::where('productID',$request->ID)->where('name', $request->type)->first();
        $wrap = FlowerWrap::where('productID',$request->ID)->where('name', $request->wrap)->first();
        $size = FlowerSize::where('productID',$request->ID)->where('name', $request->size)->first();

        dump($type);
        dump($wrap);
        dump($size);
        dd($product);
    }
}
