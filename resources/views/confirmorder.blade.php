@extends('layouts.app')

@section('title', 'Confirm Order - Amora Store')

@section('content')
<main class="container">
    <h2>Konfirmasi 1 Pesanan : {{ $product->name }}</h2>
    <hr>
    <p>Jenis Bunga : {{ $type->name }}</p>
    <p>Bungkus Bucket : {{ $wrap->name }}</p>
    <p>Ukuran Bucket : {{ $size->name }}</p>
    <p>Extras : </p>

    <form action="{{ route('order.create') }}" method="POST">
        @csrf
        <input type="hidden" name="product" value="{{ $product->id }}" required>
        <input type="hidden" name="type" value="{{ $type->id }}" required>
        <input type="hidden" name="wrap" value="{{ $wrap->id }}" required>
        <input type="hidden" name="size" value="{{ $size->id }}" required>
        <h2>Promo code</h2>
        <hr>
        <label for="promo">Promo code</label>
        <input type="text" name="promo" id="promo">

        <h2>Pembayaran</h2>
        <hr>
        <input type="radio" name="payment" id="bank" required>
        <label for="bank">bank</label><br>
        <input type="radio" name="payment" id="ewallet">
        <label for="ewallet">ewallet</label><br>
        <input type="radio" name="payment" id="indomaret">
        <label for="indomaret">indomaret/alfamart</label><br>

        <h2>Pengiriman</h2>
        <hr>
        <input type="checkbox" name="alamat" id="alamat" required>
        <label for="alamat">Kirim ke Alamat Pengguna</label><br>
        <input type="checkbox" name="pengiriman" id="pengiriman" required>
        <label for="pengiriman">Delivery Toko</label><br>

        <hr>

        <button type="submit" class="btn btn-primary">Lanjutkan</button>
    </form>
</main>
@endsection