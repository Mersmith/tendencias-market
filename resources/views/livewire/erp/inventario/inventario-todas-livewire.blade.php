@section('tituloPagina', 'Inventario')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Inventario</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.inventario.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>
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
                        <div class="g_columna_6">
                            <!--SEDES-->
                            <div class="g_margin_bottom_20">
                                <label for="sede_id">Sedes</label>
                                <select id="sede_id" name="sede_id" wire:model.live="sede_id">
                                    <option value="null" selected disabled>Seleccione</option>
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_6">
                            <!--ALMACEN-->
                            <div>
                                <label for="almacen_id">Almacén</label>
                                <select id="almacen_id" name="almacen_id" wire:model.live="almacen_id">
                                    <option value="null" selected disabled>Seleccione</option>
                                    @foreach ($almacenes as $almacen)
                                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
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
        @if ($inventario->count())
            <div class="tabla_cabecera">
                <!-- TABLA CABECERA BOTONES -->
                <div class="tabla_cabecera_botones">
                    <button>PDF <i class="fa-solid fa-file-pdf"></i></button>

                    <button>EXCEL <i class="fa-regular fa-file-excel"></i></button>
                </div>

                <!-- TABLA CABECERA BUSCAR -->
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" wire:model.live.debounce.1300ms="buscarProducto" id="buscarProducto"
                            name="buscarProducto" placeholder="Buscar...">
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
                                <th>ID</th>
                                <th>ID Variación</th>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Stock</th>
                                <th>Stock mínimo</th>
                                <th>Variación Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventario as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->id }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->id }}</td>
                                    <td class="g_resaltar">ID: {{ $item->variacion->producto->id }} -
                                        {{ $item->variacion->producto->nombre }}</td>
                                        <td class="g_resaltar">{{ $item->variacion->talla->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->color->nombre ?? '-' }}</td>
                                    <td class="g_inferior g_resumir">{{ $item->stock }}</td>
                                    <td class="g_inferior g_resumir">{{ $item->stock_minimo }}</td>
                                    <td class="g_inferior">
                                        <span
                                            class="estado {{ $item->variacion->activo == 1 ? 'g_activo' : 'g_desactivado' }}">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                        {{ $item->variacion->activo == 1 ? 'Activo' : 'Desactivo' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($inventario->hasPages())
                <div>
                    {{ $inventario->onEachSide(1)->links() }}
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
