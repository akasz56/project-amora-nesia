@extends('layouts.user')

@section('page', 'Hi, ' . Auth::user()->name)

@section('container')
    <main class="container">
        <h1>User History</h1>

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif

        <div class="mt-5"></div>

        @if ($orders)
            @foreach ($orders as $order)
                <section class="mb-5 card">

                    <span class="card-body">
                        {{ $order->created_at->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }} |
                        <span class="fw-bold">{{ ucwords($orderstatuses[$order->status - 1]->name) }}</span> |
                        {{ $order->orderUUID }}
                    </span>

                    <ul class="list-group list-group-flush">
                        @foreach ($order->orderItems as $item)
                            <li class="list-group-item">
                                <a
                                    href="{{ route('product', ['shopURL' => $item->shop->url, 'prodName' => str_replace(' ', '-', $item->product->name)]) }}">
                                    {{ $item->product->name }}
                                </a>
                                dari toko
                                <a href="{{ route('shop', ['shopURL' => $item->shop->url]) }}">
                                    <strong>{{ $item->shop->name }}</strong>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('order.cancel') }}" method="POST" class="card-body">
                        @csrf
                        <a href="{{ route('order.actions', ['uuid' => $order->orderUUID]) }}" class="btn btn-primary">
                            Detail Pesanan
                        </a>
                        @if ($order->status < 5)
                            <button type="submit" name="uuid" value="{{ $order->orderUUID }}" class="btn btn-danger"
                                onclick="return confirm('Yakin membatalkan?')">
                                Batalkan Pesanan
                            </button>
                        @endif
                    </form>

                </section>
            @endforeach
        @else
            Anda belum pernah memesan
        @endif
    </main>
@endsection
