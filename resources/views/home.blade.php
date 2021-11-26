@extends('layouts.app')

@section('title', 'Amora Store')

@section('content')
    <main class="container">

        @if (session()->has('verified'))
            <button type="button" id="verifBtn" class="d-none" data-bs-toggle="modal"
                data-bs-target="#verifModal">Launch demo modal</button>
            <div class="modal fade" id="verifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body alert alert-success">
                            Email anda berhasil di Verifikasi!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                window.onload = () => {
                    document.getElementById('verifBtn').click();
                }
            </script>
        @endif

        {{-- Banners --}}
        <section id="homeBanner" class="jumbotron-poster carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <a href="#" class="carousel-item active">
                    <img src={{ asset('/assets/jumbotron-banner/banner1.jpg') }} class="d-block w-100"
                        alt="Jumbotron Banner">
                </a>
                <a href="#" class="carousel-item">
                    <img src={{ asset('/assets/jumbotron-banner/banner2.jpg') }} class="d-block w-100"
                        alt="Jumbotron Banner">
                </a>
                <a href="#" class="carousel-item">
                    <img src={{ asset('/assets/jumbotron-banner/banner3.jpg') }} class="d-block w-100"
                        alt="Jumbotron Banner">
                </a>
                <a href="#" class="carousel-item">
                    <img src={{ asset('/assets/jumbotron-banner/banner4.jpg') }} class="d-block w-100"
                        alt="Jumbotron Banner">
                </a>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#homeBanner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeBanner" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </section>

        {{-- Categories --}}
        <hr>
        <section class="d-flex justify-content-around">
            @foreach ($categories as $item)
                <a href="{{ route('category', ['key' => $item->name]) }}" class="category-card">
                    @if ($item->logo_url)
                        <img class="img-fluid" src={{ asset('/assets/category-logo/' . $item->logo_url) }}
                            alt="Logo">
                    @else
                        <img class="img-fluid" src={{ asset('/assets/category-logo/category-dummy.png') }}
                            alt="Logo">
                    @endif
                    <p class="display-6">{{ $item->name }}</p>
                </a>
            @endforeach
        </section>
        <hr>

        {{-- Recommendations --}}
        <section class="recommendations row">
            <h1 class="fw-bold text-center">Terbanyak dilihat</h1>
            <hr class="mb-5">
            <?php $chunk = $products->split(2); ?>
            <div class="col-md-6">
                @foreach ($chunk[0] as $item)
                    @include('components.product-preview', ['item' => $item, 'class' => 'mb-3'])
                @endforeach
            </div>
            <div class="col-md-6">
                @foreach ($chunk[1] as $item)
                    @include('components.product-preview', ['item' => $item, 'class' => 'mb-3'])
                @endforeach
            </div>
        </section>

    </main>
@endsection
