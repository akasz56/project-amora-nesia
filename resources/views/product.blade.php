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

        {{-- Title --}}
        <h1 class="mt-5">{{ ucwords($product->name) }}</h1>
        <hr>
        <a href="/{{ $shop->url }}" class="btn btn-outline-dark">
            <i class='bx bx-store-alt'></i>
            {{ $shop->name }}
        </a>

        {{-- MainRow --}}
        <div class="row mt-5">
            {{-- MainCol --}}
            <section class="col-md-6">
                {{-- Photo --}}
                @if ($product->photos->isNotEmpty())
                    <?php $i = 1; ?>
                    @foreach ($product->photos as $photo)
                        @if ($i)
                            <button type="button" class="btn p-0 mb-2" data-bs-toggle="modal"
                                data-bs-target="{{ '#editPhoto' . $photo->id }}">
                                <img src="{{ asset($photo->blob) }}" alt="Foto Produk" class="img-fluid">
                            </button>
                            <?php $i--; ?>
                        @else
                            <button type="button" class="btn p-0 prod-photos" data-bs-toggle="modal"
                                data-bs-target="{{ '#editPhoto' . $photo->id }}">
                                <img src="{{ asset($photo->blob) }}" alt="Foto Produk">
                            </button>
                        @endif
                    @endforeach
                @else
                    <div class="d-block text-center border border-dark py-5">Tidak ada Foto</div>
                @endif

                {{-- Rating Viewers Wishlist --}}
                <form action="{{ route('user.wishlist.add') }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <div class="me-auto">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < $product->rating)
                                <i class='bx bxs-star bx-sm'></i>
                            @else
                                <i class='bx bx-star bx-sm'></i>
                            @endif
                        @endfor
                    </div>
                    <div class="me-auto">Viewers : {{ $product->viewers }}</div>
                    <button type="submit" class="py-2 btn fw-bold" name="productID" value="{{ $product->id }}">
                        <i class='bx bx-bookmark-plus'></i>
                        Tambahkan ke Wishlist
                    </button>
                </form>
            </section>

            {{-- MainCol --}}
            <section class="col-md-6">
                {{-- Description --}}
                <h5 class="fw-bold">Deskripsi</h5>
                <hr>
                <p>{{ $product->description }}</p>
                <h5 class="mt-5 fw-bold">Kategori</h5>
                <hr>
                @foreach ($product->categories as $categories)
                    <a href="{{ route('category', ['key' => $categories->name]) }}"
                        class="btn btn-outline-primary">{{ $categories->name }}</a>
                @endforeach

                {{-- Product Input --}}
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

                    <section class="mt-3 d-flex">
                        <button type="submit" class="flex-fill py-2 btn btn-outline-primary" name="btn" value="cart">
                            + Keranjang
                        </button>
                        <button type="submit" class="flex-fill py-2 btn btn-primary ms-2" name="btn" value="order">
                            Beli Langsung
                        </button>
                    </section>
                </form>
            </section>
        </div>

        {{-- Recommendations --}}
        <section class="recommend-product row">
            <h1 class="fw-bold text-center">Produk Lainnya</h1>
            <hr class="mb-5">
            <?php $chunk = $recommendations->split(2); ?>
            <div class="col-md-6">
                @foreach ($chunk[0] as $item)
                    @include('components.product-preview', ['item' => $item, 'class' => 'mb-3'])
                @endforeach
            </div>
            <div class="col-md-6">
                @foreach ($chunk[1] as $item)
                    @include('components.product-preview', ['item' => $item, 'class' => 'mb-3'])
                @endforeach
            </div>
        </section>

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
