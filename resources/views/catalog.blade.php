@extends('layouts.app')

@section('title', 'Katalog - Amora Store')

@section('content')
    <main class="container">
        <h1>Semua Produk di Amora Store</h1>
        @foreach ($shops as $shop)
            <h2><a href="{{ $shop->url }}">{{ $shop->name }}</a></h2>
            <hr>
            @foreach ($shop->products as $item)
                <a
                    href="{{ route('product', ['shopURL' => $shop->url, 'prodName' => str_replace(' ', '-', $item->name)]) }}">
                    {{ $item->name }}
                </a>
                <br>
            @endforeach
            <br>
            <br>
        @endforeach
    </main>
@endsection
