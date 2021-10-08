@extends('layouts.app')

@section('title', 'Amora Store')

@section('content')
    <main class="container">
        <section class="jumbotron-poster">
            {{-- <img class="img-fluid"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Salad_platter.jpg/1200px-Salad_platter.jpg"
                alt="" width="720" height="340"> --}}
            <div id="carouselExampleControls" class="carousel slide docs" data-bs-ride="carousel">
                <div class="carousel-inner docs-car">
                    <div class="carousel-item active">
                        <img src={{ asset('/assets/jumbotron-banner/banner1.jpg') }} class="img-fluid"
                            alt="Jumbotron Banner" width="720" height="340">
                    </div>
                    <div class="carousel-item">
                        <img src={{ asset('/assets/jumbotron-banner/banner2.jpg') }} class="img-fluid"
                            alt="Jumbotron Banner" width="720" height="340">
                    </div>
                    <div class="carousel-item">
                        <img src={{ asset('/assets/jumbotron-banner/banner3.jpg') }} class="img-fluid"
                            alt="Jumbotron Banner" width="720" height="340">
                    </div>
                    <div class="carousel-item">
                        <img src={{ asset('/assets/jumbotron-banner/banner4.jpg') }} class="img-fluid"
                            alt="Jumbotron Banner" width="720" height="340">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <hr>
        <section class="d-flex justify-content-around">
            <a href="#" class="category-card">
                <img class="img-fluid" src="https://image.flaticon.com/icons/png/512/678/678100.png" alt="Logo">
                <p>Flower icon</p>
            </a>
            <a href="#" class="category-card">
                <img class="img-fluid" src="https://image.flaticon.com/icons/png/512/678/678100.png" alt="Logo">
                <p>Flower icon</p>
            </a>
            <a href="#" class="category-card">
                <img class="img-fluid" src="https://image.flaticon.com/icons/png/512/678/678100.png" alt="Logo">
                <p>Flower icon</p>
            </a>
            <a href="#" class="category-card">
                <img class="img-fluid" src="https://image.flaticon.com/icons/png/512/678/678100.png" alt="Logo">
                <p>Flower icon</p>
            </a>
        </section>
        <hr>
        <section class="recommendations row">
            <?php $chunk = $products->split(2); ?>
            <div class="col-6">
                @foreach ($chunk[0] as $item)
                    <a class="d-block"
                        href="{{ route('product', ['shopURL' => $item->shop->url, 'prodName' => str_replace(' ', '-', $item->name)]) }}">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>
            <div class="col-6">
                @foreach ($chunk[1] as $item)
                    <a class="d-block"
                        href="{{ route('product', ['shopURL' => $item->shop->url, 'prodName' => str_replace(' ', '-', $item->name)]) }}">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>
        </section>
    </main>
@endsection
