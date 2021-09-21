@extends('layouts.app')

@section('title', 'Categories - Amora Store')

@section('content')
<main class="container">
    <h1>Categories Page</h1>

    @foreach ($shops as $shop)
    <h2><a href="{{ $shop->url }}">{{ $shop->name }}</a></h2>
    <hr>
    @foreach ($shop->products as $item)
    <a href="{{ route('product', ['shopURL' => $shop->url, 'prodName' =>str_replace(" ", "-", $item->name)]) }}">
        {{ $item->name }}
    </a>
    <br>
    @endforeach
    <br>
    <br>
    @endforeach
</main>
@endsection