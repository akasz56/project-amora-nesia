@extends('layouts.app')

@section('title', 'Hi, ' . Auth::user()->name . ' - Amora')

@section('content')
<main class="container">
    <ul class="d-flex justify-content-evenly">
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.wishlist') }}">Wishlist</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.cart') }}">Keranjang</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.dashboard') }}">Identitas Diri</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.history') }}">Riwayat Pembelian</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.account-settings') }}">Pengaturan Akun</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.notification-settings') }}">Pengaturan Notifikasi</a>
        </li>
    </ul>
</main>
@yield('container')
@endsection