@extends('layouts.user')

@section('page', 'Hi, ' . Auth::user()->name)

@section('container')
    <main class="container">
        <h1>User Cart</h1>
    </main>
@endsection
