@extends('layouts.app')

@section('title', 'Daftar - Amora')

@section('content')
<div class="container form-center">
    <form action="{{ route('register.post') }}" method="POST" class="card card-body shadow">
        @csrf
        @if ( session()->has('fail') )
        <div class="alert alert-danger">{{ session()->get('fail') }}</div>
        @endif
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required
                placeholder="Nama Lengkap">
            @error("nama")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required
                placeholder="contoh@email.com">
            @error("email")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" class="form-control" name="password" required placeholder="Kata Sandi">
            @error("password")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <label for="password-confirmation" class="form-label">Ulang Kata Sandi</label>
            <input type="password" class="form-control" name="password-confirmation" required placeholder="Kata Sandi">
            @error("password-confirmation")<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mt-2 mb-3 d-flex flex-column flex-md-row justify-content-end align-items-end">
            <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
    </form>
</div>
@endsection