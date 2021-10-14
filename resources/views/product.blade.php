@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <main class="container">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">{{ session()->get('danger') }}</div>
        @endif

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

        <form action="{{ route('user.wishlist.add') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary p-3" name="productID" value="{{ $product->id }}">
                Tambahkan ke Wishlist
            </button>
        </form>

        <form action="{{ route('product.submit') }}" method="POST">
            <section class="row">
                <input type="hidden" name="ID" value="{{ $product->id }}">
                @csrf

                <div class="col-4">
                    <label for="type" class="mt-5 form-label">Jenis Bunga</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="0" hidden>Pilih satu</option>
                        @foreach ($product->types as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->color }} |
                                {{ $item->stock }} | {{ $item->price }}</option>
                        @endforeach
                    </select>
                    @if (session()->has('typeError'))<small class="text-danger">{{ session()->get('typeError') }}</small>@endif
                </div>

                <div class="col-4">
                    <label for="wrap" class="mt-5 form-label">Jenis Bungkus</label>
                    <select class="form-select" id="wrap" name="wrap" required>
                        <option value="0" hidden>Pilih satu</option>
                        @foreach ($product->wraps as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->color }} |
                                {{ $item->stock }} | {{ $item->price }}</option>
                        @endforeach
                    </select>
                    @if (session()->has('wrapError'))<small class="text-danger">{{ session()->get('wrapError') }}</small>@endif
                </div>

                <div class="col-4">
                    <label for="size" class="mt-5 form-label">Ukuran</label>
                    <select class="form-select" id="size" name="size" required>
                        <option value="0" hidden>Pilih satu</option>
                        @foreach ($product->sizes as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->color }} |
                                {{ $item->stock }} | {{ $item->price }}</option>
                        @endforeach
                    </select>
                    @if (session()->has('sizeError'))<small class="text-danger">{{ session()->get('sizeError') }}</small>@endif
                </div>
            </section>

            <section class="mt-3 d-flex flex-column">
                <button type="submit" class="w-100 mt-3 p-3 btn btn-outline-primary" name="btn" value="cart">
                    Tambahkan ke Keranjang
                </button>
                <button type="submit" class="w-100 mt-2 p-3 btn btn-primary" name="btn" value="order">
                    Buy
                </button>
            </section>
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
