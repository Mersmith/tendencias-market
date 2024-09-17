<x-ecommerce-layout>
    <div class="g_contenedor_pagina">

        <div class="centrar_pagina">
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
