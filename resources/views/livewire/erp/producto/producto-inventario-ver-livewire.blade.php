@section('tituloPagina', 'Producto inventario')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Producto inventario</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.producto.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.producto.variacion.vista.editar', $producto) }}" class="g_boton g_boton_info">
                Variación <i class="fa-solid fa-align-center"></i></a>

            <a href="{{ route('erp.producto.lista-precio.vista.editar', ['id' => $producto->id]) }}"
                class="g_boton g_boton_success">
                Lista Precio <i class="fa-solid fa-dollar-sign"></i></a>

            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
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

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Almacén</h4>

                    <div class="g_fila">
                        <div class="g_columna_6">
                            <!--SEDE-->
                            <div class="g_margin_bottom_20">
                                <label for="sede_id">Sedes</label>
                                <select id="sede_id" name="sede_id" wire:model.live="sede_id">
                                    <option value="null" selected disabled>Seleccione</option>
                                    @if ($sedes)
                                        @foreach ($sedes as $sede)
                                            <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_6">
                            <!--ALMACEN-->
                            <div>
                                <label for="almacen_id">Almacén</label>
                                <select id="almacen_id" name="almacen_id" wire:model.live="almacen_id">
                                    <option value="null" selected disabled>Seleccione</option>
                                    @if ($almacenes)
                                        @foreach ($almacenes as $almacen)
                                            <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
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
            <!--TABLA CABECERA-->
            <div class="tabla_cabecera">
                <!--TABLA CABECERA BOTONES-->
                <div class="tabla_cabecera_botones">
                    <button>
                        PDF <i class="fa-solid fa-file-pdf"></i>
                    </button>

                    <button>
                        EXCEL <i class="fa-regular fa-file-excel"></i>
                    </button>
                </div>

                <!--TABLA CABECERA BUSCAR-->
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
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $index = 1; @endphp

                            @if ($tipo_variacion == 'talla-color')
                                @foreach ($variaciones as $variacion)
                                    <tr>
                                        <td class="g_inferior">{{ $index++ }}</td>
                                        <td>{{ $variacion['id']}}</td>
                                        <td class="g_inferior">{{ $variacion['talla']['nombre'] }}</td>
                                        <td class="g_inferior">{{ $variacion['color']['nombre'] }}</td>
                                        <td class="g_resaltar">
                                            @if (isset($variacion['inventarios'][0]))
                                                {{ $variacion['inventarios'][0]['stock'] ?? 'No tiene stock' }}
                                            @else
                                                No tiene stock
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif ($tipo_variacion == 'talla')
                                @foreach ($variaciones as $variacion)
                                    <tr>
                                        <td class="g_inferior">{{ $loop->iteration }}</td>
                                        <td>{{ $variacion['id']}}</td>
                                        <td class="g_inferior">{{ $variacion['talla']['nombre'] }}</td>
                                        <td class="g_resaltar">
                                            @if (isset($variacion['inventarios'][0]))
                                                {{ $variacion['inventarios'][0]['stock'] ?? 'No tiene stock' }}
                                            @else
                                                No tiene stock
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif ($tipo_variacion == 'color')
                                @foreach ($variaciones as $variacion)
                                    <tr>
                                        <td class="g_inferior">{{ $loop->iteration }}</td>
                                        <td>{{ $variacion['id']}}</td>
                                        <td class="g_inferior">{{ $variacion['color']['nombre'] }}</td>
                                        <td class="g_resaltar">
                                            @if (isset($variacion['inventarios'][0]))
                                                {{ $variacion['inventarios'][0]['stock'] ?? 'No tiene stock' }}
                                            @else
                                                No tiene stock
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($variaciones as $variacion)
                                    <tr>
                                        <td class="g_inferior">{{ $loop->iteration }}</td>
                                        <td class="g_resaltar">
                                            @if (isset($variacion['inventarios'][0]))
                                                {{ $variacion['inventarios'][0]['stock'] ?? 'No tiene stock' }}
                                            @else
                                                No tiene stock
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="g_vacio">
                <p>No tiene variación.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
