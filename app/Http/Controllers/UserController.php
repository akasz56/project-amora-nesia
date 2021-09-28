<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboardView()
    {
        $address = Address::find(Auth::user()->addressID);
        return view('user.dashboard', [
            'user' => Auth::user(),
            'address' => $address,
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
            'orders' => $orders,
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

}
