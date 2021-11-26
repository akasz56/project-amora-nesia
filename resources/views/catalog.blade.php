@extends('layouts.app')

@section('title', 'Katalog - Amora Store')

@section('content')
    <main class="container">
        <h1>Semua Produk di Amora Store</h1>

        {{-- Shops --}}
        <div class="mt-5 row">
            <?php $chunk = $shops->split(2); ?>

            {{-- Left --}}
            <section class="col-md-6">
                @foreach ($chunk[0] as $shop)
                    <div class="mb-5 card">
                        <span class="card-body">
                            <a href="/{{ $shop->url }}" class="btn btn-outline-dark">
                                <i class='bx bx-store-alt'></i>
                                {{ $shop->name }}
                            </a>
                        </span>
                        <ul class="list-group">
                            @foreach ($shop->products as $item)
                                <li class="list-group-item">
                                    <a
                                        href="{{ route('product', ['shopURL' => $shop->url, 'prodName' => str_replace(' ', '-', $item->name)]) }}">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </section>

            {{-- Right --}}
            <section class="col-md-6">
                @foreach ($chunk[1] as $shop)
                    <div class="mb-5 card">
                        <span class="card-body">
                            <a href="/{{ $shop->url }}" class="btn btn-outline-dark">
                                <i class='bx bx-store-alt'></i>
                                {{ $shop->name }}
                            </a>
                        </span>
                        <ul class="list-group">
                            @foreach ($shop->products as $item)
                                <li class="list-group-item">
                                    <a
                                        href="{{ route('product', ['shopURL' => $shop->url, 'prodName' => str_replace(' ', '-', $item->name)]) }}">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </section>

        </div>
    </main>
@endsection
