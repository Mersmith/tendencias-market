<x-ecommerce-layout>
    <div class="contenedor_pagina_carrito">

        <div class="centrar">
            <div>
                <!-- MIGAJA -->
                <div class="contenedor_migaja">
                    <ul>
                        <li> <a href="">Inicio</a> </li>
                        <li> <a href="">Carrito</a> </li>
                        <li> <a href="">Checkout</a> </li>
                    </ul>
                </div>

                <!-- DETALLE CARRITO -->
                @livewire('comprador.carrito.detalle-carrito-livewire')
            </div>
        </div>
    </div>
</x-ecommerce-layout>
