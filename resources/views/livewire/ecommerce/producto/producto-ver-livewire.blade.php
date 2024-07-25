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

        select {
            margin-bottom: 10px;
        }
    </style>

    <div class="dividir">
        <div class="dividir_1">
            <h1>{{ $this->tipo_variacion }} </h1>
            <h2>{{ $producto->nombre }}</h2>
            <p>{{ $producto->descripcion }}</p>
            <p><strong>Precio:</strong>
                {{ $producto->simbolo }}{{ $producto->precio }}</p>
            @if ($producto->porcentaje_descuento)
                <p><strong>Descuento:</strong> {{ $producto->porcentaje_descuento }}% hasta
                    {{ \Carbon\Carbon::parse($producto->descuento_fecha_fin)->format('d/m/Y H:i') }}
                </p>
            @endif

            @if ($tipo_variacion == 'VARIA-COLOR-TALLA')
                <div>
                    <label>Selecciona un color:</label>
                    @foreach ($variacionesData as $colorId => $items)
                        <div class="color-option">
                            <input type="radio" id="color_{{ $colorId }}" name="color" value="{{ $colorId }}"
                                wire:model.live="colorSeleccionado">
                            <label for="color_{{ $colorId }}">Color {{ $items->first()->color_nombre }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Mostrar tallas según el color seleccionado -->
                @if ($colorSeleccionado)
                    <div>
                        <label>Selecciona una talla:</label>
                        @foreach ($variacionesData[$colorSeleccionado] as $item)
                            <div class="talla-option">
                                <input type="radio" id="talla_{{ $item->talla_id }}" name="talla"
                                    value="{{ $item->talla_id }}" wire:model.live="tallaSeleccionado">
                                <label for="talla_{{ $item->talla_id }}">Talla {{ $item->talla_nombre }} - Stock:
                                    {{ $item->stock }}</label>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- Botón para agregar al carrito -->
            @elseif ($tipo_variacion == 'VARIA-COLOR')
                <div>
                    <label>Selecciona un color:</label>
                    @foreach ($variacionesData as $colorId => $items)
                        @php
                            // Calcular el stock total para el color
                            $totalStock = $items->sum('stock');
                        @endphp
                        <div class="color-option">
                            <input type="radio" id="color_{{ $colorId }}" name="color"
                                value="{{ $colorId }}" wire:model.live="colorSeleccionado">
                            <label for="color_{{ $colorId }}">Color {{ $items->first()->color_nombre }} - Stock:
                                {{ $totalStock }}</label>
                        </div>
                    @endforeach
                </div>
            @elseif ($tipo_variacion == 'VARIA-TALLA')
                <div>
                    <label>Selecciona una talla:</label>
                    @foreach ($variacionesData as $tallaId => $items)
                        @php
                            // Calcular el stock total para la talla
                            $totalStock = $items->sum('stock');
                        @endphp
                        <div class="talla-option">
                            <input type="radio" id="talla_{{ $tallaId }}" name="talla"
                                value="{{ $tallaId }}" wire:model.live="tallaSeleccionado">
                            <label for="talla_{{ $tallaId }}">Talla {{ $items->first()->talla_nombre }} - Stock:
                                {{ $totalStock }}</label>
                        </div>
                    @endforeach
                </div>
            @else
                <div>
                    <p>Stock disponible: {{ $variacionesData->first()->stock }}</p>
                    <p>Precio: {{ $variacionesData->first()->precio }}</p>
                </div>
            @endif

            <div>
                <label for="cantidad">Cantidad:</label>
                <div>
                    <button type="button" wire:click="decrementarCantidad">−</button>
                    <span>{{ $cantidad }} </span>
                    <button type="button" wire:click="incrementarCantidad">+</button>
                </div>
                <p>Máximo {{ $variacionSeleccionada ? $variacionSeleccionada->stock : '' }} unidades.</p>
                <button wire:click="agregarCarrito">Agregar al carrito</button>
            </div>
        </div>

        <div class="dividir_2">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        </div>
    </div>

    <button wire:click="enviar()">Enviar</button>
</div>
