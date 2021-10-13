@extends('layouts.app')

@section('title', 'Verifikasi Email - Amora')

@section('content')
    <main class="container form-center">
        <form action="{{ route('verification.send') }}" method="POST" class="card card-body shadow">
            @csrf
            <h2 class="mb-3">Verifikasi Email Anda</h2>
            <p class="mb-4">
                Sebelum melanjutkan, anda perlu memverifikasi email dengan cara
                <span class="fw-bold">mengklik link yang sudah kami kirimkan ke email anda.</span>
                <br> <br>
                Jika anda tidak menerima emailnya, silahkan cek di kotak spam anda atau
                <button type="submit" class="btn btn-sm text-primary p-0">Kirim ulang emailnya</button>
            </p>
        </form>
    </main>
@endsection
