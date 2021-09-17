@extends('layouts.shop')

@section('page', 'Daftar Produk')

@section('container')
<main class="container">
    <h1>Shop Products</h1>
    @if ($products)
    @foreach ($products as $item)
        <a href="{{ route('shop.product.byID', ['prodID' => $item['publicID']]) }}" class="mt-5">{{ ucwords($item['name']) }}</a>
        <hr>
    @endforeach
    @endif
    <a href="{{ route('shop.product.add') }}" class="btn btn-primary w-100">Add Product</a>
</main>
@endsection