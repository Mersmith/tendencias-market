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

    <div class="dividir">
        <div class="dividir_1">
            @foreach ($producto->imagens as $imagen)
                <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}">
            @endforeach
        </div>

        <div class="dividir_2">
            <strong>
                <h1>{{ $producto->nombre }}</h1>
            </strong>
            <p>{{ $producto->descripcion }}</p>
            <p>Categoria: {{ $producto->categoria->nombre }}</p>
            <p>Marca: {{ $producto->marca->nombre }}</p>
            <br>
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

            <br>

            @if ($producto->variaciones)
                @foreach ($producto->variaciones as $variacion)
                    <h2>Variación: {{ $variacion->id }}</h2>
                    <p>Color: {{ $variacion->color->nombre ?? 'N/A' }}</p>
                    <p>Talla: {{ $variacion->talla->nombre ?? 'N/A' }}</p>
                    <p>Stock: {{ $variacion->inventarios->first()->stock }}</p>
                    <br>
                @endforeach
            @endif
        </div>
    </div>
</div>
