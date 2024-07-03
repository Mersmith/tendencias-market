@section('tituloPagina', 'Guia de Entrada Directo')

<div>

    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Transferencia almacen</h2>
    </div>

    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>

                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" name="descripcion" wire:model="descripcion" rows="3"></textarea>
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="observacion">Observación <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="observacion" name="observacion" wire:model="observacion" rows="3"></textarea>
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('observacion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="fecha_transferencia">Fecha transferencia <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="date" id="fecha_transferencia" name="fecha_transferencia" wire:model.live="fecha_transferencia">
                        @error('fecha_transferencia')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
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
                                        <th>Cantidad transferir</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalles as $index => $detalle)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detalle['producto_nombre'] }}</td>
                                            <td>{{ $detalle['color_nombre'] }}</td>
                                            <td>{{ $detalle['talla_nombre'] }}</td>
                                            <td>{{ $detalle['stock_actual'] }}</td>
                                            <td>
                                                <input type="number" min="1" x-data
                                                    @input="if ($event.target.value < 1) $event.target.value = 1"
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
                    <h4 class="g_panel_titulo">Estado</h4>

                    <select id="estado" name="estado" wire:model="estado">
                        <option value="null" disabled>Seleccione</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Rechazado">Rechazado</option>
                        <option value="Observado">Observado</option>
                        <option value="Eliminado">Eliminado</option>
                    </select>
                    @error('estado')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Origen</h4>

                    <div class="g_margin_bottom_20">
                        <label for="sede_origen_id">Sede <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="sede_origen_id" name="sede_origen_id" wire:model.live="sede_origen_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($sedes_origen as $sede_origen)
                                <option value="{{ $sede_origen->id }}">{{ $sede_origen->nombre }}</option>
                            @endforeach
                        </select>
                        @error('sede_origen_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="almacen_origen_id">Almacén <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="almacen_origen_id" name="almacen_origen_id" wire:model.live="almacen_origen_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($almacenes_origen as $almacen_origen)
                                <option value="{{ $almacen_origen->id }}">{{ $almacen_origen->nombre }}</option>
                            @endforeach
                        </select>
                        @error('almacen_origen_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="serie_origen_id">Serie <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="serie_origen_id" name="serie_origen_id" wire:model.live="serie_origen_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($series_origen as $serie_origen)
                                <option value="{{ $serie_origen->id }}">{{ $serie_origen->nombre }}</option>
                            @endforeach
                        </select>
                        @error('serie_origen_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Destino</h4>

                    <div class="g_margin_bottom_20">
                        <label for="sede_destino_id">Sede <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="sede_destino_id" name="sede_destino_id" wire:model.live="sede_destino_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($sedes_destino as $sede_destino)
                                <option value="{{ $sede_destino->id }}">{{ $sede_destino->nombre }}</option>
                            @endforeach
                        </select>
                        @error('sede_destino_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="almacen_destino_id">Almacén <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="almacen_destino_id" name="almacen_destino_id" wire:model.live="almacen_destino_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($almacenes_destino as $almacen_destino)
                                <option value="{{ $almacen_destino->id }}">{{ $almacen_destino->nombre }}</option>
                            @endforeach
                        </select>
                        @error('almacen_destino_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="serie_destino_id">Serie <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="serie_destino_id" name="serie_destino_id" wire:model.live="serie_destino_id">
                            <option value="null" selected disabled>Seleccione</option>
                            @foreach ($series_destino as $serie_destino)
                                <option value="{{ $serie_destino->id }}">{{ $serie_destino->nombre }}</option>
                            @endforeach
                        </select>
                        @error('serie_destino_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="guardar" class="guardar">Guardar</button>
            </div>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="g_panel">
        <!--TABLA-->
        @if ($inventario->count()) <!--TABLA CABECERA-->
            <div class="tabla_cabecera">
                <!--TABLA CABECERA BOTONES-->
                <div class="tabla_cabecera_botones">
                    <button>PDF <i class="fa-solid fa-file-pdf"></i></button>
                    <button>EXCEL <i class="fa-regular fa-file-excel"></i></button>
                </div>

                <!--TABLA CABECERA BUSCAR-->
                <div class="tabla_cabecera_buscar">
                    <form action="">
                        <input type="text" wire:model.debounce.1300ms="buscarProducto" id="buscarProducto"
                            name="buscarProducto" placeholder="Buscar...">
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
                                <tr wire:click="agregarVariacionDetalle({{ $item->variacion->id }})"
                                    style="cursor: pointer;">
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
                    {{ $inventario->links() }}
                    <!-- Aquí se usa el helper de Livewire para mostrar los enlaces de paginación -->
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
