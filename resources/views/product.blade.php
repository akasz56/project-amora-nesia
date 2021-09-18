@extends('layouts.app')

@section('title', $product->name)

@section('content')
<main class="container">
    <p>{{ $product->publicID }}</p>
    <h1>{{ $product->name }}</h1>
    <hr>
    <p>{{ $product->description }}</p>
    <p>rating : {{ $product->rating }}</p>
    <p>viewers : {{ $product->viewers }}</p>

    <h2 class="mt-5">Types</h2>
    <hr>
    @foreach ($types as $item)
        <h3>{{ $item->name }}</h3>
        <p>{{ $item->color }}</p>
        <p>{{ $item->stock }}</p>
        <p>{{ $item->price }}</p>
    @endforeach

    <h2 class="mt-5">Wraps</h2>
    <hr>
    @foreach ($wraps as $item)
        <h3>{{ $item->name }}</h3>
        <p>{{ $item->color }}</p>
        <p>{{ $item->stock }}</p>
        <p>{{ $item->price }}</p>
    @endforeach
    
    <h2 class="mt-5">Sizes</h2>
    <hr>
    @foreach ($sizes as $item)
        <h3>{{ $item->name }}</h3>
        <p>{{ $item->color }}</p>
        <p>{{ $item->stock }}</p>
        <p>{{ $item->price }}</p>
    @endforeach
</main>
@endsection