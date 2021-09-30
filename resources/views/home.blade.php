@extends('layouts.app')

@section('title', 'Amora Store')

@section('content')
    <main class="container">
        <section class="jumbotron-poster">
            <img class="img-fluid"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Salad_platter.jpg/1200px-Salad_platter.jpg"
                alt="" width="720" height="340">
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
