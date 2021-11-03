@extends('layouts.app')

@section('title')
    @yield('page') - Amora
@endsection

@section('content')
    <section class="sidebar">
        <div class="logo-details">
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="{{ route('user.wishlist') }}">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Wishlist</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.cart') }}">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name">Keranjang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.dashboard') }}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Identitas Diri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.history') }}">
                    <i class='bx bx-history'></i>
                    <span class="links_name">Riwayat Pembelian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.account-settings') }}">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Pengaturan Akun</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.notification-settings') }}">
                    <i class='bx bx-bell'></i>
                    <span class="links_name">Pengaturan Notifikasi</span>
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
