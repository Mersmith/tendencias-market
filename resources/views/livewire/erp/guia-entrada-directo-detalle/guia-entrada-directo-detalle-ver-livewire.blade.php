@section('tituloPagina', 'Guia Entrada Directo detalle')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Guia entrada directo detalle</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.guia-entrada-directo.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.guia-entrada-directo.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.guia-entrada-directo.vista.todas') }}" class="g_boton g_boton_darkt">
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

                    <!--ID ENTRADA-->
                    <div class="g_margin_bottom_20">
                        <label for="guia_id">ID Guia</label>
                        <input type="text" id="guia_id" name="guia_id" value="{{ $guia->id }}" disabled>
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" disabled>{{ $guia->descripcion }}</textarea>
                    </div>

                    <!--OBSERVACION-->
                    <div class="g_margin_bottom_20">
                        <label for="observacion">Observación</label>
                        <textarea id="observacion" name="observacion" disabled>{{ $guia->observacion }}</textarea>
                    </div>

                    <!--FECHA ENTRADA-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_entrada">Fecha entrada</label>
                        <input type="date" id="fecha_entrada" name="fecha_entrada" value="{{ $guia->fecha_entrada }}"
                            disabled>
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Estado</h4>

                    <!--ESTADO-->
                    <input type="text" id="estado" name="estado" value="{{ $guia->estado }}" disabled>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Completado</h4>

                    <!--COMPLETADO-->
                    <input type="text" id="completado" name="completado"
                        value="{{ $guia->completado == 1 ? 'Completado' : 'Falta' }}" disabled>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Detalle</h4>

                    <!--SEDE-->
                    <div class="g_margin_bottom_20">
                        <label for="sede_id">Sede</label>
                        <input type="text" id="sede_id" name="sede_id" value="{{ $guia->sede->nombre }}" disabled>
                    </div>

                    <!--ALMACEN-->
                    <div class="g_margin_bottom_20">
                        <label for="almacen_id">Almacén</label>
                        <input type="text" id="almacen_id" name="almacen_id" value="{{ $guia->almacen->nombre }}"
                            disabled>
                    </div>

                    <!--SERIE CORRELATIVO-->
                    <div class="g_margin_bottom_20">
                        <label for="serie_id">Serie</label>
                        <input type="text" id="serie_id" name="serie_id" value="{{ $guia->serie }} - {{ $guia->correlativo }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($detalle->count())
            <!--TABLA CABECERA-->
            <div class="tabla_cabecera">
                <!--TABLA CABECERA BOTONES-->
                <div class="tabla_cabecera_botones">
                    <button>PDF <i class="fa-solid fa-file-pdf"></i></button>
                    <button>EXCEL <i class="fa-regular fa-file-excel"></i></button>
                </div>
            </div>

            <!--TABLA CONTENIDO-->
            <div class="tabla_contenido">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>ID Variacion</th>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Stock</th>
                                <th>Stock mínimo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalle as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->id }}</td>
                                    <td class="g_resaltar">ID: {{ $item->variacion->producto->id }} -
                                        {{ $item->variacion->producto->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->talla->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->color->nombre ?? '-' }}</td>
                                    <td class="g_inferior g_resumir">{{ $item->stock }}</td>
                                    <td class="g_inferior g_resumir">{{ $item->stock_minimo }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
