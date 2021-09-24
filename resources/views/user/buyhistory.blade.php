@extends('layouts.user')

@section('container')
<main class="container">
    <h1>User History</h1>
    @foreach ($orders as $item)
    <a href="{{ route('user.myOrder', ['uuid' => $item->orderUUID]) }}" class="btn btn-primary" >Detail Order {{ $item->id }}</a>
    <a href="{{ "delete/" . $item->id }}" class="btn btn-danger" >Delete Order {{ $item->id }}</a>
    @dump($item->toArray())
    @endforeach
</main>
@endsection