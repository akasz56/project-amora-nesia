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

        {{-- Foto --}}
        <h2 class="mt-5">Foto Produk</h2>
        <div class="row">
            @foreach ($product->photos as $photo)
                <div class="col-2">
                    <button type="button" class="btn p-0" data-bs-toggle="modal"
                        data-bs-target="{{ '#editPhoto' . $photo->id }}">
                        <img src="{{ asset($photo->blob) }}" alt="Foto Produk" class="img-fluid">
                    </button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#addPhoto">
            + Tambah Foto Produk
        </button>

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
            <button type="submit" class="btn btn-success mt-2">Simpan Deskripsi</button>
        </form>


        {{-- type --}}
        <h2 class="mt-5">Jenis Bunga</h2>
        <hr>
        @if (session()->has('typeDanger'))
            <div class="alert alert-danger">{{ session()->get('typeDanger') }}</div>
        @endif
        @foreach ($product->types as $item)
            <div class="row my-3">
                <form action="{{ route('shop.product.spec.update') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="col-2 me-2" value="{{ $item->name }}">
                    <input type="text" name="variable" class="col-2 me-2" value="{{ $item->color }}">
                    <input type="number" name="stock" class="col-2 me-2" value="{{ $item->stock }}">
                    <input type="number" name="price" class="col-2 me-2" value="{{ $item->price }}">
                    <input type="hidden" name="specification" value="type">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-success">Simpan</button>
                    <button type="submit" name="btn" value="delete" class="btn btn-danger"
                        onclick="return confirm('Yakin menghapus?')">Hapus</button>
                </form>
            </div>
        @endforeach
        <form action="{{ route('shop.product.spec.add') }}" method="POST">
            @csrf
            <input type="hidden" name="specification" value="type">
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <input type="text" name="name" class="col-2 me-2" placeholder="Nama">
            <input type="text" name="variable" class="col-2 me-2" placeholder="Warna">
            <input type="number" name="stock" class="col-2 me-2" placeholder="Stok Barang">
            <input type="number" name="price" class="col-2 me-2" placeholder="Harga">
            <button class="btn btn-primary" type="submit">+ Tambah Jenis Bunga</button>
        </form>

        {{-- wrap --}}
        <h2 class="mt-5">Jenis Bungkus</h2>
        <hr>
        @if (session()->has('wrapDanger'))
            <div class="alert alert-danger">{{ session()->get('wrapDanger') }}</div>
        @endif
        @foreach ($product->wraps as $item)
            <div class="row my-3">
                <form action="{{ route('shop.product.spec.update') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="col-2 me-2" value="{{ $item->name }}">
                    <input type="text" name="variable" class="col-2 me-2" value="{{ $item->color }}">
                    <input type="number" name="stock" class="col-2 me-2" value="{{ $item->stock }}">
                    <input type="number" name="price" class="col-2 me-2" value="{{ $item->price }}">
                    <input type="hidden" name="specification" value="wrap">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-success">Simpan</button>
                    <button type="submit" name="btn" value="delete" class="btn btn-danger"
                        onclick="return confirm('Yakin menghapus?')">Hapus</button>
                </form>
            </div>
        @endforeach
        <form action="{{ route('shop.product.spec.add') }}" method="POST">
            @csrf
            <input type="hidden" name="specification" value="wrap">
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <input type="text" name="name" class="col-2 me-2" placeholder="Nama">
            <input type="text" name="variable" class="col-2 me-2" placeholder="Warna">
            <input type="number" name="stock" class="col-2 me-2" placeholder="Stok Barang">
            <input type="number" name="price" class="col-2 me-2" placeholder="Harga">
            <button class="btn btn-primary" type="submit">+ Tambah Jenis Bungkus</button>
        </form>

        {{-- size --}}
        <h2 class="mt-5">Ukuran</h2>
        <hr>
        @if (session()->has('sizeDanger'))
            <div class="alert alert-danger">{{ session()->get('sizeDanger') }}</div>
        @endif
        @foreach ($product->sizes as $item)
            <div class="row my-3">
                <form action="{{ route('shop.product.spec.update') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="col-2 me-2" value="{{ $item->name }}">
                    <input type="text" name="variable" class="col-2 me-2" value="{{ $item->flower_amount }}">
                    <input type="number" name="stock" class="col-2 me-2" value="{{ $item->stock }}">
                    <input type="number" name="price" class="col-2 me-2" value="{{ $item->price }}">
                    <input type="hidden" name="specification" value="size">
                    <input type="hidden" name="specID" value="{{ $item->id }}">
                    <button type="submit" name="btn" value="edit" class="btn btn-success">Simpan</button>
                    <button type="submit" name="btn" value="delete" class="btn btn-danger"
                        onclick="return confirm('Yakin menghapus?')">Hapus</button>
                </form>
            </div>
        @endforeach
        <form action="{{ route('shop.product.spec.add') }}" method="POST">
            @csrf
            <input type="hidden" name="specification" value="size">
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <input type="text" name="name" class="col-2 me-2" placeholder="Nama">
            <input type="text" name="variable" class="col-2 me-2" placeholder="Jumlah Bunga">
            <input type="number" name="stock" class="col-2 me-2" placeholder="Stok Barang">
            <input type="number" name="price" class="col-2 me-2" placeholder="Harga">
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

        {{-- JavaScripts --}}
        <div class="modal fade" id="addPhoto" tabindex="-1" aria-labelledby="addPhotoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('shop.product.photo.add') }}" method="POST" enctype="multipart/form-data"
                    class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPhotoLabel">Add Product Photo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="productID" value="{{ $product->id }}">
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="photo" class="form-label">File Foto</label>
                            <input type="file" name="photo" id="photo" class="border border-dark p-2">
                            @error('photo')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption foto</label>
                            <input type="text" class="form-control" name="caption" value="{{ old('caption') }}"
                                placeholder="Caption Foto">
                            @error('caption')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        @foreach ($product->photos as $photo)
            <div class="modal fade" id="{{ 'editPhoto' . $photo->id }}" tabindex="-1"
                aria-labelledby="{{ 'editPhoto' . $photo->id . 'Label' }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('shop.product.photo.update') }}" method="POST" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="{{ 'editPhoto' . $photo->id . 'Label' }}">
                                Edit Foto
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <input type="hidden" name="photoID" value="{{ $photo->id }}">
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset($photo->blob) }}" alt="Foto Produk" class="img-fluid mb-5">
                            <label for="caption" class="form-label">Caption foto</label>
                            <input type="text" class="form-control" name="caption" value="{{ $photo->caption }}"
                                placeholder="Caption Foto">
                            @error('caption')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="btn" value="delete"
                                onclick="return confirm('Yakin menghapus foto?')">Hapus Foto</button>
                            <button type="submit" class="btn btn-primary" name="btn" value="edit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

    </main>
@endsection
