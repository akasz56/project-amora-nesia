<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboardView()
    {
        $shop = ShopController::getShop();
        return view('user.dashboard', [
            'user' => Auth::user(),
            'isAddressSame' => ($shop->addressID == Auth::user()->addressID) ? true : false,
        ]);
    }

    public function wishlistView()
    {
        return view('user.wishlist');
    }

    public function cartView()
    {
        return view('user.cart');
    }

    public function historyView()
    {
        $orders = Order::where('userID', Auth::user()->id)->get();
        return view('user.buyhistory', [
            'orders' => $orders->sortDesc(),
        ]);
    }

    public function accSettings()
    {
        return view('user.accsettings');
    }

    public function notifSettings()
    {
        return view('user.notifsettings');
    }

    // -------------------------------------------------------- ShopIdentity

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

        $address = Auth::user()->address;
        $address->provinceID = $request->provinceID;
        $address->city = $request->city;
        $address->rw = $request->rw;
        $address->rt = $request->rt;
        $address->address = $request->address;
        $address->postcode = $request->postcode;
        $address->save();

        return back()->with('success', 'Alamat berhasil diubah');
    }
}
