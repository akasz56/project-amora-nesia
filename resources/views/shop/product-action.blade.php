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
        @if (session()->has('typeDanger'))
            <div class="alert alert-danger">{{ session()->get('typeDanger') }}</div>
        @endif
        @foreach ($types as $item)
            <div class="row my-3">
                <form action="{{ route('shop.product.spec.update') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="col-2 me-2" value="{{ $item->name }}">
                    <input type="text" name="variable" class="col-2 me-2" value="{{ $item->color }}">
                    <input type="number" name="stock" class="col-2 me-2" value="{{ $item->stock }}">
                    <input type="number" name="price" class="col-2 me-2" value="{{ $item->price }}">
                    <input type="hidden" name="specification" value="type">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-success">Save</button>
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
        @if (session()->has('wrapDanger'))
            <div class="alert alert-danger">{{ session()->get('wrapDanger') }}</div>
        @endif
        @foreach ($wraps as $item)
            <div class="row my-3">
                <form action="{{ route('shop.product.spec.update') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="col-2 me-2" value="{{ $item->name }}">
                    <input type="text" name="variable" class="col-2 me-2" value="{{ $item->color }}">
                    <input type="number" name="stock" class="col-2 me-2" value="{{ $item->stock }}">
                    <input type="number" name="price" class="col-2 me-2" value="{{ $item->price }}">
                    <input type="hidden" name="specification" value="wrap">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-success">Save</button>
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
        @if (session()->has('sizeDanger'))
            <div class="alert alert-danger">{{ session()->get('sizeDanger') }}</div>
        @endif
        @foreach ($sizes as $item)
            <div class="row my-3">
                <form action="{{ route('shop.product.spec.update') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="col-2 me-2" value="{{ $item->name }}">
                    <input type="text" name="variable" class="col-2 me-2" value="{{ $item->flower_amount }}">
                    <input type="number" name="stock" class="col-2 me-2" value="{{ $item->stock }}">
                    <input type="number" name="price" class="col-2 me-2" value="{{ $item->price }}">
                    <input type="hidden" name="specification" value="size">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-success">Save</button>
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
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin menghapus?')">Delete
                Product</button>
        </form>
    </main>
@endsection
