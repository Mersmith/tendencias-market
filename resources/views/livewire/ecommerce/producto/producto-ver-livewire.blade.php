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
                    <label for="color">Selecciona un color:</label>
                    <select id="color" wire:model.live="selectedColor">
                        <option value="">Selecciona un color</option>
                        @foreach ($variacionesData as $colorId => $items)
                            <option value="{{ $colorId }}">Color {{ $items->first()->color_nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Mostrar tallas según el color seleccionado -->
                @if ($selectedColor)
                    <div>
                        <label for="size">Selecciona una talla:</label>
                        <select id="size" wire:model.live="selectedSize"
                            wire:change="selectVariation(selectedColor, selectedSize)">
                            <option value="">Selecciona una talla</option>
                            @foreach ($variacionesData[$selectedColor] as $item)
                                <option value="{{ $item->talla_id }}">Talla {{ $item->talla_nombre }} - Stock:
                                    {{ $item->stock }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="quantity">Cantidad:</label>
                        <input type="number" id="quantity" wire:model.live="quantity" min="1"
                            max="{{ $selectedVariation ? $selectedVariation->stock : 1 }}">
                    </div>
                @endif

                <!-- Botón para agregar al carrito -->
                @if ($selectedVariation)
                    <button wire:click="addToCart">Agregar al carrito</button>
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
                            <option value="{{ $colorId }}">Color {{ $items->first()->color_nombre }} - Stock:
                                {{ $totalStock }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo para cantidad -->
                @if ($selectedColor)
                    <div>
                        <label for="quantity">Cantidad:</label>
                        <input type="number" id="quantity" wire:model.live="quantity" min="1"
                            max="{{ $variacionesData[$selectedColor]->sum('stock') }}">
                    </div>

                    <!-- Botón para agregar al carrito -->
                    <button wire:click="addToCart">Agregar al carrito</button>
                @endif
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
                            <option value="{{ $tallaId }}">Talla {{ $items->first()->talla_nombre }} - Stock:
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
