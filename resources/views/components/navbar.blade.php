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

                @auth
                <li class="nav-item text-center order-1 order-lg-2">
                    <a class="btn btn-primary ms-3" href="#">Daftarkan Toko</a>
                </li>
                <li class="nav-item text-center order-2 order-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-danger ms-3" href="{{ route('logout') }}">Keluar</a>
                </li>
                @endauth

                @guest
                <li class="nav-item text-center order-1 order-lg-2">
                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                </li>
                <li class="nav-item text-center order-2 order-lg-3">
                    <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                </li>
                @endguest

                <li class="nav-item text-center order-3 order-lg-1 mt-3 mt-lg-0 flex-grow-1">
                    <form> <input class="form-control me-2 rounded-pill" type="search" placeholder="Search"
                            aria-label="Search"> </form>
                </li>
            </ul>
        </div>
    </div>
</nav>