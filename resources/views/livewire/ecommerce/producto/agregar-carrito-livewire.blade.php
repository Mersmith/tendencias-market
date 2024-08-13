<div class="contenedor_agregar_carrito">
    {{-- <div class="variacion_carrito">
        @if ($tipo_variacion == 'VARIA-COLOR-TALLA')
            <div>
                <label>Selecciona un color:</label>
                @foreach ($variacion_agrupada as $colorId => $items)
                    <div class="color-option">
                        <input type="radio" id="color_{{ $colorId }}" name="color" value="{{ $colorId }}"
                            wire:model.live="color_seleccionado">
                        <label for="color_{{ $colorId }}">Color {{ $items->first()->color_nombre }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Mostrar tallas según el color seleccionado -->
            @if ($color_seleccionado)
                <div>
                    <label>Selecciona una talla:</label>
                    @foreach ($variacion_agrupada[$color_seleccionado] as $item)
                        <div class="talla-option">
                            <input type="radio" id="talla_{{ $item->talla_id }}" name="talla"
                                value="{{ $item->talla_id }}" wire:model.live="talla_seleccionado">
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
                @foreach ($variacion_agrupada as $colorId => $items)
                    @php
                        // Calcular el stock total para el color
                        $totalStock = $items->sum('stock');
                    @endphp
                    <div class="color-option">
                        <input type="radio" id="color_{{ $colorId }}" name="color" value="{{ $colorId }}"
                            wire:model.live="color_seleccionado">
                        <label for="color_{{ $colorId }}">Color {{ $items->first()->color_nombre }} - Stock:
                            {{ $totalStock }}</label>
                    </div>
                @endforeach
            </div>
        @elseif ($tipo_variacion == 'VARIA-TALLA')
            <div>
                <label>Selecciona una talla:</label>
                @foreach ($variacion_agrupada as $tallaId => $items)
                    @php
                        // Calcular el stock total para la talla
                        $totalStock = $items->sum('stock');
                    @endphp
                    <div class="talla-option">
                        <input type="radio" id="talla_{{ $tallaId }}" name="talla"
                            value="{{ $tallaId }}" wire:model.live="talla_seleccionado">
                        <label for="talla_{{ $tallaId }}">Talla {{ $items->first()->talla_nombre }} - Stock:
                            {{ $totalStock }}</label>
                    </div>
                @endforeach
            </div>
        @else
            <div>
                <p>Stock disponible: {{ $variacion_agrupada->first()->stock }}</p>
                <p>Precio: {{ $variacion_agrupada->first()->precio }}</p>
            </div>
        @endif
    </div> --}}

    <!-- CONTROLES -->
    <div class="controles_carrito">
        <div class="botones">
            <button type="button" wire:click="decrementarCantidad"><i class="fa-solid fa-minus"></i></button>
            <span>{{ $cantidad }} </span>
            <button type="button" wire:click="incrementarCantidad"><i class="fa-solid fa-plus"></i></button>
        </div>

        <p>Máximo {{ $variacion_seleccionada ? $variacion_seleccionada->stock : '' }} unidades.</p>


        <button wire:click="agregarCarrito" class="boton_agregar_carrito">Agregar al carrito</button>

        <div>
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



    {{-- <button wire:click="enviar()">Enviar</button> --}}

</div>
