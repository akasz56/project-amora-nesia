@extends('layouts.shop')

@section('page', 'Order ' . $order->orderUUID)

@section('container')
    <main class="container">
        <h1>{{ $order->orderUUID }}</h1>
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif
        <p>Nama Tujuan : {{ $order->nameSend }}</p>
        <p>Nomor Telepon : {{ $order->phone }}</p>
        <p>Nomor Whatsapp : {{ $order->whatsapp }}</p>
        <p>Provinsi : {{ $provinces[$order->provinceID - 1]->name }}</p>
        <p>Kota : {{ $order->city }}</p>
        <p>{{ $order->address }} | RT {{ $order->rt }} | RW {{ $order->rw }}</p>
        <p>Kode Pos : {{ $order->postcode }}</p>
        <hr>
        @foreach ($orderitems as $item)
            {{-- OrderItem Info --}}
            @include('components.product-preview', ['item' => $item->product, 'class' => 'mb-3', 'orderStatus' =>
            $item->statusID, 'role' => 'shop', 'orderItemID'=> $item->id])
            {{-- <h3>{{ $item->product->name }}</h3> --}}
            {{-- <p>{{ $item->product_type->name }} | {{ $item->product_wrap->name }} | {{ $item->product_size->name }}
            </p> --}}
        @endforeach
    </main>
@endsection
