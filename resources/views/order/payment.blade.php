@extends('layouts.app')

@section('title', 'Payment Page - Amora Store')

@section('content')
    <main class="container">
        <h2>Payment Page</h2>
        <hr>
        <section class="box-frame">
            @csrf
            <input type="hidden" name="uuid" value="{{ $order->orderUUID }}">
            <h2 class="fw-bold">Pembayaran</h2>
            <hr>
            <p class="position-relative">Total Tagihan:<span class="position-absolute end-0 font-monospace fw-bold fs-4">
                    Rp{{ number_format($order->grand_total) }}
                </span>
            </p>
            <a href="{{ $order->payment_url }}" class="btn btn-primary p-3 w-100 mt-3">Pay</a>
        </section>
        @include('order.details')
    </main>
@endsection
