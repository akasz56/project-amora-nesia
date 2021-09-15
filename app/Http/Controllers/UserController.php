<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function wishlistView() {
        return view('user.wishlist');
    }

    public function cartView() {
        return view('user.cart');
    }
    
    public function historyView() {
        return view('user.buyhistory');
    }

    public function accSettings() {
        return view('user.accsettings');
    }

    public function notifSettings() {
        return view('user.notifsettings');
    }
}
