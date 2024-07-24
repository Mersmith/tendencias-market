@section('tituloPagina', 'Inventario Variación Lista Precio')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Inventario Variación Lista Precio</h2>

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
                        <div class="g_columna_4">
                            <!--SEDES-->
                            <div class="g_margin_bottom_20">
                                <label for="sede_id">Sedes</label>
                                <select id="sede_id" name="sede_id" wire:model.live="sede_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->id }}">{{ $sede->id }} - {{ $sede->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <!--ALMACEN-->
                            <div>
                                <label for="almacen_id">Almacén</label>
                                <select id="almacen_id" name="almacen_id" wire:model.live="almacen_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($almacenes as $almacen)
                                        <option value="{{ $almacen->id }}">{{ $almacen->id }} - {{ $almacen->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <!--CATEGORIAS-->
                            <div class="g_margin_bottom_20">
                                <label for="categoria_id">Categorias</label>
                                <select id="categoria_id" name="categoria_id" wire:model.live="categoria_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">
                                            {{ $categoria->id }} - {{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="g_fila">
                        <div class="g_columna_4">
                            <!--MARCAS-->
                            <div class="g_margin_bottom_20">
                                <label for="marca_id">Marcas</label>
                                <select id="marca_id" name="marca_id" wire:model.live="marca_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">
                                            {{ $marca->id }} - {{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <!--LISTA DE PRECIOS-->
                            <div class="g_margin_bottom_20">
                                <label for="lista_precio_id">Lista de Precios</label>
                                <select id="lista_precio_id" name="lista_precio_id" wire:model.live="lista_precio_id">
                                    <option value="null" selected>Todos</option>
                                    @foreach ($listasPrecios as $listaPrecio)
                                        <option value="{{ $listaPrecio->id }}">{{ $listaPrecio->id }} -
                                            {{ $listaPrecio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g_columna_4">
                            <div class="g_fila">
                                <div class="g_columna_6">
                                    <!--RANGO DE PRECIOS-->
                                    <div class="g_margin_bottom_20">
                                        <label for="precioInicio">Precio inicio</label>
                                        <input type="number" id="precioInicio" name="precioInicio"
                                            @if (!$lista_precio_id) disabled @endif
                                            wire:model.live.debounce.1300ms="precioInicio"
                                            placeholder="Digite un número">
                                        @error('precioInicio')
                                            <p class="mensaje_error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="g_columna_6">
                                    <!--RANGO DE PRECIOS-->
                                    <div class="g_margin_bottom_20">
                                        <label for="precioFin">Precio fin</label>
                                        <input type="number" id="precioFin" name="precioFin"
                                            @if (!$lista_precio_id) disabled @endif
                                            wire:model.live.debounce.1300ms="precioFin" placeholder="Digite un número">
                                        @error('precioFin')
                                            <p class="mensaje_error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
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
                                <th>Almacén</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Stock</th>
                                <th>Stock mín.</th>
                                <th>Activo</th>
                                @foreach ($listasPrecios as $listaPrecio)
                                    <th>{{ $listaPrecio->nombre }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventario as $item)
                                <tr>
                                    <td class="g_resaltar">{{ $loop->iteration }}</td>
                                    <td class="g_resaltar">ID: {{ $item->almacen->id }} -
                                        {{ $item->almacen->nombre }}</td>
                                    <td class="g_resaltar">ID: {{ $item->variacion->producto->categoria->id }} -
                                        {{ $item->variacion->producto->categoria->nombre }}</td>
                                    <td class="g_resaltar">ID: {{ $item->variacion->producto->marca->id }} -
                                        {{ $item->variacion->producto->marca->nombre }}</td>
                                    <td class="g_resaltar">IDI: {{ $item->id }}, IDV: {{ $item->variacion->id }},
                                        ID: {{ $item->variacion->producto->id }} -
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
                                    @foreach ($listasPrecios as $listaPrecio)
                                        @php
                                            $precioData = $item->variacion->producto->listaPrecios->firstWhere(
                                                'lista_precio_id',
                                                $listaPrecio->id,
                                            );

                                            $descuentoData = $item->variacion->producto->descuentos->firstWhere(
                                                'lista_precio_id',
                                                $listaPrecio->id,
                                            );

                                            $fechaFinVencida =
                                                $descuentoData &&
                                                \Carbon\Carbon::parse($descuentoData->fecha_fin)->isPast();
                                        @endphp
                                        <td class="g_resaltar">
                                            <div>
                                                <strong>Precio Venta:</strong>
                                                {{ $precioData ? $precioData->precio : '-' }}
                                            </div>
                                            <div>
                                                <strong>Precio Antiguo:</strong>
                                                {{ $precioData ? $precioData->precio_antiguo : '-' }}
                                            </div>
                                            <div>
                                                <strong>Descuento:</strong>
                                                {{ $descuentoData ? $descuentoData->porcentaje_descuento : '-' }}%
                                            </div>
                                            <div
                                                style="color: {{ $fechaFinVencida && $descuentoData->porcentaje_descuento ? 'red' : 'black' }}">
                                                <strong>Fin:</strong>
                                                {{ $descuentoData ? $descuentoData->fecha_fin : '-' }}
                                            </div>
                                            <div>
                                                <strong>Precio Oferta:</strong>
                                                {{ $descuentoData && $descuentoData->porcentaje_descuento ? $precioData->precio * ((100 - $descuentoData->porcentaje_descuento) / 100) : '-' }}
                                            </div>
                                        </td>
                                    @endforeach
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
