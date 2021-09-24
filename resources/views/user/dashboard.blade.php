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
        <h3>Provinsi</h3>
        <div class="mb-3">
            {{ $address->province() }}
        </div>
        <h3>Kota</h3>
        <div class="mb-3">
            <input type="city" class="form-control" name="city" value="{{ $address->city }}" required>
            @error("city")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <h3>Alamat</h3>
        <div class="mb-3">
            <input type="address" class="form-control" name="address" value="{{ $address->address }}" required>
            @error("address")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <h3>RW</h3>
        <div class="mb-3">
            <input type="rw" class="form-control" name="rw" value="{{ $address->rw }}" required>
            @error("rw")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <h3>RT</h3>
        <div class="mb-3">
            <input type="rt" class="form-control" name="rt" value="{{ $address->rt }}" required>
            @error("rt")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <h3>Kode Pos</h3>
        <div class="mb-3">
            <input type="postcode" class="form-control" name="postcode" value="{{ $address->postcode }}" required>
            @error("postcode")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</main>
@endsection