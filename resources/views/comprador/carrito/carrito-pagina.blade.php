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
                <div class="detalle_carrito">
                    <!-- BLOQUE -->
                    <div class="carrito">
                        <!-- TITULO -->
                        <div>
                            <h2>Carrito de compras</h2>
                        </div>

                        <!-- TABLA -->
                        <div>
                            @if ($carrito && $carrito->detalle->count() > 0)
                                <div>
                                    @foreach ($carrito->detalle as $detalle)
                                        <div class="item_producto">
                                            <!-- INFORMACION-->
                                            <div class="info_producto">
                                                <!-- IMAGEN-->
                                                <div class="contenedor_imagen">
                                                    <img src="{{ $detalle->variacion->producto->imagens->first()->url }}"
                                                        alt="">
                                                </div>

                                                <div class="contenedor_informacion">
                                                    <h3> {{ $detalle->variacion->producto->nombre }}</h3>

                                                    <h4>{{ $detalle->variacion->producto->marca->nombre }}</h4>

                                                    @if ($detalle->variacion->color)
                                                        <p class="variacion">Color:
                                                            <span>{{ $detalle->variacion->color->nombre }}</span>
                                                        </p>
                                                    @endif

                                                    @if ($detalle->variacion->talla)
                                                        <p class="variacion">Talla:
                                                            <span>{{ $detalle->variacion->talla->nombre }}</span>
                                                        </p>
                                                    @endif

                                                    <p class="precio">S/. {{ number_format($detalle->precio, 2) }}</p>
                                                </div>
                                            </div>

                                            <!-- CONTROLES-->
                                            <div class="controles">
                                                <div class="control_cantidad">
                                                    <button {{ $detalle->cantidad <= 1 ? 'disabled' : '' }}>-</button>
                                                    <span>{{ $detalle->cantidad }}</span>
                                                    <button>+</button>
                                                </div>

                                                <div class="enlaces">
                                                    <button>Para después</button>
                                                    <button>Eliminar</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="separacion"> </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Tu carrito está vacío.</p>
                            @endif
                        </div>
                    </div>

                    <!-- BLOQUE -->
                    <div class="resumen_pago">
                        <div class="detalle_pago">
                            <!-- TITULO -->
                            <div>
                                <h2>Resumen de tu pedido</h2>
                            </div>

                            <div class="monto">
                                <p>Subtotal:</p>
                                <span> S/. {{ $totalGeneral }}</span>
                            </div>

                            <a class="continuar_compra">
                                Continuar compra
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-ecommerce-layout>
