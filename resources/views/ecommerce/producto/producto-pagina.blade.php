<x-ecommerce-layout>
    @section('tituloPagina', $producto->nombre)
    @section('descripcion', $producto->descripcion)

    <div class="contenedor_pagina_producto">
        <div class="centrar">

            <div class="contenedor_bloque">

                <!-- INFORMACION -->
                <div class="contenedor_informacion_producto">

                    <!-- CARRUSEL -->
                    @include('ecommerce.partials.carrusel', ['p_elementos' => $imagenes])

                    <!-- DETALLE -->
                    <div class="contendor_detalle_producto">

                        <!-- CABECERA -->
                        <div class="cabecera">
                            <h2>{{ $producto->nombre }}</h2>
                            <h3>Marca <span>{{ $producto->marca_nombre }}</span></h3>
                        </div>

                        <!-- PRECIOS -->
                        <div class="contenedor_precios">
                            @if ($producto->precio_oferta)
                                <div class="item_precio">
                                    <div class="texto">Oferta</div>
                                    <div class="numero oferta">S/ {{ $producto->precio_oferta }} </div>
                                </div>
                            @endif

                            <div class="item_precio">
                                <div class="texto">Precio</div>
                                <div class="numero {{ !$producto->precio_oferta ? 'oferta' : 'normal' }}">
                                    S/ {{ $producto->precio }}

                                    @if ($producto->porcentaje_descuento)
                                        <span class="descuento">
                                            - {{ $producto->porcentaje_descuento }}%
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if ($producto->precio_antiguo)
                                <div class="item_precio">
                                    <div class="texto">Antes</div>
                                    <div class="numero antes">S/ {{ $producto->precio_antiguo }} </div>
                                </div>
                            @endif
                        </div>

                        <hr>

                        <!-- VARIACION -->
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
