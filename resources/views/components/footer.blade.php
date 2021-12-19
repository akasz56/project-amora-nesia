<footer id="footer" class="bg-amora-dark text-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-5 py-5 border-top">
            <div class="col">
                <a href="{{ route('home') }}" class="navbar-brand link-light">AMORA</a>
                <p class="text-amora-light">© 2021</p>
            </div>

            <div class="col">
                <a href="https://www.instagram.com/amoranesia/" class="link-light" target="_blank"><i
                        class='bx bxl-instagram-alt bx-md'></i></a>
            </div>

            <div class="col">
                <h5>Menu Utama</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('home') }}"
                            class="nav-link p-0 text-amora-light">Beranda</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('categories') }}"
                            class="nav-link p-0 text-amora-light">Kategori</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('catalog') }}"
                            class="nav-link p-0 text-amora-light">Katalog</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('about') }}"
                            class="nav-link p-0 text-amora-light">Tentang
                            Kami</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-amora-light">What</a></li>
                </ul>
            </div>

            <div class="col">
                <h5>Menu Akun</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('user.wishlist') }}" class="nav-link p-0 text-amora-light">
                            <i class='bx bx-heart'></i>
                            Wishlist
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('user.cart') }}" class="nav-link p-0 text-amora-light">
                            <i class='bx bx-cart-alt'></i>
                            Keranjang
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('user.dashboard') }}" class="nav-link p-0 text-amora-light">
                            <i class='bx bx-user'></i>
                            Identitas Diri
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('user.history') }}" class="nav-link p-0 text-amora-light">
                            <i class='bx bx-history'></i>
                            Riwayat Pembelian
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('user.account-settings') }}" class="nav-link p-0 text-amora-light">
                            <i class='bx bx-cog'></i>
                            Pengaturan Akun
                        </a>
                    </li>
                </ul>
            </div>

            @auth
                @if (auth::user()->shopID)
                    <div class="col">
                        <h5>Menu Toko</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="{{ route('shop.dashboard') }}" class="nav-link p-0 text-amora-light">
                                    <i class='bx bxs-dashboard'></i>
                                    Dashboard Toko
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('shop.orders') }}" class="nav-link p-0 text-amora-light">
                                    <i class='bx bx-collection'></i>
                                    Pesanan
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('shop.sales') }}" class="nav-link p-0 text-amora-light">
                                    <i class='bx bx-line-chart'></i>
                                    Penjualan
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('shop.product.list') }}" class="nav-link p-0 text-amora-light">
                                    <i class='bx bx-store-alt'></i>
                                    Etalase
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('shop.about') }}" class="nav-link p-0 text-amora-light">
                                    <i class='bx bx-id-card'></i>
                                    Identitas Toko
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('shop.settings') }}" class="nav-link p-0 text-amora-light">
                                    <i class='bx bx-cog'></i>
                                    Pengaturan Toko
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            @endauth

        </div>
    </div>
</footer>
