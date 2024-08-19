<x-ecommerce-layout>
    <div class="contenedor_pagina_carrito">

        <div class="centrar">
            <div>
                @include('ecommerce.partials.migaja')

                <!-- DETALLE CARRITO -->
                @livewire('comprador.carrito.detalle-carrito-livewire')
            </div>
        </div>
    </div>
</x-ecommerce-layout>
