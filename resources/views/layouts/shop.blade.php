<?php
    use App\Http\Controllers\ShopController;
?>

@extends('layouts.app')

@section('title')
@yield('page') - {{ ShopController::getShop()->name }}
@endsection

@section('content')
<main class="container">
    <ul class="d-flex justify-content-evenly">
        <li>
            <a class="btn btn-outline-dark" href="{{ route('shop.dashboard') }}">Dashboard Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('shop.orders') }}">Pesanan Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('shop.sales') }}">Penjualan Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('shop.product-list') }}">Etalase Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('shop.about') }}">Identitas Toko</a>
        </li>
        <li>
            <a class="btn btn-outline-dark" href="{{ route('shop.shop-settings') }}">Pengaturan Toko</a>
        </li>
    </ul>
</main>
@yield('container')
@endsection