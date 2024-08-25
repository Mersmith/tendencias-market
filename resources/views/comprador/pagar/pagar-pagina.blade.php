<x-ecommerce-layout>
    <div class="contenedor_pagina_pagar">

        <div class="centrar">
            <div>
                @if ($carrito)
                    @livewire('comprador.pagar.pagar-ver-livewire', [
                        'carrito' => $carrito,
                        'carritoCantidadItems' => $cantidadItems,
                        'carritoTotalGeneral' => $totalGeneral,
                        'carritoTotalDescuento' => $totalDescuento,
                    ])
                @else
                    <p>No hay información de carrito disponible.</p>
                @endif
            </div>
        </div>
    </div>
</x-ecommerce-layout>
