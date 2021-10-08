@extends('layouts.user')

@section('container')
    <main class="container">
        <h1>User History</h1>
        @if ($orders)
            @foreach ($orders as $order)
                <p class="mt-5">
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
                <a href="{{ route('order.actions', ['uuid' => $order->orderUUID]) }}" class="btn btn-primary">Detail
                    Pesanan</a>
                <a href="#" class="btn btn-danger">Batalkan Pesanan</a>
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
            @endforeach
        @else
            Anda belum pernah memesan
        @endif
    </main>
@endsection
