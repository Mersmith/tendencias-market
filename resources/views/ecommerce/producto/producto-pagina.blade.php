<x-ecommerce-layout>
    <div class="contenedor_pagina_producto">
        <div class="centrar">

            <div class="contenedor_bloque">

                <div class="contendor_migaja">
                    <p> Home </p>
                </div>


                <div class="contenedor_informacion_producto">
               
                    @include('ecommerce.partials.carrusel', ['p_elementos' => $imagenes])

                    <div class="contendor_detalle_producto">
                        <div>

                            <h2>{{ $producto->nombre }}</h2>

                            <div class="contenedor_precios">
                                <p><strong>Precio:</strong>
                                    {{ $producto->simbolo }}{{ $producto->precio }}</p>
                                @if ($producto->porcentaje_descuento)
                                    <p><strong>Descuento:</strong> {{ $producto->porcentaje_descuento }}% hasta
                                        {{ \Carbon\Carbon::parse($producto->descuento_fecha_fin)->format('d/m/Y H:i') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        @livewire('ecommerce.producto.agregar-carrito-livewire', [
                            'tipo_variacion' => $tipo_variacion,
                            'variacion_agrupada' => $variacion_agrupada,
                            'color_seleccionado' => $color_seleccionado,
                            'talla_seleccionado' => $talla_seleccionado,
                        ])
                    </div>
                </div>

            </div>

        </div>

    </div>   

</x-ecommerce-layout>
