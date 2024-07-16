@section('tituloPagina', 'Transferencia de almacén detalle')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Transferencia de almacén detalle</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.transferencia-almacen.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.transferencia-almacen.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.transferencia-almacen.vista.todas') }}" class="g_boton g_boton_darkt">
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

                    <!--ID TRANSFERENCIA-->
                    <div class="g_margin_bottom_20">
                        <label for="transferencia_id">ID Transferencia</label>
                        <input type="text" id="transferencia_id" name="transferencia_id"
                            value="{{ $transferencia->id }}" disabled>
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" disabled>{{ $transferencia->descripcion }}</textarea>
                    </div>

                    <!--OBSERVACION-->
                    <div class="g_margin_bottom_20">
                        <label for="observacion">Observación</label>
                        <textarea id="observacion" name="observacion" disabled>{{ $transferencia->observacion }}</textarea>
                    </div>

                    <!--FECHA TRANSFERENCIA-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_transferencia">Fecha transferencia</label>
                        <input type="date" id="fecha_transferencia" name="fecha_transferencia"
                            value="{{ $transferencia->fecha_transferencia }}" disabled>
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
                                            <th>ID Variación</th>
                                            <th>Producto</th>
                                            <th>Color</th>
                                            <th>Talla</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalle as $item)
                                            <tr>
                                                <td class="g_resaltar">{{ $loop->iteration }}</td>
                                                <td class="g_resaltar">{{ $item->variacion->id}}</td>
                                                <td class="g_resaltar">ID: {{ $item->variacion->producto->id}}- {{ $item->variacion->producto->nombre}}</td>
                                                <td class="g_resaltar">{{ $item->variacion->color->nombre ?? '-' }}
                                                </td>
                                                <td class="g_resaltar">{{ $item->variacion->talla->nombre ?? '-' }}
                                                </td>
                                                <td class="g_inferior g_resumir">{{ $item->cantidad }}</td>
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

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Estado</h4>

                    <!--ESTADO-->
                    <input type="text" id="transferencia_id" name="transferencia_id"
                        value="{{ $transferencia->estado }}" disabled>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Completado</h4>

                    <!--COMPLETADO-->
                    <input type="text" id="completado" name="completado"
                        value="{{ $transferencia->completado == 1 ? 'Completado' : 'Falta' }}" disabled>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Origen</h4>

                    <!--SEDE ORIGEN-->
                    <div class="g_margin_bottom_20">
                        <label for="sedeOrigen">Sede origen</label>
                        <input type="text" id="sedeOrigen" name="sedeOrigen"
                            value="{{ $transferencia->sedeOrigen->nombre }}" disabled>
                    </div>

                    <!--ALMACEN ORIGEN-->
                    <div class="g_margin_bottom_20">
                        <label for="almacenOrigen">Almacén origen</label>
                        <input type="text" id="almacenOrigen" name="almacenOrigen"
                            value="{{ $transferencia->almacenOrigen->nombre }}" disabled>
                    </div>

                    <!--SERIE CORRELATIVO ORIGEN-->
                    <div class="g_margin_bottom_20">
                        <label for="serie_origen">Serie origen</label>
                        <input type="text" id="serie_origen" name="serie_origen"
                            value="{{ $transferencia->serie_origen }} - {{ $transferencia->correlativo_origen }}"
                            disabled>
                    </div>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Destino</h4>

                    <!--SEDE DESTINO-->
                    <div class="g_margin_bottom_20">
                        <label for="sedeDestino">Sede destino</label>
                        <input type="text" id="sedeDestino" name="sedeDestino"
                            value="{{ $transferencia->sedeDestino->nombre }}" disabled>
                    </div>

                    <!--ALMACEN DESTINO-->
                    <div class="g_margin_bottom_20">
                        <label for="almacenDestino">Almacén destino</label>
                        <input type="text" id="almacenDestino" name="almacenDestino"
                            value="{{ $transferencia->almacenDestino->nombre }}" disabled>
                    </div>

                    <!--SERIE CORRELATIVO DESTINO-->
                    <div class="g_margin_bottom_20">
                        <label for="serie_destino">Serie destino</label>
                        <input type="text" id="serie_destino" name="serie_destino"
                            value="{{ $transferencia->serie_destino }} - {{ $transferencia->correlativo_destino }}"
                            disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
