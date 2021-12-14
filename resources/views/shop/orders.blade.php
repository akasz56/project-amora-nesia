@extends('layouts.shop')

@section('page', 'Orders')

@section('container')
    <main class="container">
        <h1>Shop Orders</h1>
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif

        @if ($orders)
            @foreach ($orders as $order)
                <section class="mt-5">
                    <p>
                        {{ $order->created_at->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }} |
                        {{ $order->created_at->locale('id_ID')->isoFormat('h:mm:ss') }} |
                        <small>{{ $order->orderUUID }}</small>
                        <br>
                    </p>
                    <hr>
                    <h5><strong>Status Pesanan</strong> : {{ $orderstatuses[$order->status - 1]->name }}</h5>
                    @foreach ($order->orderItems as $item)
                        <div class="border border-primary border-1 p-3">
                            <h3>{{ $item->product->name }}</h3>
                            {{-- <p>{{ $item->product_type->name }} | {{ $item->product_wrap->name }} |
                                {{ $item->product_size->name }}</p> --}}
                            <h5>{{ $orderstatuses[$item->statusID - 1]->name }}</h5>
                        </div>
                    @endforeach
                    @if ($order->status < 10)
                        <a href="{{ route('shop.orderUUID', ['uuid' => $item->orderUUID]) }}"
                            class="btn btn-primary">Detail Pesanan</a>
                    @endif
                </section>
            @endforeach
        @else
            Belum Ada Pesanan
        @endif
    </main>
@endsection
