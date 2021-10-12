@extends('layouts.user')

@section('page', 'Hi, ' . Auth::user()->name)

@section('container')
    <main class="container">
        <h1>User Wishlist</h1>
    </main>
@endsection
