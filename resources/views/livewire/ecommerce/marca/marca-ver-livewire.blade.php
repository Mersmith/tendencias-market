<div>
    <style>
        .dividir {
            display: flex;
            width: 100%;
        }

        .dividir_1 {
            width: 30%;
            flex-direction: column;
        }

        .dividir_2 {
            width: 70%;
        }
    </style>
    <div>
        <h1>{{ $marca->nombre }}</h1>
    </div>

    <div class="dividir">
        <div class="dividir_1">      
            <div>
                <h2>Filtros</h2>
                <div>
                    <h4>Categoria</h4>
                    <div style="display: flex; flex-direction: column;">
                        @foreach ($categorias as $categoria)
                            <label>
                                <input type="checkbox" wire:model.live="selectedCategorias" value="{{ $categoria->id }}">
                                {{ $categoria->nombre }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Filtros por Precio -->
                <div>
                    <h4>Precio</h4>
                    <div style="display: flex; flex-direction: column;">
                        @foreach ($precios as $precio)
                            <label>
                                <input type="checkbox" wire:model.live="selectedPrecios" value="{{ $precio['id'] }}">
                                {{ $precio['precio_inicio'] }} -
                                {{ $precio['precio_fin'] ? $precio['precio_fin'] : '+' }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="dividir_2">
            <h2>Productos</h2>

            <ul style="display: flex; flex-wrap: wrap; gap: 20px;">
                @foreach ($productosConStock as $producto)
                    <li>
                        <h2>
                            <a href="{{ url('product/' . $producto->id . '/' . $producto->slug) }}">
                                {{ $producto->nombre }}
                            </a>
                        </h2>

                        <p>ID: {{ $producto->id }}</p>
                        <strong>
                            <a href="{{ url('brand/' . $producto->marca->slug) }}">
                                Marca: {{ $producto->marca->nombre }}
                            </a>
                        </strong>

                        <!-- Mostrar imágenes del producto -->
                        @if ($producto->imagens->isNotEmpty())
                            <div>
                                @foreach ($producto->imagens as $imagen)
                                    <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}"
                                        style="max-width: 100px;">
                                @endforeach
                            </div>
                        @endif

                        @if ($producto->listaPrecios->isNotEmpty())
                            @php
                                $precioOriginal = $producto->listaPrecios->first()->precio;
                            @endphp
                            <strong>
                                <p>Precio original:
                                    S/.{{ $precioOriginal }}
                                </p>
                            </strong>
                            @if ($producto->listaPrecios->first()->precio_antiguo)
                                <p>Precio antiguo:
                                    S/.{{ $producto->listaPrecios->first()->precio_antiguo }}
                                </p>
                            @endif

                            @if ($producto->descuentos->isNotEmpty())
                                <div>
                                    @php
                                        $porcentajeDescuento = $producto->descuentos->first()->porcentaje_descuento;
                                        $precioDescuento = $precioOriginal * ((100 - $porcentajeDescuento) / 100);
                                    @endphp
                                    <div>
                                        <p>{{ $porcentajeDescuento }}%</p>
                                        <p>Precio con descuento:
                                            S/.{{ number_format($precioDescuento, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Mostrar variaciones del producto -->
                        @foreach ($producto->variaciones as $variacion)
                            <ul>
                                <li>
                                    <p>Variación ID: {{ $variacion->id }}</p>
                                    <p>Talla: {{ $variacion->talla->nombre ?? 'N/A' }}</p>
                                    <p>Color: {{ $variacion->color->nombre ?? 'N/A' }}</p>
                                    <p>Stock: {{ $variacion->inventarios->sum('stock') }}</p>
                                </li>
                            </ul>
                        @endforeach
                    </li>
                @endforeach
            </ul>

            @if ($productosConStock->hasPages())
                <div>
                    {{ $productosConStock->onEachSide(1)->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
