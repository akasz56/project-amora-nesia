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

    <section>
        <h3>Provinsi</h3>
        <p>{{ $address->provinceID }}</p>
        <h3>Kota</h3>
        <p>{{ $address->city }}</p>
        <h3>Alamat</h3>
        <p>{{ $address->address }}</p>
        <h3>RW</h3>
        <p>{{ $address->rw }}</p>
        <h3>RT</h3>
        <p>{{ $address->rt }}</p>
        <h3>Kode Pos</h3>
        <p>{{ $address->postcode }}</p>
    </section>
</main>
@endsection