@section('tituloPagina', 'Productos')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Producto variación</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_light">
                Inicio <i class="fa-solid fa-house"></i></a>

            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_darkt">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>

                    <div>
                        <label for="nombre">Nombre <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" disabled>
                    </div>
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Variación</h4>

                    <div class="g_fila">
                        <div class="g_columna_6">
                            <div class="g_margin_bottom_20">
                                <div class="boton_checkbox">
                                    <label for="variacion_talla">Tiene talla</label>
                                    <input type="checkbox" id="variacion_talla" name="variacion_talla"
                                        @if ($producto->variacion_talla) checked @endif onclick="return false;">
                                </div>
                                <p class="leyenda">No se puede modificar.</p>
                            </div>
                        </div>

                        <div class="g_columna_6">
                            <div class="">
                                <div class="boton_checkbox">
                                    <label for="variacion_color">Tiene color</label>
                                    <input type="checkbox" id="variacion_color" name="variacion_color"
                                        @if ($producto->variacion_color) checked @endif onclick="return false;">
                                </div>
                                <p class="leyenda">No se puede modificar.</p>
                            </div>
                        </div>

                        @if ($producto->variacion_talla || $producto->variacion_color)
                            <!--VARIACION TALLA-->
                            @if ($producto->variacion_talla)
                                <div class="g_columna_6">
                                    <div class="g_margin_bottom_20">
                                        <label for="talla_id">Talla <span class="obligatorio"><i
                                                    class="fa-solid fa-asterisk"></i></span></label>
                                        <select id="talla_id" name="talla_id" wire:model="talla_id">
                                            <option value="null" selected disabled>Seleccione</option>
                                            @if ($tallas)
                                                @foreach ($tallas as $talla)
                                                    <option value="{{ $talla->id }}">{{ $talla->nombre }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <!--VARIACION COLOR-->
                            @if ($producto->variacion_color)
                                <div class="g_columna_6">
                                    <div class="g_margin_bottom_20">
                                        <label for="color_id">Color <span class="obligatorio"><i
                                                    class="fa-solid fa-asterisk"></i></span></label>
                                        <select id="color_id" name="color_id" wire:model="color_id">
                                            <option value="null" selected disabled>Seleccione</option>
                                            @if ($colores)
                                                @foreach ($colores as $color)
                                                    <option value="{{ $color->id }}">{{ $color->nombre }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <!--BOTON-->
                            <div class="formulario_botones g_margin_bottom_20">
                                <button wire:click="agregarVariacion" class="agregar">
                                    <i class="fa-solid fa-plus"></i>
                                    Agregar variación
                                </button>
                            </div>

                            <!--TABLA-->
                            <div>
                                @if (count($variaciones) > 0)
                                    <table class="tabla_eliminar">
                                        <thead>
                                            <tr>
                                                @if ($producto->variacion_talla)
                                                    <th>Talla</th>
                                                @endif

                                                @if ($producto->variacion_color)
                                                    <th>Color</th>
                                                @endif

                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($variaciones as $index => $variacion)
                                                <tr>
                                                    @if ($producto->variacion_talla)
                                                        <td>
                                                            <select id="variaciones.{{ $index }}.talla_id"
                                                                name="variaciones.{{ $index }}.talla_id"
                                                                wire:model="variaciones.{{ $index }}.talla_id"
                                                                disabled>
                                                                <option value="null" selected disabled>
                                                                    Seleccione
                                                                </option>
                                                                @foreach ($tallas as $t)
                                                                    <option value="{{ $t->id }}">
                                                                        {{ $t->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    @endif

                                                    @if ($producto->variacion_color)
                                                        <td>
                                                            <select id="variaciones.{{ $index }}.color_id"
                                                                name="variaciones.{{ $index }}.color_id"
                                                                wire:model="variaciones.{{ $index }}.color_id"
                                                                disabled>
                                                                <option value="null" selected disabled>
                                                                    Seleccione
                                                                </option>
                                                                @foreach ($colores as $c)
                                                                    <option value="{{ $c->id }}">
                                                                        {{ $c->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    @endif

                                                    <td>
                                                        <button class="boton_eliminar"
                                                            wire:click="eliminarVariacion({{ $index }})"><i
                                                                class="fa-solid fa-xmark"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                            </div>
                        @endif
                    </div>
                </div>


            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="guardar" class="guardar">Guardar</button>

                <a href="{{ route('erp.producto.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</div>
