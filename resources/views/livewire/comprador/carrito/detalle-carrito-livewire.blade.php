<div class="detalle_carrito">
    <!-- CARRITO -->
    <div class="carrito">
        <div>
            <h2 class="titulo">Carrito de compras ({{ $cantidadItems }})</h2>
        </div>

        <div class="separacion"> </div>

        <div>
            @if ($carrito && $carrito->detalle->count() > 0)
                <div>
                    @foreach ($carrito->detalle as $detalle)
                        <div class="item_producto">
                            <div class="info_producto">
                                <div class="contenedor_imagen">
                                    <img src="{{ $detalle->imagen_url }}" alt="">
                                </div>
                                <div class="contenedor_informacion">
                                    <h3 class="producto_nombre"> {{ $detalle->producto_nombre }}</h3>
                                    <h4 class="marca_nombre">{{ $detalle->marca_nombre }}</h4>

                                    @if ($detalle->color_nombre)
                                        <p class="variacion">Color:
                                            <span>{{ $detalle->color_nombre }}</span>
                                        </p>
                                    @endif

                                    @if ($detalle->talla_nombre)
                                        <p class="variacion">Talla:
                                            <span>{{ $detalle->talla_nombre }}</span>
                                        </p>
                                    @endif

                                    @if ($detalle->precio_oferta)
                                        <p class="precio precio_oferta">S/.
                                            {{ number_format($detalle->precio_oferta, 2) }}</p>
                                    @endif

                                    <p class="precio precio_normal">
                                        S/. {{ number_format($detalle->precio_normal, 2) }}
                                        @if ($detalle->porcentaje_descuento)
                                            <span class="descuento">
                                                - {{ $detalle->porcentaje_descuento }}%
                                            </span>
                                        @endif
                                    </p>
                                    <p class="precio precio_antiguo">S/.
                                        {{ number_format($detalle->precio_antiguo, 2) }}</p>
                                </div>
                            </div>
                            <div class="controles">
                                <div class="control_cantidad">
                                    <button wire:click="disminuirCantidad({{ $detalle->carrito_detalle_id }})"
                                        {{ $detalle->cantidad <= 1 ? 'disabled' : '' }}>-</button>
                                    <span>{{ $detalle->cantidad }}</span>
                                    <button
                                        wire:click="incrementarCantidad({{ $detalle->carrito_detalle_id }})">+</button>
                                </div>
                                <div class="enlaces">
                                    <button
                                        wire:click="eliminarDetalle({{ $detalle->carrito_detalle_id }})">Eliminar</button>
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

    <!-- RESUMEN PAGO -->
    <div class="resumen_pago">
        <div class="detalle_pago">
            <div>
                <h2 class="titulo">Resumen de tu pedido</h2>
            </div>

            <div class="separacion"> </div>

            <div class="monto">
                <p class="texto">Descuento por promo:</p>
                <span class="numero">- S/. {{ number_format($totalDescuento, 2) }}</span>
            </div>

            <div class="monto">
                <p class="texto">Subtotal:</p>
                <span class="numero"> S/. {{ number_format($totalGeneral, 2) }}</span>
            </div>

            <div class="separacion"> </div>

            <a class="continuar_compra">
                Continuar compra
            </a>
        </div>
    </div>
</div>
