@extends('layouts.app')

@section('title', $category->name . ' - Amora Store')

@section('content')
    <main class="container">
        <h1 class="mt-5">Kategori {{ $category->name }}</h1>

        {{-- Recommendations --}}
        <section class="row">
            <hr class="mb-5">
            <?php $chunk = $category->products->sortByDesc('viewers')->split(2); ?>
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
