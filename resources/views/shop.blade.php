@extends('layouts.app')

@section('title', $shop->name)

@section('content')
    <main class="container mt-5">
        {{-- Title --}}
        <section class="row">
            <div class="col-md-1">
                <img src="{{ asset('assets/default-avatar.png') }}" alt="ShopAvatar" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-11">
                <h1 class="fw-bold mt-4 mt-md-0">{{ $shop->name }}</h1>
                <hr>
                <h6>{{ $provinces[$shop->address->provinceID]->name }}, {{ $shop->address->city }}</h6>
            </div>
        </section>

        {{-- Info --}}
        <section class="row mt-5">
            <div class="col-md-6">
                <h6 class="fw-bold">Deskripsi</h6>
                <p>{{ $shop->desc }}</p>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <h6 class="fw-bold">Kontak</h6>
                <i class='bx bx-mail-send bx-sm d-block mb-3'>
                    <span>{{ $shop->email ? $shop->email : 'Tidak Ada' }}</span>
                </i>
                <i class='bx bxs-phone bx-sm d-block mb-3'>
                    <span>{{ $shop->phone ? $shop->phone : 'Tidak Ada' }}</span>
                </i>
                <i class='bx bxl-whatsapp bx-sm d-block mb-3'>
                    <span>{{ $shop->whatsapp ? $shop->whatsapp : 'Tidak Ada' }}</span>
                </i>
            </div>
        </section>

        {{-- Products --}}
        <section class="recommendations row">
            <?php $chunk = $product->split(2); ?>
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
    </main>
@endsection
