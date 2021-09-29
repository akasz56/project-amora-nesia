@extends('layouts.shop')

@section('page', 'Orders')

@section('container')
<main class="container">
    <h1>Shop Orders</h1>
    @foreach ($orders as $order)
    <div class="mt-5">
        <h2>{{ $order->orderUUID }}</h2>
        <hr>
        @foreach ($order->orderitems as $item)
        <h3>{{ $item->product->name }}</h3>
        <p>{{ $item->product_type->name }} | {{ $item->product_wrap->name }} | {{ $item->product_size->name }}</p>
        @endforeach
        <a href="#" class="btn btn-primary">Detail Pesanan</a>
    </div>
    @endforeach
</main>
@endsection