@extends('layouts.shop')

@section('page', $product->name . ' - produk')

@section('container')
<main class="container">
    {{-- nama --}}
    <h1>{{ ucwords($product->name) }}</h1>
    <a href="#">Ubah nama</a>
    <hr>

    <div class="row">
        <div class="col-6">Produk dilihat : {{ $product->viewers }}</div>
        <div class="col-6">Rating Produk : {{ $product->rating }}</div>
    </div>

    {{-- deskripsi --}}
    <h2 class="mt-5">Deskripsi Produk</h2>
    <form action="{{ route('shop.product-update') }}" method="POST">
        @csrf
        <input type="hidden" name="productID" value="{{ $product->id }}">
        @if (isset($product->description))
        <textarea class="form-control" name="desc" required placeholder="Deskripsi Produk" rows="6">{{ $product->description }}</textarea>
        @else
        <textarea class="form-control" name="desc" required placeholder="Deskripsi Produk" rows="6"></textarea>
        @endif
        <button type="submit">Submit</button>
    </form>


    {{-- type --}}
    <form action="{{ route('shop.product-spec-add.post') }}" method="POST">
        @csrf
        <h2 class="mt-5">Jenis Bunga</h2>
        <hr>
        <input type="hidden" name="productID" value="{{ $product->id }}">
        <input type="hidden" name="specification" value="type">
        <button class="btn btn-primary" type="submit">+ Tambah Jenis Bunga</button>
    </form>

    {{-- wrap --}}
    <form action="{{ route('shop.product-spec-add.post') }}" method="POST">
        @csrf
        <h2 class="mt-5">Jenis Bungkus</h2>
        <hr>
        <input type="hidden" name="productID" value="{{ $product->id }}">
        <input type="hidden" name="specification" value="wrap">
        <button class="btn btn-primary" type="submit">+ Tambah Jenis Bungkus</button>
    </form>

    {{-- size --}}
    <form action="{{ route('shop.product-spec-add.post') }}" method="POST">
        @csrf
        <h2 class="mt-5">Ukuran</h2>
        <hr>
        <input type="hidden" name="productID" value="{{ $product->id }}">
        <input type="hidden" name="specification" value="size">
        <button class="btn btn-primary" type="submit">+ Tambah Ukuran</button>
    </form>
</main>
@endsection