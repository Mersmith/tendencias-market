<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!--META TAGS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('descripcion')">

    <!--TITULO-->
    <title>{{ env('APP_NAME') }} | @yield('tituloPagina')</title>

    <!-- SCRIPTS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- STYLES -->
    @livewireStyles
    @include('layouts.erp.components.css')
</head>

<body>
    <!--CONTENEDOR LAYOUT GENERAL-->
    <div x-data="xDataLayout()" x-init="initLayout" class="contenedor_layout_general">
        <!--MENU PRINCIPAL-->
        @include('layouts.erp.menu-principal')

        <!--CONTENEDOR LAYOUT PAGINA-->
        <div class="contenedor_layout_pagina" :class="{ 'estilo_contenedor_layout_pagina': estadoNavAbierto }">
            <!--HEADER LAYOUT PAGINA-->
            @livewire('erp.header.erp-header-livewire')

            <!--CONTENIDO LAYOUT PAGINA-->
            <div class="contenido_layout_pagina">
                <div class="centrar_pagina">
                    <main class="contenido_pagina">
                        @yield('content')
                        @if (isset($slot))
                            {{ $slot }}
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </div>

    <!--SCRIPTS-->
    @include('layouts.erp.components.js')
    @stack('modals')
    @livewireScripts
    @stack('script')
</body>

</html>
