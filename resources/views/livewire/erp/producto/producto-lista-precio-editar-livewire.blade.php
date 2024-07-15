@section('tituloPagina', 'Producto lista precio')

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

            <a href="{{ route('erp.producto.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.producto.variacion.vista.editar', $producto) }}" class="g_boton g_boton_info">
                Variación <i class="fa-solid fa-align-center"></i></a>

            <a href="{{ route('erp.producto.inventario.vista.ver', ['id' => $producto->id]) }}"
                class="g_boton g_boton_warning">
                Inventario <i class="fa-solid fa-list-ol"></i></a>

            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">General</h4>

                    <!--ID-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">ID Producto</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $producto->id }}" disabled>
                    </div>

                    <!--NOMBRE-->
                    <div>
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" disabled>
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Variación</h4>

                    <!--TALLA-->
                    <div class="g_margin_bottom_20">
                        <div class="boton_checkbox boton_checkbox_deshabilitado">
                            <label for="variacion_talla">Tiene talla</label>
                            <input type="checkbox" id="variacion_talla" name="variacion_talla"
                                @if ($producto->variacion_talla) checked @endif onclick="return false;">
                        </div>
                        <p class="leyenda">No se puede modificar.</p>
                    </div>

                    <!--COLOR-->
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

    <!--TABLA-->
    <div class="g_panel">
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
            <div class="tabla_contenido g_margin_bottom_20">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>ID Variación</th>
                                @if ($tipo_variacion == 'talla-color')
                                    <th>Talla</th>
                                    <th>Color</th>
                                @elseif ($tipo_variacion == 'talla')
                                    <th>Talla</th>
                                @elseif ($tipo_variacion == 'color')
                                    <th>Color</th>
                                @endif
                                @foreach ($listasPrecios as $listaPrecio)
                                    <th>{{ $listaPrecio->nombre }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php $index = 1; @endphp

                            @foreach ($variaciones as $variacion)
                                <tr>
                                    <td class="g_inferior">{{ $index++ }}</td>
                                    <td class="g_inferior">{{ $variacion["id"]}}</td>
                                    @if ($tipo_variacion == 'talla-color')
                                        <td class="g_inferior">{{ $variacion['talla']['nombre'] }}</td>
                                        <td class="g_inferior">{{ $variacion['color']['nombre'] }}</td>
                                    @elseif ($tipo_variacion == 'talla')
                                        <td class="g_inferior">{{ $variacion['talla']['nombre'] }}</td>
                                    @elseif ($tipo_variacion == 'color')
                                        <td class="g_inferior">{{ $variacion['color']['nombre'] }}</td>
                                    @endif
                                    @foreach ($listasPrecios as $listaPrecio)
                                        <td>
                                            <div class="contenedor_lista_precios" x-data="{ precio: {{ collect($variacion['precios'])->firstWhere('id', $listaPrecio->id)['pivot']['precio'] ?? 0.1 }} }">
                                                <input type="number" x-model="precio"
                                                    @input="if (precio <= 0) precio = 0.1" step="0.01" min="0.1"
                                                    wire:model.lazy="precios.{{ $variacion['id'] }}.{{ $listaPrecio->id }}"
                                                    value="{{ collect($variacion['precios'])->firstWhere('id', $listaPrecio->id)['pivot']['precio'] ?? 0.1 }}">

                                                <button
                                                    wire:click="guardarPrecio({{ $variacion['id'] }}, {{ $listaPrecio->id }})">Actualizar</button>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($listasPrecios->count())
                <div class="formulario_botones">
                    <button wire:click="guardarPrecioMasivamente" class="guardar">Guardar masivamente</button>
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No tiene variación.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
