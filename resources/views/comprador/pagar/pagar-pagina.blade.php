<x-ecommerce-layout>
    <div class="contenedor_pagina_perfil">
        <div class="panel">
            <div>Pagar</div>

            <br>

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
</x-ecommerce-layout>
