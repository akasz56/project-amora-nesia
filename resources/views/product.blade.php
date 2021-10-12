@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <main class="container">
        <h1>{{ $product->name }}</h1>
        <hr>
        <p>{{ $product->description }}</p>
        <p>rating : {{ $product->rating }}</p>
        <p>viewers : {{ $product->viewers }}</p>

        <div class="row">
            @foreach ($product->photos as $photo)
                <div class="col-2">
                    <button type="button" class="btn p-0" data-bs-toggle="modal"
                        data-bs-target="{{ '#editPhoto' . $photo->id }}">
                        <img src="{{ asset($photo->blob) }}" alt="Foto Produk" class="img-fluid">
                    </button>
                </div>
            @endforeach
        </div>

        <form action="{{ route('product.order') }}" method="POST" class="row">
            <input type="hidden" name="ID" value="{{ $product->id }}">
            @csrf

            <div class="col-4">
                <h2 class="mt-5">Types</h2>
                <hr>
                @foreach ($product->types as $item)
                    <div>
                        <input type="radio" name="type" id="{{ $item->name }}" value="{{ $item->name }}"
                            <?php if ($product->types->first() == $item) {
                                echo 'required';
                            } ?>>
                        <label for="{{ $item->name }}">
                            {{ $item->name }} | {{ $item->color }} | {{ $item->stock }} | {{ $item->price }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <h2 class="mt-5">Wraps</h2>
                <hr>
                @foreach ($product->wraps as $item)
                    <div>
                        <input type="radio" name="wrap" id="{{ $item->name }}" value="{{ $item->name }}"
                            <?php if ($product->wraps->first() == $item) {
                                echo 'required';
                            } ?>>
                        <label for="{{ $item->name }}">
                            {{ $item->name }} | {{ $item->color }} | {{ $item->stock }} | {{ $item->price }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <h2 class="mt-5">Sizes</h2>
                <hr>
                @foreach ($product->sizes as $item)
                    <div>
                        <input type="radio" name="size" id="{{ $item->name }}" value="{{ $item->name }}"
                            <?php if ($product->sizes->first() == $item) {
                                echo 'required';
                            } ?>>
                        <label for="{{ $item->name }}">
                            {{ $item->name }} | {{ $item->flower_amount }} | {{ $item->stock }} |
                            {{ $item->price }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="mt-5 btn btn-primary">Buy</button>
        </form>

        {{-- JavaScripts --}}
        @foreach ($product->photos as $photo)
            <div class="modal fade" id="{{ 'editPhoto' . $photo->id }}" tabindex="-1"
                aria-labelledby="{{ 'editPhoto' . $photo->id . 'Label' }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="{{ 'editPhoto' . $photo->id . 'Label' }}">
                                Foto Produk
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset($photo->blob) }}" alt="Foto Produk" class="img-fluid mb-5">
                            <hr>
                            {{ $photo->caption }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
@endsection
