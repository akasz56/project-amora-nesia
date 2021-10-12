@extends('layouts.user')

@section('page', 'Hi, ' . $user->name)

@section('container')
    <main class="container">
        <h1>User Dashboard</h1>
        <hr>

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif

        <section>
            <h3>Nama</h3>
            <p>{{ $user->name }}</p>
            <h3>Email</h3>
            <p>{{ $user->email }}</p>
        </section>

        <h2 class="mt-5">Alamat</h2>
        <hr>
        <form action="{{ route('user.bio.updateAddress') }}" method="POST">
            @csrf
            @if ($isAddressSame)
                <small class="text-primary">
                    Alamat Akun ini sama dengan Alamat Toko anda
                </small>
            @endif
            <div class="my-3 row">
                <div class="col-6">
                    <label for="provinceID" class="form-label">Provinsi</label>
                    <select class="form-select" id="provinceID" id="provinceID" name="provinceID">
                        <option value="" hidden>Pilih satu</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item->id }}"
                                {{ $var = $item->id == $user->address->provinceID ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('provinceID')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="city" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $user->address->city }}"
                        required>
                    @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="rw" class="form-label">RW</label>
                    <input type="number" class="form-control" id="rw" name="rw" value="{{ $user->address->rw }}"
                        required>
                    @error('rw')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="rt" class="form-label">RT</label>
                    <input type="number" class="form-control" id="rt" name="rt" value="{{ $user->address->rt }}"
                        required>
                    @error('rt')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-8">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $user->address->address }}" required>
                    @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-4">
                    <label for="postcode" class="form-label">Kode Pos</label>
                    <input type="number" class="form-control" id="postcode" name="postcode"
                        value="{{ $user->address->postcode }}" required>
                    @error('postcode')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan Alamat</button>
        </form>

    </main>
@endsection
