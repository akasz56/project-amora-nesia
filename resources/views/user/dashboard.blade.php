@extends('layouts.user')

@section('container')
    <main class="container">
        <h1>User Dashboard</h1>

        <hr>

        <section>
            <h3>Nama</h3>
            <p>{{ $user->name }}</p>
            <h3>Email</h3>
            <p>{{ $user->email }}</p>
        </section>

        <hr>

        <form action="#" method="POST">
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="provinceID" class="form-label">Provinsi</label>
                    <select class="form-select" id="provinceID" name="provinceID">
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
                    <input type="text" class="form-control" name="city" value="{{ $address->city }}" required>
                    @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            {{-- rt  rw --}}
            <div class="mb-3 row">
                <div class="col-6">
                    <label for="rw" class="form-label">RW</label>
                    <input type="number" class="form-control" name="rw" value="{{ $address->rw }}" required>
                    @error('rw')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-6">
                    <label for="rt" class="form-label">RT</label>
                    <input type="number" class="form-control" name="rt" value="{{ $address->rt }}" required>
                    @error('rt')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            {{-- address  postcode --}}
            <div class="mb-3 row">
                <div class="col-8">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="address" value="{{ $address->address }}" required>
                    @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-4">
                    <label for="postcode" class="form-label">Kode Pos</label>
                    <input type="number" class="form-control" name="postcode" value="{{ $address->postcode }}"
                        required>
                    @error('postcode')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </main>
@endsection
