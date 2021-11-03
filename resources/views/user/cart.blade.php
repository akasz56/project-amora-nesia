@extends('layouts.user')

@section('page', 'Hi, ' . Auth::user()->name)

@section('container')
    <main class="container">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif
        <h1>User Cart</h1>

        @if ($cart->isNotEmpty())
            <section class="mt-3 row">
                <form action="{{ route('cart.submit') }}" method="POST" class="col-lg-6 p-3">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 p-3">
                        Checkout semua barang
                    </button>
                </form>
                <form action="{{ route('user.cart.deleteAll') }}" method="POST" class="col-lg-6 p-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 p-3"
                        onclick="return confirm('Yakin menghapus SEMUA produk dari keranjang?')">
                        Kosongkan Keranjang
                    </button>
                </form>
            </section>
            <hr>

            @foreach ($cart as $item)
                <form action="{{ route('user.cart.delete') }}" method="POST" class="mt-5 position-relative">
                    @include('components.product-preview', ['item' => $item->product, 'cart' => $item])
                    @csrf
                    <button type="submit" class="btn btn-danger wishlist-remove rounded-0" name="cartID"
                        value="{{ $item->id }}" onclick="return confirm('Yakin menghapus produk dari keranjang?')">
                        Hapus dari Keranjang
                    </button>
                </form>
            @endforeach
        @else
            Keranjangmu masih kosong
        @endif
    </main>
@endsection
