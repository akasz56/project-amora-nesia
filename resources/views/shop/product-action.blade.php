@extends('layouts.shop')

@section('page', $product->name . ' - produk')

@section('container')
    <main class="container">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif
        {{-- nama --}}
        <h1>{{ ucwords($product->name) }}</h1>
        <a href="#">Ubah nama</a>
        <hr>

        <div class="row">
            <div class="col-6">Produk dilihat : {{ $product->viewers }}</div>
            <div class="col-6">Rating Produk : {{ $product->rating }}</div>
        </div>

        {{-- deskripsi --}}
        <h2 class="mt-5">Deskripsi Produk</h2>
        <form action="{{ route('shop.product.update') }}" method="POST">
            @csrf
            <input type="hidden" name="productID" value="{{ $product->id }}">
            @if (isset($product->description))
                <textarea class="form-control" name="desc" required placeholder="Deskripsi Produk"
                    rows="6">{{ $product->description }}</textarea>
            @else
                <textarea class="form-control" name="desc" required placeholder="Deskripsi Produk" rows="6"></textarea>
            @endif
            <button type="submit">Submit</button>
        </form>


        {{-- type --}}
        <h2 class="mt-5">Jenis Bunga</h2>
        <hr>
        @if (session()->has('typeError'))
            <div class="alert alert-danger">{{ session()->get('typeError') }}</div>
        @endif
        @foreach ($types as $item)
            <div class="row my-3">
                <div class="col-2 me-2">{{ $item->name }}</div>
                <div class="col-2 me-2">{{ $item->color }}</div>
                <div class="col-2 me-2">{{ $item->stock }}</div>
                <div class="col-2 me-2">{{ $item->price }}</div>
                <form action="{{ route('shop.product.spec.update') }}" method="POST" class="col-2 me-2">
                    @csrf
                    <input type="hidden" name="specification" value="type">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-primary">Edit</button>
                    <button type="submit" name="btn" value="delete" class="btn btn-danger"
                        onclick="return confirm('Yakin menghapus?')">Hapus</button>
                </form>
            </div>
        @endforeach
        <form action="{{ route('shop.product.spec.add') }}" method="POST">
            @csrf
            <input type="hidden" name="specification" value="type">
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <input type="text" name="name" class="col-2 me-2" placeholder="Nama Produk">
            <input type="text" name="variable" class="col-2 me-2" placeholder="Warna">
            <input type="number" name="stock" class="col-2 me-2" placeholder="Stok Produk">
            <input type="number" name="price" class="col-2 me-2" placeholder="Harga Produk">
            <button class="btn btn-primary" type="submit">+ Tambah Jenis Bunga</button>
        </form>

        {{-- wrap --}}
        <h2 class="mt-5">Jenis Bungkus</h2>
        <hr>
        @if (session()->has('wrapError'))
            <div class="alert alert-danger">{{ session()->get('wrapError') }}</div>
        @endif
        @foreach ($wraps as $item)
            <div class="row my-3">
                <div class="col-2 me-2">{{ $item->name }}</div>
                <div class="col-2 me-2">{{ $item->color }}</div>
                <div class="col-2 me-2">{{ $item->stock }}</div>
                <div class="col-2 me-2">{{ $item->price }}</div>
                <form action="{{ route('shop.product.spec.update') }}" method="POST" class="col-2 me-2">
                    @csrf
                    <input type="hidden" name="specification" value="wrap">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-primary">Edit</button>
                    <button type="submit" name="btn" value="delete" class="btn btn-danger"
                        onclick="return confirm('Yakin menghapus?')">Hapus</button>
                </form>
            </div>
        @endforeach
        <form action="{{ route('shop.product.spec.add') }}" method="POST">
            @csrf
            <input type="hidden" name="specification" value="wrap">
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <input type="text" name="name" class="col-2 me-2" placeholder="Nama Produk">
            <input type="text" name="variable" class="col-2 me-2" placeholder="Warna">
            <input type="number" name="stock" class="col-2 me-2" placeholder="Stok Produk">
            <input type="number" name="price" class="col-2 me-2" placeholder="Harga Produk">
            <button class="btn btn-primary" type="submit">+ Tambah Jenis Bungkus</button>
        </form>

        {{-- size --}}
        <h2 class="mt-5">Ukuran</h2>
        <hr>
        @if (session()->has('sizeError'))
            <div class="alert alert-danger">{{ session()->get('sizeError') }}</div>
        @endif
        @foreach ($sizes as $item)
            <div class="row my-3">
                <div class="col-2 me-2">{{ $item->name }}</div>
                <div class="col-2 me-2">{{ $item->flower_amount }}</div>
                <div class="col-2 me-2">{{ $item->stock }}</div>
                <div class="col-2 me-2">{{ $item->price }}</div>
                <form action="{{ route('shop.product.spec.update') }}" method="POST" class="col-2 me-2">
                    @csrf
                    <input type="hidden" name="specification" value="size">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-primary">Edit</button>
                    <button type="submit" name="btn" value="delete" class="btn btn-danger"
                        onclick="return confirm('Yakin menghapus?')">Hapus</button>
                </form>
            </div>
        @endforeach
        <form action="{{ route('shop.product.spec.add') }}" method="POST">
            @csrf
            <input type="hidden" name="specification" value="size">
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <input type="text" name="name" class="col-2 me-2" placeholder="Nama Produk">
            <input type="text" name="variable" class="col-2 me-2" placeholder="Warna">
            <input type="number" name="stock" class="col-2 me-2" placeholder="Stok Produk">
            <input type="number" name="price" class="col-2 me-2" placeholder="Harga Produk">
            <button class="btn btn-primary" type="submit">+ Tambah Ukuran</button>
        </form>

        <h2 class="mt-5">Danger Zone</h2>
        <hr>
        <form action="{{ route('shop.product.delete') }}" method="POST">
            @csrf
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <button type="submit" class="btn btn-danger">Delete Product</button>
        </form>
    </main>
@endsection
