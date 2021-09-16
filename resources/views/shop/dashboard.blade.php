<?php
    use App\Http\Controllers\ShopController;
?>
@extends('layouts.shop')

@section('page', 'Dashboard')

@section('container')
<main class="container">
    <h1>{{ ShopController::getShop()->name }} Dashboard</h1>
</main>
@endsection