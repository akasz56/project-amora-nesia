@extends('layouts.shop')

@section('page', 'Dashboard')

@section('container')
    <main class="container">
        <h1>{{ $shop->name }} Dashboard</h1>

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif

        {{-- Identity --}}
        <h2>Identitas</h2>
        <hr>
        @if ($shop->email == null)
            <div class="mb-3">
                <label for="email" class="form-label d-block">Email Toko</label>
                <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#addEmail">
                    + Isi Email Toko
                </button>
            </div>
        @else
            <form action="#" method="POST" class="mb-3">
                <label for="email" class="form-label">Email Toko</label>
                <input type="email" class="form-control" id="email" value="{{ $shop->email }}" readonly>
            </form>
        @endif

        <form action="{{ route('shop.bio.updateBiodata') }}" method="POST">
            @csrf
            <label for="url" class="form-label">URL</label>
            <div class="mb-3 d-flex align-baseline">
                <div class="align-self-center me-1">Amorastore.id/shop/</div>
                <input type="text" class="form-control flex-grow-1" id="url" value="{{ $shop->url }}" readonly>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Deskripsi Toko</label>
                <textarea class="form-control" id="desc" name="desc" placeholder="Deskripsi Toko"
                    rows="6">{{ $shop->desc }}</textarea>
                @error('desc')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="phone" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="{{ $shop->phone }}">
                    @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="whatsapp" class="form-label">No. Whatsapp</label>
                    <input type="number" class="form-control" id="whatsapp" name="whatsapp"
                        value="{{ $shop->whatsapp }}">
                    @error('whatsapp')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan Identitas</button>
        </form>

        {{-- address --}}
        <h2 class="mt-5">Alamat</h2>
        <hr>
        <form action="{{ route('shop.bio.updateAddress') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="provinceID" class="form-label">Provinsi</label>
                    <select class="form-select" id="provinceID" id="provinceID" name="provinceID">
                        <option value="" hidden>Pilih satu</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item->id }}"
                                {{ $var = $item->id == $address->provinceID ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('provinceID')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="city" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $address->city }}"
                        required>
                    @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="rw" class="form-label">RW</label>
                    <input type="number" class="form-control" id="rw" name="rw" value="{{ $address->rw }}" required>
                    @error('rw')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="rt" class="form-label">RT</label>
                    <input type="number" class="form-control" id="rt" name="rt" value="{{ $address->rt }}" required>
                    @error('rt')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-8">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $address->address }}"
                        required>
                    @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-4">
                    <label for="postcode" class="form-label">Kode Pos</label>
                    <input type="number" class="form-control" id="postcode" name="postcode"
                        value="{{ $address->postcode }}" required>
                    @error('postcode')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan Alamat</button>
        </form>

        {{-- JavaScripts --}}
        <div class="modal fade" id="addEmail" tabindex="-1" aria-labelledby="addEmailLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('shop.bio.addEmail') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmailLabel">Tambah Email Toko</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="email" class="form-label">Email Toko</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="test@example.com">
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('yakin menambahkan email tersebut? Email tidak bisa diubah setelah disimpan')">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
