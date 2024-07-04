@section('tituloPagina', 'Guia Salida Directo')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Guia Salida Directo</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.guia-salida-directo.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.guia-salida-directo.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.guia-salida-directo.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>

                    <div class="g_margin_bottom_20">
                        <label for="guia_id">ID </label>
                        <input type="text" id="guia_id" name="guia_id" value="{{ $guia->id }}" disabled>
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" disabled>{{ $guia->descripcion }}</textarea>
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="observacion">Observación</label>
                        <textarea id="observacion" name="observacion" disabled>{{ $guia->observacion }}</textarea>
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="fecha_salida">Fecha salida</label>
                        <input type="date" id="fecha_salida" name="fecha_salida" value="{{ $guia->fecha_salida }}"
                            disabled>
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">Estado</h4>

                    <input type="text" id="guia_id" name="guia_id" value="{{ $guia->estado }}" disabled>
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Completado</h4>

                    <input type="text" id="guia_id" name="guia_id"
                        value="{{ $guia->completado == 1 ? 'Completado' : 'Falta' }}" disabled>
                </div>
            </div>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="g_panel">
        <!--TABLA-->
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
                    <!--TABLA-->
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre producto</th>
                                <th>Nombre color</th>
                                <th>Nombre talla</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalle as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->producto->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->color->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->talla->nombre ?? '-' }}</td>
                                    <td class="g_inferior g_resumir">-{{ $item->cantidad }}</td>
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
