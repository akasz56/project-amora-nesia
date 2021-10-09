@extends('layouts.app')

@section('title', 'Payment Page - Amora Store')

@section('content')
    <main class="container">
        <h2>Payment Page</h2>
        <hr>
        <form action="{{ route('order.update') }}" method="POST">
            @csrf
            <input type="hidden" name="uuid" value="{{ $order->orderUUID }}">
            <button type="submit" name="status" value="paid" class="btn btn-primary">Pay</button>
        </form>
        @include('order.details')
    </main>
@endsection
