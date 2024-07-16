@section('tituloPagina', 'Transferencia entre almacen')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Transferencia entre almacén</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.transferencia-almacen.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.transferencia-almacen.vista.crear') }}" class="g_boton g_boton_primary">
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
                            <!--SEDES ORIGEN-->
                            <div class="g_margin_bottom_20">
                                <label for="sede_origen_id">Sedes origen</label>
                                <select id="sede_origen_id" name="sede_origen_id" wire:model.live="sede_origen_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($sedes_origen as $sede)
                                        <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <!--ALMACEN-->
                            <div class="g_margin_bottom_20">
                                <label for="almacen_origen_id">Almacén origen</label>
                                <select id="almacen_origen_id" name="almacen_origen_id" wire:model.live="almacen_origen_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($almacenes_origen as $almacen)
                                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <!--SERIE-->
                            <div>
                                <label for="serie_origen_nombre">Serie</label>
                                <select id="serie_origen_nombre" name="serie_origen_nombre" wire:model.live="serie_origen_nombre">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($series_origen as $serie)
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
        @if ($transferencias->count())
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
                                <th>Fecha</th>
                                <th>Sede Origen</th>
                                <th>Almacen Origen</th>
                                <th>Serie Origen</th>
                                <th>Sede Destino</th>
                                <th>Almacen Destino</th>
                                <th>Serie Destino</th>
                                <th>Estado</th>
                                <th>Descripción</th>
                                <th>Observación</th>
                                <th>Completado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferencias as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->id }}</td>
                                    <td class="g_resaltar">{{ $item->fecha_transferencia }}</td>
                                    <td class="g_resaltar">{{ $item->sedeOrigen->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->almacenOrigen->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->serie_origen }} - {{ $item->correlativo_origen }}</td>
                                    <td class="g_resaltar">{{ $item->sedeDestino->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->almacenDestino->nombre }}</td>
                                    <td class="g_resaltar">{{ $item->serie_destino }} - {{ $item->correlativo_destino }}</td>
                                    <td class="g_inferior"> {{ $item->estado }} </td>
                                    <td class="g_inferior g_resumir">{{ $item->descripcion }}</td>
                                    <td class="g_inferior g_resumir">{{ $item->observacion }}</td>
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
                                        <a href="{{ route('erp.transferencia-almacen-detalle.vista.ver', ['id' => $item->id]) }}"
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

            @if ($transferencias->hasPages())
                <div>
                    {{ $transferencias->onEachSide(1)->links() }}
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
