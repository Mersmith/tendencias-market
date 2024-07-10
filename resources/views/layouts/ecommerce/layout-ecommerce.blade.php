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
    @include('layouts.ecommerce.assets.css')
</head>

<body>
    <!--CONTENEDOR LAYOUT GENERAL-->
    <div class="contenedor_layout_general">      
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
