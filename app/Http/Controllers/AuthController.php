<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $address = Address::create([
            'provinceID' => null,
            'city' => null,
            'rt' => null,
            'rw' => null,
            'address' => null,
            'postcode' => null,
        ]);
        
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'addressID' => $address->id,
        ]);

        event(new Registered($user));

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('user.dashboard');
        } else {
            return back()->with('fail', 'Terjadi kesalahan selama proses login, silahkan coba lagi');
        }
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $remember = (isset($request->remember)) ? true : false;

        if (User::where('email', '=', $request->email)->first() === null) {
            return back()->with('fail', 'Email belum terdaftar');
        }

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            return redirect('/');
        } else {
            return back()->with('fail', 'Password Salah');
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
