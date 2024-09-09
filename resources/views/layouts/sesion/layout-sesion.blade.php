<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('tituloPagina') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <link rel="stylesheet" href="{{ asset('assets/sesion/sesion.css') }}">
</head>

<body>
    <div>
        @yield('content')
        @if (isset($slot))
            {{ $slot }}
        @endif
    </div>

    @livewireScripts
</body>

</html>
