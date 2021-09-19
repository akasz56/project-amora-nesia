@extends('layouts.app')

@section('title', $product->name)

@section('content')
<main class="container">
    <p>{{ $product->publicID }}</p>
    <h1>{{ $product->name }}</h1>
    <hr>
    <p>{{ $product->description }}</p>
    <p>rating : {{ $product->rating }}</p>
    <p>viewers : {{ $product->viewers }}</p>

    <form action="{{ route('product.buy') }}" method="POST" class="row">
        <input type="hidden" name="ID" value="{{ $product->publicID }}">
        @csrf

        <div class="col-4">
            <h2 class="mt-5">Types</h2>
            <hr>
            @foreach ($types as $item)
            <div class="">
                <input type="radio" name="type" id="{{ $item->name }}" value="{{ $item->name }}"
                    <?php if ($types->first() == $item) echo 'required' ?>>
                <label for="{{ $item->name }}">
                    {{ $item->name }} | {{ $item->color }} | {{ $item->stock }} | {{ $item->price }}
                </label>
            </div>
            @endforeach
        </div>

        <div class="col-4">
            <h2 class="mt-5">Wraps</h2>
            <hr>
            @foreach ($wraps as $item)
            <div class="">
                <input type="radio" name="wrap" id="{{ $item->name }}" value="{{ $item->name }}"
                    <?php if ($wraps->first() == $item) echo 'required' ?>>
                <label for="{{ $item->name }}">
                    {{ $item->name }} | {{ $item->color }} | {{ $item->stock }} | {{ $item->price }}
                </label>
            </div>
            @endforeach
        </div>

        <div class="col-4">
            <h2 class="mt-5">Sizes</h2>
            <hr>
            @foreach ($sizes as $item)
            <div class="">
                <input type="radio" name="size" id="{{ $item->name }}" value="{{ $item->name }}"
                    <?php if ($sizes->first() == $item) echo 'required' ?>>
                <label for="{{ $item->name }}">
                    {{ $item->name }} | {{ $item->flower_amount }} | {{ $item->stock }} | {{ $item->price }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="mt-5 btn btn-primary">Buy</button>
    </form>
</main>
@endsection