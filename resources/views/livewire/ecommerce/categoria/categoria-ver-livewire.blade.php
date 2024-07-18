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
        <h1>{{ $categoria->nombre }}</h1>
    </div>

    <div class="dividir">
        <div class="dividir_1">
            <div>
                <h2>Categorias</h2>
                <ul>
                    @foreach ($categoriaFamilia as $categoria)
                        <li>
                            <a href="{{ url('category/' . $categoria->id . '/' . $categoria->slug) }}">
                                {{ $categoria->nombre }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2>Filtros</h2>
                <div>
                    <h4>Marca</h4>
                    <div style="display: flex; flex-direction: column;">
                        @foreach ($marcas as $marca)
                            <label>
                                <input type="checkbox" wire:model.live="selectedMarcas" value="{{ $marca->id }}">
                                {{ $marca->nombre }}
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
                                <input type="checkbox" wire:model.live="selectedPrecios" value="{{ $precio }}">
                                {{ $precio }}
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
                        <strong><p>Marca: {{ $producto->marca->nombre }}</p></strong>

                        <!-- Mostrar imágenes del producto -->
                        @if ($producto->imagens->isNotEmpty())
                            <div>
                                @foreach ($producto->imagens as $imagen)
                                    <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}" style="max-width: 100px;">
                                @endforeach
                            </div>
                        @endif

                        <!-- Mostrar descuentos del producto -->
                        @if ($producto->descuentos->isNotEmpty())
                            <div>
                                @foreach ($producto->descuentos as $descuento)
                                    @php
                                        $precioOriginal = $producto->listaPrecios->first()->precio;
                                        $precioDescuento = $precioOriginal * ((100 - $descuento->porcentaje_descuento) / 100);
                                    @endphp
                                    <div>
                                        <p>Precio original: {{ $producto->listaPrecios->first()->simbolo }}{{ $precioOriginal }}</p>
                                        <p>Descuento: {{ $descuento->porcentaje_descuento }}% hasta {{ $descuento->fecha_fin }}</p>
                                        <p>Precio con descuento: {{ $producto->listaPrecios->first()->simbolo }}{{ number_format($precioDescuento, 2) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Mostrar lista de precios del producto -->
                        @if ($producto->listaPrecios->isNotEmpty())
                            <div>
                                @foreach ($producto->listaPrecios as $precio)
                                   <strong> <p>Precio: {{ $precio->simbolo }}{{ $precio->precio }}</p></strong>
                                    @if ($precio->precio_antiguo)
                                        <p>Precio antiguo: {{ $precio->simbolo }}{{ $precio->precio_antiguo }}</p>
                                    @endif
                                @endforeach
                            </div>
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
        </div>
    </div>
</div>
