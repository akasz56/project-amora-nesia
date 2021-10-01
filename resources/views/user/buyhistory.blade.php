@extends('layouts.user')

@section('container')
    <main class="container">
        <h1>User History</h1>
        @if ($orders)
            @foreach ($orders as $item)
                <a href="{{ 'delete/' . $item->id }}" class="btn btn-danger">Delete Order {{ $item->orderUUID }}</a>
                @dump($item->toArray())
            @endforeach
        @else
            Anda belum pernah memesan
        @endif
    </main>
@endsection
