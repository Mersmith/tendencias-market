<x-ecommerce-layout>
    @section('tituloPagina', $producto->producto_nombre)
    @section('descripcion', $producto->producto_descripcion)

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
                            <h2 class="producto_nombre">{{ $producto->producto_nombre }}</h2>
                            <h3 class="producto_marca">Marca <span>{{ $producto->marca_nombre }}</span></h3>
                        </div>

                        <!-- PRECIOS -->
                        <div class="contenedor_precios">
                            @if ($producto->precio_oferta)
                                <div class="item_precio">
                                    <div class="texto">Oferta</div>
                                    <div class="precio precio_oferta">S/ {{ $producto->precio_oferta }} </div>
                                </div>
                            @endif

                            <div class="item_precio">
                                <div class="texto">Precio</div>
                                <div class="precio {{ !$producto->precio_oferta ? 'precio_oferta' : 'precio_normal' }}">
                                    S/ {{ $producto->precio_normal }}

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
                                    <div class="precio precio_antiguo">S/ {{ $producto->precio_antiguo }} </div>
                                </div>
                            @endif
                        </div>

                        <div class="separacion"> </div>

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
