@extends('layouts.app')

@section('title', 'Order Page - Amora Store')

@section('content')
    <main class="container">
        <h1>Order Page</h1>
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif
        @include('order.details')
    </main>
@endsection
