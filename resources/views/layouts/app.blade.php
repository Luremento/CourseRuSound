<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body>
@include('components.header')
<main class="py-4">
    <div class="w-full flex flex-wrap justify-center">
        @yield('content')


    </div>
</main>
<audio id="track-player" controls style="display: none;">
    <source id="track-source" src="" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>


</body>

</html>
