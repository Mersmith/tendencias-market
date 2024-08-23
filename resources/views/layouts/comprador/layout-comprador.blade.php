<div class="contenedor_layout_comprador">
    <div class="centrar">
        <div class="grid_layout_cliente">
            <aside class="contenedor_nav_links">
                @include('layouts.comprador.menu')
            </aside>
            <div class="contenido_pagina">
                @yield('content')
                @if (isset($slot))
                    {{ $slot }}
                @endif
            </div>
        </div>
    </div>
</div>
