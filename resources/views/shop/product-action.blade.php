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
    @if (isset($product->desc))
    <textarea class="form-control" name="desc" required placeholder="Deskripsi Produk" rows="6">{{ $product->desc }}</textarea>
    @else
    <textarea class="form-control" name="desc" required placeholder="Deskripsi Produk" rows="6"></textarea>
    @endif

    {{-- type --}}
    <h2 class="mt-5">Jenis Bunga</h2>
    <hr>
    <a href="#">+ Tambah Jenis Bunga</a>
    {{-- wrap --}}
    <h2 class="mt-5">Jenis Bungkus</h2>
    <hr>
    <a href="#">+ Tambah Jenis Bungkus</a>
    {{-- size --}}
    <h2 class="mt-5">Ukuran</h2>
    <hr>
    <a href="#">+ Tambah Ukuran</a>
</main>
@endsection