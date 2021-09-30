@extends('layouts.shop')

@section('page', 'Orders')

@section('container')
    <main class="container">
        <h1>Shop Orders</h1>
        @if (session()->has('noOrder'))
            <div class="alert alert-danger">{{ session()->get('noOrder') }}</div>
        @endif

        @if ($orders)
            @foreach ($orders as $order)
                <div class="mt-5">
                    <h2>{{ $order->orderUUID }}</h2>
                    <hr>
                    @foreach ($order->orderItems as $item)
                        <h3>{{ $item->product->name }}</h3>
                        <p>{{ $item->product_type->name }} | {{ $item->product_wrap->name }} |
                            {{ $item->product_size->name }}</p>
                    @endforeach
                    <a href="{{ route('shop.orderUUID', ['uuid' => $item->orderUUID]) }}" class="btn btn-primary">Detail
                        Pesanan</a>
                </div>
            @endforeach
        @else
            Belum Ada Pesanan
        @endif
    </main>
@endsection
