@extends('layouts.app')

@section('title', 'Daftar Toko - Amora')

@section('content')
<main class="container form-center">
    <form action="{{ route('shop.register') }}" method="POST" class="card card-body shadow">
        @csrf
        @if ( session()->has('fail') )
        <div class="alert alert-danger">{{ session()->get('fail') }}</div>
        @endif
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Toko</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required
                placeholder="Nama Lengkap">
            @error("nama")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Alamat URL</label>
            <div class="d-flex align-items-center">
                <span class="me-1">Amorastore.id/shop/ </span>
                <input type="text" class="form-control" name="url" value="{{ old('url') }}" required
                placeholder="nama-toko">
            </div>
            @error("url")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <label class="form-label">Alamat Toko</label>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="sameAddress">Sama dengan alamat saya saat ini</label>
            <input class="form-check-input" type="checkbox" value="" name="sameAddress">
        </div>
        <div class="mt-2 mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Daftarkan Toko</button>
        </div>
    </form>
</main>
@endsection