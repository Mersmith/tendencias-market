<div class="g_contenedor_70_30">
    <!-- CARRITO -->
    <div class="contenedor_70">
        <div class="g_panel">
            <div>
                <h2 class="g_titulo">Carrito de compras ({{ $cantidadItems }})</h2>
                <div class="g_separacion"> </div>
            </div>

            <div class="g_carrito">
                @if ($carrito && $carrito->detalle->count() > 0)
                    @foreach ($carrito->detalle as $detalle)
                        <div class="item_producto">
                            <div class="contenedor_imagen">
                                <img src="{{ $detalle->imagen_url }}" alt="">
                            </div>

                            <div class="info_producto">
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

                                    <div class="contenedor_precios">
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
                        </div>

                        @if (!$loop->last)
                            <div class="g_separacion"></div>
                        @endif
                    @endforeach
                @else
                    <p>Tu carrito está vacío.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- RESUMEN PAGO -->
    <div class="contenedor_30 g_sidebar_resumen_pedido" x-data="{ mostrarMas: false }">
        <div @click="mostrarMas = !mostrarMas" class="g_icono_resumen_pago">
            <span><i :class="{ 'fa-chevron-down': mostrarMas, 'fa-chevron-up': !mostrarMas }"
                    class="fa-solid"></i></span>
        </div>

        <div class="g_panel">
            <div>
                <h2 class="g_titulo">Resumen de tu pedido</h2>
                <div class="g_separacion"> </div>
            </div>

            <div class="g_resumen_pagar">
                <div class="contenedor_pagar" :class="{ 'ocultar_pagar': !mostrarMas }">
                    <div class="monto">
                        <p class="texto">Descuento por promo:</p>
                        <span class="numero">- S/. {{ number_format($totalDescuento, 2) }}</span>
                    </div>

                    <div class="g_separacion"> </div>
                </div>

                <div class="monto">
                    <p class="texto">Subtotal:</p>
                    <span class="numero"> S/. {{ number_format($totalGeneral, 2) }}</span>
                </div>

                <button wire:click="pagarAhora" class="continuar_compra">
                    <a href="{{ route('comprador.pagar.vista.ver') }}">
                        Continuar compra
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>
