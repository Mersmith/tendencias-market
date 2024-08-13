<x-ecommerce-layout>
    <div class="contenedor_pagina_producto">
        <div class="centrar">

            <div class="contenedor_bloque">

                <!-- MIGAJA -->
                <div class="contendor_migaja">
                    <ol>
                        <li><a href="">Home</a></li>
                        <li><a href="">Moda</a></li>
                        <li><a href="">Mujer</a></li>
                    </ol>
                </div>

                <!-- INFORMACION -->
                <div class="contenedor_informacion_producto">

                    <!-- CARRUSEL -->
                    @include('ecommerce.partials.carrusel', ['p_elementos' => $imagenes])

                    <!-- DETALLE -->
                    <div class="contendor_detalle_producto">
                        <div>

                            <div class="cabecera">
                                <h2>{{ $producto->nombre }}</h2>
                                <h3>{{ $producto->marca_nombre }}</h3>
                            </div>

                            <!-- PRECIOS -->
                            <div class="contenedor_precios">
                                @if ($producto->precio_oferta)
                                    <div class="item_precio">
                                        <div>Oferta</div>
                                        <div class="oferta">S/ {{ $producto->precio_oferta }} </div>
                                    </div>
                                @endif

                                @if ($producto->porcentaje_descuento)
                                    <div class="item_precio">
                                        <div></div>
                                        <div>Descuento {{ $producto->porcentaje_descuento }}% hasta
                                            {{ \Carbon\Carbon::parse($producto->descuento_fecha_fin)->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                @endif

                                <div class="item_precio">
                                    <div>Precio</div>
                                    <div>S/ {{ $producto->precio }} </div>
                                </div>

                                @if ($producto->precio_antiguo)
                                    <div class="item_precio">
                                        <div>Antes</div>
                                        <div class="antes">S/ {{ $producto->precio_antiguo }} </div>
                                    </div>
                                @endif


                            </div>

                            <hr>

                        </div>

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
