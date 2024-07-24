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

            <br>

            <h3>OTRO</h3>
            @if ($producto->variaciones->isNotEmpty())
                <div>
                    <p>Selecciona un color:</p>
                    @foreach ($producto->variaciones->filter(function ($variacion) use ($almacenId) {
            return $variacion->inventarios->contains('almacen_id', $almacenId);
        })->groupBy('color.id') as $colorId => $variaciones)
                        <label>
                            <input type="radio" wire:model.live="selectedColor" value="{{ $colorId }}">
                            {{ $variaciones->first()->color->nombre }}
                        </label>
                    @endforeach
                </div>

                @if ($selectedColor)
                    <div>
                        <p>Selecciona una talla:</p>
                        @foreach ($producto->variaciones->filter(function ($variacion) use ($selectedColor, $almacenId) {
            return $variacion->color->id == $selectedColor && $variacion->inventarios->contains('almacen_id', $almacenId);
        })->groupBy('talla.id') as $tallaId => $variaciones)
                            <label>
                                <input type="radio" wire:model.live="selectedSize" value="{{ $tallaId }}">
                                {{ $variaciones->first()->talla->nombre }}
                            </label>
                        @endforeach
                    </div>
                @endif

                <br>

                @if ($selectedColor && $selectedSize)
                    @php
                        $selectedVariacion = $producto->variaciones
                            ->filter(function ($variacion) use ($selectedColor, $selectedSize, $almacenId) {
                                return $variacion->color->id == $selectedColor &&
                                    $variacion->talla->id == $selectedSize &&
                                    $variacion->inventarios->contains('almacen_id', $almacenId);
                            })
                            ->first();
                    @endphp
                    @if ($selectedVariacion)
                        <h2>Variación: {{ $selectedVariacion->id }}</h2>
                        <p>Color: {{ $selectedVariacion->color->nombre }}</p>
                        <p>Talla: {{ $selectedVariacion->talla->nombre }}</p>
                        <p>Stock: {{ $selectedVariacion->inventarios->first()->stock }}</p>
                    @endif
                    <br>
                @endif
            @endif


        </div>
    </div>
</div>
