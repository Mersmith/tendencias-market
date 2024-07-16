@section('tituloPagina', 'Guia de Salida Directo')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear Guia de Salida Directo</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.guia-salida-directo.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.guia-salida-directo.vista.todas') }}" class="g_boton g_boton_darkt">
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

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" name="descripcion" wire:model="descripcion" rows="3"></textarea>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--OBSERVACION-->
                    <div class="g_margin_bottom_20">
                        <label for="observacion">Observación</label>
                        <textarea id="observacion" name="observacion" wire:model="observacion" rows="3"></textarea>
                        @error('observacion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--FECHA SALIDA-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_salida">Fecha salida <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="date" id="fecha_salida" name="fecha_salida" wire:model.live="fecha_salida">
                        @error('fecha_salida')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!--TABLA DETALLE-->
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Detalle</h4>

                    <div class="tabla_contenido">
                        <div class="contenedor_tabla">
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Producto</th>
                                        <th>Color</th>
                                        <th>Talla</th>
                                        <th>Stock actual</th>
                                        <th>Cantidad quitar</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalles as $index => $detalle)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>IDV: {{ $detalle['variacion_id'] }} - {{ $detalle['producto_nombre'] }}</td>
                                            <td>{{ $detalle['color_nombre'] }}</td>
                                            <td>{{ $detalle['talla_nombre'] }}</td>
                                            <td>{{ $detalle['stock_actual'] }}</td>
                                            <td>
                                                <input type="number" min="1" x-data="{ maxStock: {{ $detalle['stock_actual'] }} }"
                                                    @input="
                                                        if ($event.target.value < 1) $event.target.value = 1;
                                                        if ($event.target.value > maxStock) $event.target.value = maxStock;
                                                    "
                                                    wire:model="detalles.{{ $index }}.cantidad">
                                            </td>
                                            <td>
                                                <button wire:click="quitar({{ $index }})">Quitar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @error('detalles')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Estado</h4>

                    <!--ESTADO-->
                    <select id="estado" name="estado" wire:model="estado">
                        <option value="null" disabled>Seleccione</option>
                        <option value="Aprobado" selected>Aprobado</option>
                        <option value="Rechazado">Rechazado</option>
                        <option value="Observado">Observado</option>
                        <option value="Eliminado">Eliminado</option>
                    </select>
                    @error('estado')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Detalle</h4>

                    <!--SEDE-->
                    <div class="g_margin_bottom_20">
                        <label for="sede_id">Sedes <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="sede_id" name="sede_id" wire:model.live="sede_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                            @endforeach
                        </select>
                        @error('sede_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--ALMACEN-->
                    <div class="g_margin_bottom_20">
                        <label for="almacen_id">Almacén <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="almacen_id" name="almacen_id" wire:model.live="almacen_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($almacenes as $almacen)
                                <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                            @endforeach
                        </select>
                        @error('almacen_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--SERIE-->
                    <div>
                        <label for="serie_id">Serie <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="serie_id" name="serie_id" wire:model.live="serie_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($series as $serie)
                                <option value="{{ $serie->id }}">{{ $serie->nombre }}</option>
                            @endforeach
                        </select>
                        @error('serie_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <!--FORMULARIO BOTONES-->
        <div class="g_margin_bottom_20">
            <div class="formulario_botones">
                <button wire:click="guardar" class="guardar">Guardar</button>
            </div>
        </div>
    </div>

    <!--TABLA PAGINACION VARIACIONES INVENTARIO-->
    @if ($almacen_id)
        <div class="g_panel">
            @if ($variacionesIventario->count())
                <!--TITULO-->
                <h4 class="g_panel_titulo">Inventario</h4>

                <!-- TABLA CABECERA -->
                <div class="tabla_cabecera">
                    <!-- TABLA CABECERA BUSCAR -->
                    <div class="tabla_cabecera_buscar">
                        <form action="">
                            <input type="text" wire:model.live.debounce.1300ms="buscarProducto"
                                id="buscarProducto" name="buscarProducto" placeholder="Buscar...">
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
                                @foreach ($variacionesIventario as $item)
                                    <tr wire:click="seleccionarIdVariacion({{ $item->variacion->id }})"
                                        style="cursor: pointer;">
                                        <td class="g_resaltar">{{ $loop->iteration }}</td>
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
                @if ($variacionesIventario->hasPages())
                    <div>
                        {{ $variacionesIventario->onEachSide(1)->links() }}
                    </div>
                @endif
            @else
                <div class="g_vacio">
                    <p>No hay elementos.</p>
                    <i class="fa-regular fa-face-grin-wink"></i>
                </div>
            @endif
        </div>
    @endif

    <!--TABLA INVENTARIO-->
    @if ($inventarios)
        <div class="g_panel">
            <!--TITULO-->
            <h4 class="g_panel_titulo">Inventario en otros almacenes</h4>

            <div class="tabla_contenido">
                <div class="contenedor_tabla">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Sede</th>
                                <th>Almacén</th>
                                <th>Stock</th>
                                <th>Stock Mínimo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventarios as $inventario)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">{{ $inventario->almacen->sede->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $inventario->almacen->nombre ?? '-' }}</td>
                                    <td class="g_resaltar">{{ $inventario->stock }}</td>
                                    <td class="g_resaltar">{{ $inventario->stock_minimo }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
