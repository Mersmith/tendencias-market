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
                <!-- Selección de color -->
                <div>
                    <label for="color">Selecciona un color:</label>
                    <select id="color" wire:model.live="selectedColor">
                        <option value="">Selecciona un color</option>
                        @foreach ($variacionesData as $colorId => $items)
                            <option value="{{ $colorId }}">Color {{ $colorId }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Mostrar tallas según el color seleccionado -->
                @if ($selectedColor)
                    <div>
                        <label for="size">Selecciona una talla:</label>
                        <select id="size" wire:model.live="selectedSize">
                            <option value="">Selecciona una talla</option>
                            @foreach ($variacionesData[$selectedColor] as $item)
                                <option value="{{ $item->talla_id }}">Talla {{ $item->talla_id }} - Stock:
                                    {{ $item->stock }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @elseif ($tipo_variacion == 'VARIA-COLOR')
                <div>
                    <label for="color">Selecciona un color:</label>
                    <select id="color" wire:model.live="selectedColor">
                        <option value="">Selecciona un color</option>
                        @foreach ($variacionesData as $colorId => $items)
                            @php
                                // Calcular el stock total para el color
                                $totalStock = $items->sum('stock');
                            @endphp
                            <option value="{{ $colorId }}">Color {{ $colorId }} - Stock:
                                {{ $totalStock }}</option>
                        @endforeach
                    </select>
                </div>
            @elseif ($tipo_variacion == 'VARIA-TALLA')
                <div>
                    <label for="size">Selecciona una talla:</label>
                    <select id="size" wire:model.live="selectedSize">
                        <option value="">Selecciona una talla</option>
                        @foreach ($variacionesData as $tallaId => $items)
                            @php
                                // Calcular el stock total para la talla
                                $totalStock = $items->sum('stock');
                            @endphp
                            <option value="{{ $tallaId }}">Talla {{ $tallaId }} - Stock:
                                {{ $totalStock }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div>
                    <p>Stock disponible: {{ $variacionesData->first()->stock }}</p>
                    <p>Precio: {{ $variacionesData->first()->precio }}</p>
                </div>
            @endif
        </div>

        <div class="dividir_2">

            <div>
                @foreach ($variaciones as $item)
                    <div class="variacionesData-item">
                        <h2>{{ $item->nombre }}</h2>
                        <p>{{ $item->descripcion }}</p>
                        <p><strong>Precio:</strong> {{ $item->simbolo }}{{ $item->precio }}</p>
                        @if ($item->porcentaje_descuento)
                            <p><strong>Descuento:</strong> {{ $item->porcentaje_descuento }}% hasta
                                {{ \Carbon\Carbon::parse($item->descuento_fecha_fin)->format('d/m/Y H:i') }}</p>
                        @endif
                        <p><strong>Stock:</strong> {{ $item->stock }}</p>
                        <p><strong>Color ID:</strong> {{ $item->color_id }}</p>
                        <p><strong>Talla ID:</strong> {{ $item->talla_id }}</p>
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
