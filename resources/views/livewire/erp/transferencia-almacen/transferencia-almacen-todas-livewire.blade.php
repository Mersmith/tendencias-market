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
