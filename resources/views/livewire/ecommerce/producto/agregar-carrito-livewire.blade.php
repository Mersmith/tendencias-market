<div class="contenedor_agregar_carrito">

    <!-- VARIACION -->
    <div class="variacion_carrito">
        @if ($tipo_variacion == 'VARIA-COLOR-TALLA')
            <div>
                <label>Color: {{ $color_seleccionado }} </label>
                <div class="contenedor_color">
                    @foreach ($variacion_agrupada as $colorId => $items)
                        <label for="color_{{ $colorId }}">
                            <div>
                                <input type="radio" id="color_{{ $colorId }}" name="color"
                                    value="{{ $colorId }}" wire:model.live="color_seleccionado">
                                {{-- $items->first()->color_nombre --}}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Mostrar tallas según el color seleccionado -->
            @if ($color_seleccionado)
                <div>
                    <label>Talla:</label>
                    <div class="contenedor_talla">
                        @foreach ($variacion_agrupada[$color_seleccionado] as $item)
                            <label for="talla_{{ $item->talla_id }}">
                                <input type="radio" id="talla_{{ $item->talla_id }}" name="talla"
                                    value="{{ $item->talla_id }}" wire:model.live="talla_seleccionado">
                                {{ $item->talla_nombre }} {{-- $item->stock --}}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- Botón para agregar al carrito -->
        @elseif ($tipo_variacion == 'VARIA-COLOR')
            <div>
                <label>Color:</label>
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
                <label>Talla:</label>
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
    </div>

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
