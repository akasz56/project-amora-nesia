@extends('layouts.app')

@section('title', 'Masuk - Amora')

@section('content')
<div class="container form-center">
    <form action="{{ route('login.post') }}" method="POST" class="card card-body shadow">
        @if ( session()->has('fail') )
        <div class="alert alert-danger">{{ session()->get('fail') }}</div>
        @endif
        @csrf
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
        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="remmember">
            <label class="form-check-label" for="remmember">Ingat Saya</label>
        </div>
        <div class="mt-2 mb-3 d-flex flex-column flex-md-row justify-content-end align-items-end">
            <a class="me-2 mb-2 mb-md-0" href="#">Lupa Password?</a>
            <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
    </form>
</div>
@endsection