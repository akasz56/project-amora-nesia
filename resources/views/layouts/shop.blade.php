@extends('layouts.app')

@section('title', $shop->name . ' Dashboard')

@section('content')
<main class="container">
    <ul class="d-flex justify-content-evenly">
        <li>
            <a class="btn btn-outline-dark" href="{{ route('shop.dashboard') }}">Dashboard Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Pesanan Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Penjualan Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Etalase Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Identitas Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="#">Pengaturan Toko</a>
        </li>
    </ul>
</main>
@yield('container')
@endsection