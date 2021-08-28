@extends('layouts.app')

@section('title', 'Verifikasi Email - Amora')

@section('content')
<main class="container form-center">
    <form action="{{ route('verification.send') }}" method="POST" class="card card-body shadow">
        @csrf
        <h2 class="mb-3">Verifikasi Email Anda</h2>
        <p class="mb-4">Sebelum melanjutkan, anda perlu memverifikasi email dengan cara <span class="fw-bold text-primary">mengklik link yang sudah kami kirimkan ke email anda.</span></p>
        <p class="mb-4">Jika anda tidak menerima emailnya, kami akan mengirimkannya lagi</p>
        <button type="submit" class="btn btn-warning">Kirim Ulang Emailnya</button>
    </form>
</main>
@endsection