@extends('layouts.app')

@section('title', 'Daftar Toko - Amora')

@section('content')
    <main class="container form-center">
        <form action="{{ route('shop.register') }}" method="POST" class="card card-body shadow">
            @csrf
            @if (session()->has('fail'))
                <div class="alert alert-danger">{{ session()->get('fail') }}</div>
            @endif
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Toko</label>
                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required
                    placeholder="Nama Lengkap">
                @error('nama')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Alamat URL</label>
                <div class="d-flex align-items-center">
                    <span class="me-1">Amorastore.id/shop/ </span>
                    <input type="text" class="form-control" name="url" value="{{ old('url') }}" required
                        placeholder="nama-toko">
                </div>
                @error('url')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <label class="form-label">Alamat Toko</label>
            <div class="mb-3 form-check">
                <label class="form-check-label" for="sameAddress">Sama dengan alamat saya saat ini</label>
                <input class="form-check-input" type="checkbox" value="true" name="sameAddress">
            </div>
            <div class="mt-2 mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Daftarkan Toko</button>
            </div>

            <hr>
            {{-- provinceID  city --}}
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="provinceID" class="form-label">Provinsi</label>
                    <select class="form-select" id="provinceID" name="provinceID">
                        <option value="" hidden>Pilih satu</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('provinceID')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="city" class="form-label">Kota</label>
                    <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                    @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            {{-- rt  rw --}}
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="rw" class="form-label">RW</label>
                    <input type="number" class="form-control" name="rw" value="{{ old('rw') }}" required>
                    @error('rw')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="rt" class="form-label">RT</label>
                    <input type="number" class="form-control" name="rt" value="{{ old('rt') }}" required>
                    @error('rt')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            {{-- address  postcode --}}
            <div class="mb-3 row">
                <div class="col-8">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                    @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-4">
                    <label for="postcode" class="form-label">Kode Pos</label>
                    <input type="number" class="form-control" name="postcode" value="{{ old('postcode') }}" required>
                    @error('postcode')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <hr>
            <div class="mt-2 mb-3 d-flex flex-column flex-md-row justify-content-end align-items-end">
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
        </form>
    </main>
@endsection
