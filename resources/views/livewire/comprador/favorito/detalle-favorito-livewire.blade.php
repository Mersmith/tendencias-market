<div class="g_panel">

    <div class="g_titulo">
        <h2>Mis Favoritos</h2>
    </div>

    @if ($favoritos->isEmpty())
        <p>No tienes productos en tus favoritos.</p>
    @else
        <div class="g_carrito">
            @foreach ($favoritos as $producto)
                <div class="item_producto">
                    <div class="info_producto">
                        <div class="contenedor_imagen">
                            <a
                                href="{{ route('ecommerce.producto.vista.ver', ['id' => $producto->producto_id, 'slug' => $producto->producto_url]) }}">
                                <img src="{{ $producto->imagen_url }}" alt="">
                            </a>
                        </div>

                        <div class="contenedor_informacion">
                            <h3 class="producto_nombre"> {{ $producto->producto_nombre }}</h3>
                            <h4 class="marca_nombre">{{ $producto->marca_nombre }}</h4>

                            @if ($producto->color_nombre)
                                <p class="variacion">Color:
                                    <span>{{ $producto->color_nombre }}</span>
                                </p>
                            @endif

                            @if ($producto->talla_nombre)
                                <p class="variacion">Talla:
                                    <span>{{ $producto->talla_nombre }}</span>
                                </p>
                            @endif

                            @if ($producto->precio_oferta)
                                <p class="precio precio_oferta">S/.
                                    {{ number_format($producto->precio_oferta, 2) }}</p>
                            @endif

                            <p class="precio precio_normal">
                                S/. {{ number_format($producto->precio_normal, 2) }}
                                @if ($producto->porcentaje_descuento)
                                    <span class="descuento">
                                        - {{ $producto->porcentaje_descuento }}%
                                    </span>
                                @endif
                            </p>
                            <p class="precio precio_antiguo">S/.
                                {{ number_format($producto->precio_antiguo, 2) }}</p>
                        </div>
                    </div>

                    <div class="controles">
                        <div class="enlaces">
                            <button wire:click="eliminarFavorito({{ $producto->producto_id }})">Eliminar</button>
                        </div>
                    </div>
                </div>

                @if (!$loop->last)
                    <div class="g_separacion"></div>
                @endif
            @endforeach
        </div>
    @endif
</div>
