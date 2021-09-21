@extends('layouts.app')

@section('title', $shop->name)

@section('content')
<main class="container">
    <h1>{{ $shop->name }}</h1>
    @foreach ($product as $item)
    <h2><a href="{{ route('product', ['id' => $item->id]) }}">{{ $item->name }}</a></h2>
    <p>{{ $item->description }}</p>
    @endforeach
</main>
@endsection