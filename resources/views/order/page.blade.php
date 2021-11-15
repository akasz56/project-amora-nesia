@extends('layouts.app')

@section('title', 'Order Page - Amora Store')

@section('content')
    <main class="container">
        <h1>Order Page</h1>
        @include('order.details')
    </main>
@endsection
