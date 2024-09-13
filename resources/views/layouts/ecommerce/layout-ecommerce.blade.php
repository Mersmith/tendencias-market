<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!--META TAGS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('descripcion')">

    <!--TITULO-->
    <title>@yield('tituloPagina')</title>

    <!-- SCRIPTS -->
    @vite(['resources/css/app.css', 'resources/css/estilos.css', 'resources/css/layout.css', 'resources/css/formulario.css', 'resources/css/lista.css', 'resources/css/modal.css', 'resources/js/app.js'])

    <!-- STYLES -->
    @livewireStyles
    @include('layouts.ecommerce.assets.css')
</head>

<body x-data="xDataLayoutEcommerce()" x-init="initLayoutEcommerce" class="contenedor_layout_ecommerce">


    <!--MENU PRINCIPAL-->
    @include('layouts.ecommerce.menu.menu', [
        'categorias' => $categorias,
    ])

    <!--CONTENEDOR LAYOUT GENERAL-->
    <main class="contenedor_layout_ecommerce_pagina">
        @yield('content')
        @if (isset($slot))
            {{ $slot }}
        @endif
    </main>

    @include('layouts.ecommerce.footer.footer', [
        'p_elementos' => $footer,
    ])

    <div class="contenedor_superponer" :x-show="estadoSuperponer" x-on:click="cerrarTodo"></div>

    <!--SCRIPTS-->
    @include('layouts.ecommerce.assets.js')

    @stack('modals')
    @livewireScripts
    @stack('script')
    <script>
        @if (session('alerta'))
            window.onload = function() {
                let mensaje = @json(session('alerta'));
                alertaNormal(mensaje);
            };
        @endif

        Livewire.on('alertaLivewire', mensaje => {
            if (mensaje == 'Creado' || mensaje == 'Actualizado') {
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    showConfirmButton: false,
                    timer: 2500
                })
            } else if (mensaje == "Error") {
                Swal.fire({
                    icon: 'error',
                    title: '¡Alto!',
                    text: mensaje,
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        })
    </script>
</body>

</html>
