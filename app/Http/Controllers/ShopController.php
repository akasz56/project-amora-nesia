<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'url' => 'required|min:5|unique:shops',
        ]);
        $sameAddress = (isset($request->sameAddress)) ? true : false;

        if ($sameAddress) {
            $shop = Shop::create([
                'name' => $request->nama,
                'url' => $request->url,
                'userID' => Auth::user()->id,
                'addressID' => Auth::user()->addressID,
            ]);
        } else {
            $address = Address::create([
                'provinceID' => null, // $request->provinceID,
                'city' => null, // $request->city,
                'rt' => null, // $request->rt,
                'rw' => null, // $request->rw,
                'address' => null, // $request->address,
                'postcode' => null, // $request->postcode,
            ]);
            $shop = Shop::create([
                'name' => $request->nama,
                'url' => $request->url,
                'userID' => Auth::user()->id,
                'addressID' => $address->id,
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->storeID = $shop->id;
        $user->save();

        return redirect()->route('shop.dashboard');
    }

    public function dashboardView()
    {
        $shop = Shop::find(Auth::user()->storeID);
        return view('shop.dashboard', [
            'shop' => $shop,
        ]);
    }
}
