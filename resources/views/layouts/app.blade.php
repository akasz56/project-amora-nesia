<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', config('app.name'))</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')
</head>

<body>

    @include('components.navbar')

    @yield('content')

    @include('components.footer')

    {{-- Script --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>