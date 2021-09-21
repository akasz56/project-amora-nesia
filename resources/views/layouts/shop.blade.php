<?php
    use App\Http\Controllers\ShopController;
?>

@extends('layouts.app')

@section('title')
@yield('page') - {{ ShopController::getShop()->name }}
@endsection

@section('content')
<section>
    <ul class="d-flex flex-row dashboard-nav">
        <li class="p-2">
            <a href="{{ route('shop.dashboard') }}">Dashboard Toko</a>
        </li>
        <li class="p-2">
            <a href="{{ route('shop.orders') }}">Pesanan Toko</a>
        </li>
        <li class="p-2">
            <a href="{{ route('shop.sales') }}">Penjualan Toko</a>
        </li>
        <li class="p-2">
            <a href="{{ route('shop.product.list') }}">Etalase Toko</a>
        </li>
        <li class="p-2">
            <a href="{{ route('shop.about') }}">Identitas Toko</a>
        </li>
        <li class="p-2">
            <a href="{{ route('shop.settings') }}">Pengaturan Toko</a>
        </li>
    </ul>
</section>
@yield('container')
@endsection