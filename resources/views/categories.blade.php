@extends('layouts.app')

@section('title', 'Categories - Amora Store')

@section('content')
    <main class="container">
        <h1>Kategori</h1>
        {{-- <a href="{{ route('catalog') }}" class="btn btn-primary">Go to Catalog</a> --}}

        {{-- Categories --}}
        <section class="mt-5">
            <h3>Kategori Acak</h3>
            <hr>
            @foreach ($categories as $item)
                <a href="{{ route('category', ['key' => $item->name]) }}"
                    class="btn btn-outline-primary">{{ $item->name }}</a>
            @endforeach
        </section>

        {{-- Recommendations --}}
        <section class="recommendations row">
            <h1 class="fw-bold text-center">Terbanyak dilihat</h1>
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

    </main>
@endsection
