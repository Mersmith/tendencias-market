@section('tituloPagina', 'Producto descuento')

<div>{{-- - --}}
    <!-- CABECERA TITULO PAGINA -->
    <div class="g_panel cabecera_titulo_pagina">
        <!-- TITULO -->
        <h2>Producto descuento</h2>

        <!-- BOTONES -->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i>
            </a>

            <a href="{{ route('erp.producto.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.producto.variacion.vista.editar', $producto) }}" class="g_boton g_boton_info">
                Variación <i class="fa-solid fa-align-center"></i></a>

            <a href="{{ route('erp.producto.inventario.vista.ver', ['id' => $producto->id]) }}"
                class="g_boton g_boton_warning">
                Inventario <i class="fa-solid fa-list-ol"></i></a>

            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">General</h4>

                    <!--ID-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">ID Producto</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $producto->id }}" disabled>
                    </div>

                    <!--NOMBRE-->
                    <div>
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" disabled>
                    </div>
                </div>
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Variación</h4>

                    <!--TALLA-->
                    <div class="g_margin_bottom_20">
                        <div class="boton_checkbox boton_checkbox_deshabilitado">
                            <label for="variacion_talla">Tiene talla</label>
                            <input type="checkbox" id="variacion_talla" name="variacion_talla"
                                @if ($producto->variacion_talla) checked @endif onclick="return false;">
                        </div>
                        <p class="leyenda">No se puede modificar.</p>
                    </div>

                    <!--COLOR-->
                    <div class="">
                        <div class="boton_checkbox boton_checkbox_deshabilitado">
                            <label for="variacion_color">Tiene color</label>
                            <input type="checkbox" id="variacion_color" name="variacion_color"
                                @if ($producto->variacion_color) checked @endif onclick="return false;">
                        </div>
                        <p class="leyenda">No se puede modificar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--TABLA-->
    <div class="g_panel">
        <!-- TABLA CABECERA -->
        <div class="tabla_cabecera">
            <!-- TABLA CABECERA BOTONES -->
            <div class="tabla_cabecera_botones">
                <button>
                    PDF <i class="fa-solid fa-file-pdf"></i>
                </button>
                <button>
                    EXCEL <i class="fa-regular fa-file-excel"></i>
                </button>
            </div>

            <!-- TABLA CABECERA BUSCAR -->
            <div class="tabla_cabecera_buscar">
                <form action="">
                    <input type="text" id="buscarProducto" name="buscarProducto" placeholder="Buscar...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>

        <!-- TABLA CONTENIDO -->
        <div class="tabla_contenido g_margin_bottom_20">
            <div class="contenedor_tabla">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Lista de Precio</th>
                            @foreach ($listasPrecios as $listaPrecio)
                                <th>{{ $listaPrecio->nombre }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>% Descuento</td>
                            @foreach ($listasPrecios as $listaPrecio)
                                <td>
                                    <input type="number" step="0.01"
                                        wire:model="datos.{{ $listaPrecio->id }}.porcentaje_descuento">
                                    @error('datos.' . $listaPrecio->id . '.porcentaje_descuento')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Fecha fin</td>
                            @foreach ($listasPrecios as $listaPrecio)
                                <td>
                                    <input type="datetime-local" wire:model="datos.{{ $listaPrecio->id }}.fecha_fin">
                                    @error('datos.' . $listaPrecio->id . '.fecha_fin')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @if ($listasPrecios->count())
            <div class="formulario_botones">
                <button wire:click="guardarPrecioMasivamente" class="guardar">Guardar masivamente</button>
            </div>
        @endif
    </div>
</div>
