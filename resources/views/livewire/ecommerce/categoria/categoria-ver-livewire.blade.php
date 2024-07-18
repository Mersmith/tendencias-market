<div>
    <style>
        .dividir {
            display: flex;
            width: 100%;
        }

        .dividir_1 {
            display: 30%;
            display: flex;
            flex-direction: column;
        }

        .dividir_2 {
            display: 70%;
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
        </div>
        <div class="dividir_2">
            <h2>Productos</h2>

            <ul>
                @foreach ($productosConStock as $producto)
                    <li>
                        <h2>
                            <a href="{{ url('product/' . $producto->id . '/' . $producto->slug) }}">
                                {{ $producto->nombre }}
                            </a>
                        </h2>

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
                                @if ($producto->listaPrecios->isNotEmpty())
                                @php
                                    $precioOriginal = $producto->listaPrecios->first()->precio;
                                    $precioDescuento = $precioOriginal * ((100 - $descuento->porcentaje_descuento) / 100);
                                @endphp
                                <div>
                                    <p>Precio original: {{ $producto->listaPrecios->first()->simbolo }}{{ $precioOriginal }}</p>
                                    <p>Descuento: {{ $descuento->porcentaje_descuento }}% hasta {{ $descuento->fecha_fin }}</p>
                                    <p>Precio con descuento: {{ $producto->listaPrecios->first()->simbolo }}{{ number_format($precioDescuento, 2) }}</p>
                                </div>
                            @endif
                                @endforeach
                            </div>
                        @endif

                        <!-- Mostrar lista de precios del producto -->
                        @if ($producto->listaPrecios->isNotEmpty())
                            <div>
                                @foreach ($producto->listaPrecios as $precio)
                                    <p>Precio: {{ $precio->simbolo }}{{ $precio->precio }}</p>
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
                                    <p>Stock:
                                        @foreach ($variacion->inventarios as $inventario)
                                            {{ $inventario->stock }}
                                        @endforeach
                                    </p>
                                </li>
                            </ul>
                        @endforeach

                        <br>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

</div>
