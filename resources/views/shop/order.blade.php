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
            @include('components.product-preview', ['item' => $item->product, 'class' => 'mb-3'])
            {{-- <h3>{{ $item->product->name }}</h3> --}}
            {{-- <p>{{ $item->product_type->name }} | {{ $item->product_wrap->name }} | {{ $item->product_size->name }}
            </p> --}}

            {{-- OrderItem Actions --}}
            @if ($item->statusID < 4)
                <form action="{{ route('shop.orderAction', ['uuid' => $order->orderUUID]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="orderItemID" value="{{ $item->id }}">
                    @if ($item->statusID == 1)
                        <div class="alert alert-primary">
                            Menunggu Pembayaran
                        </div>
                    @elseif ($item->statusID == 2)
                        <button type="submit" name="statusID" value="3" class="btn btn-primary">
                            Proses Pesanan
                        </button>
                    @elseif ($item->statusID == 3)
                        <button type="submit" name="statusID" value="4" class="btn btn-primary">
                            Kirim Pesanan
                        </button>
                    @endif
                    <button type="submit" name="statusID" value="10" class="btn btn-danger"
                        onclick="return confirm('Yakin utk membatalkan pesanan?')">
                        Batalkan Pesanan
                    </button>
                </form>
            @else
                @if ($item->statusID == 4)
                    <div class="alert alert-success">Produk dalam Perjalanan</div>
                @elseif ($item->statusID == 5)
                    <div class="alert alert-success">Pesanan Selesai</div>
                @elseif ($item->statusID == 10)
                    <div class="alert alert-danger">Pesanan dibatalkan</div>
                @endif
            @endif
            <hr>
        @endforeach
    </main>
@endsection
