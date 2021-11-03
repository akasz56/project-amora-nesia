<nav class="navbar navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">AMORA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
                <li class="nav-item text-center order-0">
                    <a class="nav-link" href="{{ route('categories') }}">Kategori</a>
                </li>

                @guest
                    <li class="nav-item text-center order-1 order-lg-2">
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item text-center order-2 order-lg-3">
                        <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item text-center order-1 order-lg-2">
                        <a class="btn btn-outline-light ms-lg-3" href="{{ route('user.cart') }}">
                            <i class='bx bx-cart-alt'></i>
                            Keranjang
                        </a>
                    </li>
                    <li class="nav-item text-center order-2 order-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-primary ms-lg-3" href="{{ route('shop.dashboard') }}">
                            <i class='bx bx-store-alt'></i>
                            Toko Anda
                        </a>
                    </li>
                    <li class="nav-item text-center order-2 order-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-primary ms-lg-3" href="{{ route('user.dashboard') }}">
                            <i class='bx bx-user'></i>
                            Akun Anda
                        </a>
                    </li>
                    <li class="nav-item text-center order-2 order-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-danger ms-lg-3" href="{{ route('logout') }}">
                            <i class='bx bx-log-out'></i>
                            Keluar
                        </a>
                    </li>
                @endauth

                <li class="nav-item text-center order-3 order-lg-1 mt-3 mt-lg-0 flex-grow-1">
                    <form> <input class="form-control me-2 rounded-pill" type="search" placeholder="Search"
                            aria-label="Search"> </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
