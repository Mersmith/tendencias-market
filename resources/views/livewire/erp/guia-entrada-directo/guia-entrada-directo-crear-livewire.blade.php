@section('tituloPagina', 'Guia de Entrada Directo')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Crear guia de entrada directo</h2>
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
                        <textarea id="descripcion" name="descripcion" wire:model="descripcion" rows="2"></textarea>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--OBSERVACION-->
                    <div class="g_margin_bottom_20">
                        <label for="observacion">Observación</label>
                        <textarea id="observacion" name="observacion" wire:model="observacion" rows="2"></textarea>
                        @error('observacion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--FECHA ENTRADA-->
                    <div class="g_margin_bottom_20">
                        <label for="fecha_entrada">Fecha entrada <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="date" id="fecha_entrada" name="fecha_entrada" wire:model.live="fecha_entrada">
                        @error('fecha_entrada')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Detalle</h4>

                    <!--TABLA CONTENIDO -->
                    <div class="tabla_contenido">
                        <div class="contenedor_tabla">
                            <table class="tabla">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Producto</th>
                                        <th>Color</th>
                                        <th>Talla</th>
                                        <th>Stock</th>
                                        <th>Stock mínimo</th>
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
                                            <td>
                                                <input type="number" min="1" x-data
                                                    @input="if ($event.target.value < 1) $event.target.value = 1"
                                                    wire:model="detalles.{{ $index }}.stock">
                                            </td>
                                            <td>
                                                <input type="number" min="1" x-data
                                                    @input="if ($event.target.value < 1) $event.target.value = 1"
                                                    wire:model="detalles.{{ $index }}.stock_minimo">
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

                <!-- MOSTRAR INVENTARIOS -->
                @if ($inventarios)
                    <div class="g_panel">
                        <!--TITULO-->
                        <h4 class="g_panel_titulo">Inventario</h4>

                        <!--TABLA CONTENIDO -->
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
                                                <td class="g_resaltar">{{ $inventario->almacen->sede->nombre ?? '-' }}
                                                </td>
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

                <!-- TABLA -->
                <div class="g_panel">
                    @if ($variaciones->count())
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
                                <table class="tabla">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Color</th>
                                            <th>Talla</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($variaciones as $variacion)
                                            <tr wire:click="seleccionarIdVariacion({{ $variacion->id }})"
                                                style="cursor: pointer;">
                                                <td class="g_resaltar">IDV: {{ $variacion->id }} -
                                                    {{ $variacion->producto->nombre }}</td>
                                                <td class="g_resaltar">{{ $variacion->color->nombre ?? '-' }}</td>
                                                <td class="g_resaltar">{{ $variacion->talla->nombre ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($variaciones->hasPages())
                            <div>
                                {{ $variaciones->onEachSide(1)->links('livewire::simple-tailwind') }}
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
        </div>

        <div class="g_margin_bottom_20">
            <div class="formulario_botones">
                <button wire:click="guardar" class="guardar">Guardar</button>
            </div>
        </div>
    </div>
</div>
