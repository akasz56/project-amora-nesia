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
        <h1>User Wishlist</h1>
        @if ($wishlist)
            @foreach ($wishlist as $item)
                <form action="{{ route('user.wishlist.delete') }}" method="POST" class="mt-5 position-relative">
                    @include('components.product-preview', ['item' => $item->product])
                    @csrf
                    <button type="submit" class="btn btn-danger wishlist-remove rounded-0" name="wishlistID"
                        value="{{ $item->id }}" onclick="return confirm('Yakin menghapus produk dari wishlist?')">
                        Hapus dari Wishlist
                    </button>
                </form>
            @endforeach
        @else
            Wishlistmu masih kosong
        @endif
    </main>
@endsection
