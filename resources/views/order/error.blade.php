@extends('layouts.app')

@section('title', 'Error Page - Amora Store')

@section('content')
    <main class="container">
        <h2>Error Page</h2>
        <div class="alert alert-danger">{{ $message }}</div>
    </main>
@endsection
