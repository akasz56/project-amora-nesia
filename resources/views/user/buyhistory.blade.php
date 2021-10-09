@extends('layouts.user')

@section('container')
    <main class="container">
        <h1>User History</h1>

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
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
                    <p>
                        <strong>Nama Tujuan</strong> : {{ $order->nameSend }} <br>
                        <strong>Nomor HP</strong> : {{ $order->phone }} <br>
                        <strong>Nomor Whatsapp</strong> : {{ $order->whatsapp }} <br>
                        <br>
                        <strong>Provinsi Tujuan</strong> : {{ $provinces[$order->provinceID - 1]->name }} <br>
                        <strong>Kota Tujuan</strong> : {{ $order->city }} <br>
                        <strong>Alamat Tujuan</strong> : {{ $order->address }} <br>
                        <strong>Kode Pos</strong> : {{ $order->postcode }}
                    </p>
                    <h5><strong>Status Pesanan</strong> : {{ $orderstatuses[$order->status - 1]->name }}</h5>
                    <a href="{{ route('order.actions', ['uuid' => $order->orderUUID]) }}" class="btn btn-primary">Detail
                        Pesanan</a>
                    @if ($order->status < 5)
                        <form action="{{ route('order.cancel') }}" method="POST">
                            @csrf
                            <button type="submit" name="uuid" value="{{ $order->orderUUID }}" class="btn btn-danger"
                                onclick="return confirm('Yakin membatalkan?')">Batalkan
                                Pesanan</button>
                        </form>
                    @else
                    @endif
                    @foreach ($order->orderItems as $item)
                        <div class="border border-primary border-1 p-3">
                            <a
                                href="{{ route('product', ['shopURL' => $item->shop->url, 'prodName' => str_replace(' ', '-', $item->product->name)]) }}">
                                {{ $item->product->name }}
                            </a>
                            from
                            <a href="{{ route('shop', ['shopURL' => $item->shop->url]) }}">
                                <strong>{{ $item->shop->name }}</strong>
                            </a>
                        </div>
                    @endforeach
                </section>
            @endforeach
        @else
            Anda belum pernah memesan
        @endif
    </main>
@endsection
