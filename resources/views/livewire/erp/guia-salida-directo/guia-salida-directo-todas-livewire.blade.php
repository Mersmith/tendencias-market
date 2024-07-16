@section('tituloPagina', 'Guias Salida Directo')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Guias Salida Directo</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.guia-salida-directo.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.guia-salida-directo.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_12">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Almacén</h4>

                    <div class="g_fila">
                        <div class="g_columna_4">
                            <!--SEDES-->
                            <div class="g_margin_bottom_20">
                                <label for="sede_id">Sedes</label>
                                <select id="sede_id" name="sede_id" wire:model.live="sede_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <!--ALMACEN-->
                            <div class="g_margin_bottom_20">
                                <label for="almacen_id">Almacén</label>
                                <select id="almacen_id" name="almacen_id" wire:model.live="almacen_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($almacenes as $almacen)
                                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <!--SERIE-->
                            <div>
                                <label for="serie_nombre">Serie</label>
                                <select id="serie_nombre" name="serie_nombre" wire:model.live="serie_nombre">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($series as $serie)
                                        <option value="{{ $serie->nombre }}">{{ $serie->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        @if ($guias->count())
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
                        <input type="text" wire:model.live.debounce.1300ms="buscarGuia" id="buscarGuia"
                            name="buscarGuia" placeholder="Buscar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
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
                                <th>ID</th>
                                <th>Serie</th>
                                <th>Correlativo</th>
                                <th>Fecha</th>
                                <th>Sede</th>
                                <th>Almacen</th>
                                <th>Estado</th>
                                <th>Descripción</th>
                                <th>Observación</th>
                                <th>Completado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guias as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }} </td>
                                    <td class="g_resaltar">{{ $item->id }} </td>
                                    <td class="g_resaltar">{{ $item->serie }} </td>
                                    <td class="g_resaltar">{{ $item->correlativo }} </td>
                                    <td class="g_resaltar">{{ $item->fecha_salida }} </td>
                                    <td class="g_resaltar">{{ $item->sede->nombre }} </td>
                                    <td class="g_resaltar">{{ $item->almacen->nombre }} </td>
                                    <td class="g_inferior">{{ $item->estado }} </td>
                                    <td class="g_inferior g_resumir">{{ $item->descripcion }} </td>
                                    <td class="g_inferior g_resumir">{{ $item->observacion }} </td>
                                    <td class="g_inferior">
                                        <span
                                            class="estado {{ $item->completado == 1 ? 'g_activo' : 'g_desactivado' }}"><i
                                                class="fa-solid fa-circle"></i></span>
                                        @if ($item->completado == 1)
                                            Completado
                                        @else
                                            Falta
                                        @endif
                                    </td>
                                    <td class="centrar_iconos">
                                        <a href="{{ route('erp.guia-salida-directo-detalle.vista.ver', ['id' => $item->id]) }}"
                                            class="g_inventario">
                                            <span><i class="fa-solid fa-list"></i> Detalle</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($guias->hasPages())
                <div>
                    {{ $guias->onEachSide(1)->links() }}
                </div>
            @endif
        @else
            <div class="g_vacio">
                <p>No hay elementos.</p>
                <i class="fa-regular fa-face-grin-wink"></i>
            </div>
        @endif
    </div>
</div>
