@extends('layouts.app')

@section('title', 'Order Page - Amora Store')

@section('content')
    <main class="container">
        <h2>Order Page</h2>
        @include('order.details')
    </main>
@endsection
