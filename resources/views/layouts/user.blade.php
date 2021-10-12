@extends('layouts.app')

@section('title')
    @yield('page') - Amora
@endsection

@section('content')
    <section>
        <ul class="d-flex flex-row dashboard-nav">
            <li class="p-2">
                <a href="{{ route('user.wishlist') }}">Wishlist</a>
            </li>
            <li class="p-2">
                <a href="{{ route('user.cart') }}">Keranjang</a>
            </li>
            <li class="p-2">
                <a href="{{ route('user.dashboard') }}">Identitas Diri</a>
            </li>
            <li class="p-2">
                <a href="{{ route('user.history') }}">Riwayat Pembelian</a>
            </li>
            <li class="p-2">
                <a href="{{ route('user.account-settings') }}">Pengaturan Akun</a>
            </li>
            <li class="p-2">
                <a href="{{ route('user.notification-settings') }}">Pengaturan Notifikasi</a>
            </li>
        </ul>
    </section>
    @yield('container')
@endsection
