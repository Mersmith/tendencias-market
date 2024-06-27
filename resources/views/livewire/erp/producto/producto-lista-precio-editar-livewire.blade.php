@section('tituloPagina', 'Productos')

<div>
    <!-- CABECERA TITULO PAGINA -->
    <div class="g_panel cabecera_titulo_pagina">
        <!-- TITULO -->
        <h2>Producto lista precio</h2>

        <!-- BOTONES -->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i>
            </a>
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>

    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>
                    <div>
                        <label for="nombre">Nombre <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" disabled>
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">Variación</h4>
                    <div class="g_margin_bottom_20">
                        <div class="boton_checkbox boton_checkbox_deshabilitado">
                            <label for="variacion_talla">Tiene talla</label>
                            <input type="checkbox" id="variacion_talla" name="variacion_talla"
                                @if ($producto->variacion_talla) checked @endif onclick="return false;">
                        </div>
                        <p class="leyenda">No se puede modificar.</p>
                    </div>

                    <div class="">
                        <div class="boton_checkbox boton_checkbox_deshabilitado">
                            <label for="variacion_color">Tiene color</label>
                            <input type="checkbox" id="variacion_color" name="variacion_color"
                                @if ($producto->variacion_color) checked @endif onclick="return false;">
                        </div>
                        <p class="leyenda">No se puede modificar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENEDOR PÁGINA ADMINISTRADOR -->
    <div class="g_panel">
        <!-- TABLA -->
        @if (!empty($variaciones))
            <!-- TABLA CABECERA -->
            <div class="tabla_cabecera">
                <!-- TABLA CABECERA BOTONES -->
                <div class="tabla_cabecera_botones">
                    <button>
                        PDF <i class="fa-solid fa-file-pdf"></i>
                    </button>
                    <button>
                        EXCEL <i class="fa-regular fa-file-excel"></i>
                    </button>
                </div>

                <!-- TABLA CABECERA BUSCAR -->
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" id="buscarProducto" name="buscarProducto" placeholder="Buscar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
            </div>

            <!-- TABLA CONTENIDO -->
            <div class="tabla_contenido">
                <div class="contenedor_tabla">
                    <!-- TABLA -->
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                @if ($tipo_variacion == 'talla-color')
                                    <th>Talla</th>
                                    <th>Color</th>
                                @elseif ($tipo_variacion == 'talla')
                                    <th>Talla</th>
                                @elseif ($tipo_variacion == 'color')
                                    <th>Color</th>
                                @else
                                @endif
                                <th>Stock</th>
                                <th>Lista precios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $index = 1; @endphp

                            @if ($tipo_variacion == 'talla-color')
                                @foreach ($variaciones as $tallaId => $variacionesPorTalla)
                                    @foreach ($variacionesPorTalla as $variacion)
                                        <tr>
                                            <td class="g_inferior">{{ $index++ }}</td>
                                            <td class="g_inferior">{{ $variacion['talla']['nombre'] }}</td>
                                            <td class="g_inferior">{{ $variacion['color']['nombre'] }}</td>
                                            <td class="g_resaltar">{{ $variacion['inventario']['stock'] }}</td>
                                            <td class="g_resaltar">
                                                @foreach ($listasPrecios as $listaPrecio)
                                                    <div>
                                                        <h3>{{ $listaPrecio->nombre }}</h3>
                                                        <input type="number"
                                                            wire:model.lazy="precios.{{ $variacion['id'] }}.{{ $listaPrecio->id }}"
                                                            value="{{ $precios[$variacion['id']][$listaPrecio->id] ?? 0 }}">
                                                        <button
                                                            wire:click="guardarPrecio({{ $variacion['id'] }}, {{ $listaPrecio->id }})">Guardar</button>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @elseif ($tipo_variacion == 'talla')
                                @foreach ($variaciones as $tallaId => $variacionesPorTalla)
                                    <tr>
                                        <td class="g_inferior">{{ $loop->iteration }}</td>
                                        <td class="g_inferior">{{ $variacionesPorTalla[0]['talla']['nombre'] }}</td>
                                        <td class="g_resaltar">{{ $variacionesPorTalla[0]['inventario']['stock'] }}
                                        </td>
                                        <td class="g_resaltar">
                                            @foreach ($variacionesPorTalla as $variacion)
                                                @foreach ($listasPrecios as $listaPrecio)
                                                    <div>
                                                        <h3>{{ $listaPrecio->nombre }}</h3>
                                                        <input type="number"
                                                            wire:model.lazy="precios.{{ $variacion['id'] }}.{{ $listaPrecio->id }}"
                                                            value="{{ $precios[$variacion['id']][$listaPrecio->id] ?? 0 }}">
                                                        <button
                                                            wire:click="guardarPrecio({{ $variacion['id'] }}, {{ $listaPrecio->id }})">Guardar</button>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif ($tipo_variacion == 'color')
                                @foreach ($variaciones as $colorId => $variacionesPorColor)
                                    <tr>
                                        <td class="g_inferior">{{ $loop->iteration }}</td>
                                        <td class="g_inferior">{{ $variacionesPorColor[0]['color']['nombre'] }}</td>
                                        <td class="g_resaltar">{{ $variacionesPorColor[0]['inventario']['stock'] }}
                                        </td>
                                        <td>
                                            @foreach ($variacionesPorColor as $variacion)
                                                @foreach ($listasPrecios as $listaPrecio)
                                                    <div>
                                                        <h3>{{ $listaPrecio->nombre }}</h3>
                                                        <input type="number"
                                                            wire:model.lazy="precios.{{ $variacion['id'] }}.{{ $listaPrecio->id }}"
                                                            value="{{ $precios[$variacion['id']][$listaPrecio->id] ?? 0 }}">
                                                        <button
                                                            wire:click="guardarPrecio({{ $variacion['id'] }}, {{ $listaPrecio->id }})">Guardar</button>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($variaciones as $variacion)
                                    <tr>
                                        <td class="g_inferior">{{ $loop->iteration }}</td>
                                        <td class="g_resaltar">{{ $variacion['inventario']['stock'] }}</td>
                                        <td class="g_resaltar">
                                            @foreach ($listasPrecios as $listaPrecio)
                                                <div>
                                                    <h3>{{ $listaPrecio->nombre }}</h3>
                                                    <input type="number"
                                                        wire:model.lazy="precios.{{ $variacion['id'] }}.{{ $listaPrecio->id }}"
                                                        value="{{ $precios[$variacion['id']][$listaPrecio->id] ?? 0 }}">
                                                    <button
                                                        wire:click="guardarPrecio({{ $variacion['id'] }}, {{ $listaPrecio->id }})">Guardar</button>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <button wire:click="guardarPrecioMasivamente">Guardar masivamente</button>
                </div>
            </div>
        @else
            <div class="g_vacio">
                <p>No hay elementos.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
