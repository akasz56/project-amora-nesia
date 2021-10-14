<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserCart;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // -------------------------------------------------------- Views

    public function dashboardView()
    {
        $shop = ShopController::getShop();
        return view('user.dashboard', [
            'user' => Auth::user(),
            'isAddressSame' => ($shop && $shop->addressID == Auth::user()->addressID) ? true : false,
        ]);
    }

    public function wishlistView()
    {
        $wishlist = UserWishlist::where('userID', Auth::user()->id)->get();
        return view('user.wishlist', [
            'wishlist' => $wishlist,
        ]);
    }

    public function cartView()
    {
        $cart = UserCart::where('userID', Auth::user()->id)->get();
        return view('user.cart', [
            'cart' => $cart,
        ]);
    }

    public function historyView()
    {
        $orders = Order::where('userID', Auth::user()->id)->get();
        return view('user.orderhistory', [
            'orders' => ($orders->isEmpty()) ? null : $orders->sortDesc(),
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

    // -------------------------------------------------------- UserIdentity

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

    // -------------------------------------------------------- UserWishlist

    public function addWishlist(Request $request)
    {
        $exists =
            UserWishlist::where('userID', Auth::user()->id)
            ->where('productID', $request->productID)
            ->first();
        if ($exists) {
            return back()->with('danger', 'Produk ini sudah ada dalam Wishlist');
        }

        UserWishlist::create([
            'userID' => Auth::user()->id,
            'productID' => $request->productID,
        ]);
        return back()->with('success', 'Produk berhasil ditambahkan ke dalam Wishlist');
    }

    public function deleteWishlist(Request $request)
    {
        $exists = UserWishlist::find($request->wishlistID);
        if (!$exists) {
            return redirect()->route('user.wishlist')->with('danger', 'Wishlist tersebut tidak ada');
        }

        $exists->delete();
        return back()->with('success', 'Produk berhasil dihapus dari Wishlist');
    }
}
