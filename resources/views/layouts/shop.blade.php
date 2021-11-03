<?php
use App\Http\Controllers\ShopController;
?>

@extends('layouts.app')

@section('title')
    @yield('page') - {{ ShopController::getShop('name') }}
@endsection

@section('content')
    <section class="sidebar">
        <div class="logo-details">
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="{{ route('shop.dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="links_name">Dashboard Toko</span>
                </a>
            </li>
            <li>
                <a href="{{ route('shop.orders') }}">
                    <i class='bx bx-collection'></i>
                    <span class="links_name">Pesanan Toko</span>
                </a>
            </li>
            <li>
                <a href="{{ route('shop.sales') }}">
                    <i class='bx bx-line-chart'></i>
                    <span class="links_name">Penjualan Toko</span>
                </a>
            </li>
            <li>
                <a href="{{ route('shop.product.list') }}">
                    <i class='bx bx-store-alt'></i>
                    <span class="links_name">Etalase Toko</span>
                </a>
            </li>
            <li>
                <a href="{{ route('shop.about') }}">
                    <i class='bx bx-id-card'></i>
                    <span class="links_name">Identitas Toko</span>
                </a>
            </li>
            <li>
                <a href="{{ route('shop.settings') }}">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Pengaturan Toko</span>
                </a>
            </li>
        </ul>
    </section>

    @yield('container')

    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    </script>
@endsection
