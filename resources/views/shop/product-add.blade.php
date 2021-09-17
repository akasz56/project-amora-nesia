@extends('layouts.shop')

@section('page', 'Tambah Produk')

@section('container')
<section class="form-center">
    <form action="{{ route('shop.product.add.post') }}" method="POST" class="card card-body shadow">
        @csrf
        @if ( session()->has('fail') )
        <div class="alert alert-danger">{{ session()->get('fail') }}</div>
        @endif
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required
                placeholder="Nama Produk">
            @error("nama")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" name="desc" value="{{ old('desc') }}" required placeholder="Deskripsi Produk"
                rows="6"></textarea>
            @error("desc")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mt-2 mb-3 d-flex flex-column flex-md-row justify-content-end align-items-end">
            <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
    </form>
</section>
@endsection