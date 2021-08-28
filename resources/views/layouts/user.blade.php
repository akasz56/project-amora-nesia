@extends('layouts.app')

@section('title', 'Hi, ' . Auth::user()->name . ' - Amora')

@section('content')
<main class="container">
    <ul class="d-flex justify-content-evenly">
        <li>
            <a class="btn btn-outline-dark" href="#">Wishlist</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.cart') }}">Keranjang</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('user.dashboard') }}">Identitas Diri</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Riwayat Pembelian</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Pengaturan Akun</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Pengaturan Notifikasi</a>
        </li>
    </ul>
</main>
@yield('container')
@endsection