@section('tituloPagina', 'Inventario')

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

    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_12">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">Almacén</h4>

                    <div class="g_fila">
                        <div class="g_columna_6">
                            <div class="g_margin_bottom_20">
                                <label for="sede_id">Sedes <span class="obligatorio"><i
                                            class="fa-solid fa-asterisk"></i></span></label>
                                <select id="sede_id" name="sede_id" wire:model.live="sede_id">
                                    <option value="null" selected disabled>Seleccione</option>
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="g_columna_6">
                            <div>
                                <label for="almacen_id">Almacén <span class="obligatorio"><i
                                            class="fa-solid fa-asterisk"></i></span></label>
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

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="g_panel">
        <!--TABLA-->
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
                        <input type="text" wire:model.debounce.1300ms="buscarProducto" id="buscarProducto"
                            name="buscarProducto" placeholder="Buscar...">
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
                                <th>Nombre producto</th>
                                <th>Nombre color</th>
                                <th>Nombre talla</th>
                                <th>Stock</th>
                                <th>Stock mínimo</th>
                                <th>Variación Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventario as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->producto->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->color->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $item->variacion->talla->nombre ?? '-' }}</td>
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
