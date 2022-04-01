<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="{{asset('css/app.css')}}" >

    <title>@yield("title")</title>
</head>
<body>
<div class="bg-warning p-2 text-dark bg-opacity-10">
    @include('inc.header')
    <div class="container">
        @include('inc.messages')
        @yield("content")
    </div>

    @include('inc.footer')
</div>

</body>
</html>
