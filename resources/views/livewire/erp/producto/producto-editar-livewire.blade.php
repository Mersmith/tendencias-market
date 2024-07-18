@section('tituloPagina', 'Editar')

<div>
    <!-- CABECERA TITULO PAGINA -->
    <div class="g_panel cabecera_titulo_pagina">
        <h2>Editar producto</h2>
        <div class="cabecera_titulo_botones">
            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_light">Inicio <i
                    class="fa-solid fa-house"></i></a>


            <a href="{{ route('erp.producto.vista.crear') }}" class="g_boton g_boton_primary">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('erp.producto.vista.todas') }}" class="g_boton g_boton_darkt"><i
                    class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--FORMULARIO-->
    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">General</h4>

                    <!--NOMBRE-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre">
                        <p class="leyenda">La producto debe tener un nombre único.</p>
                        @error('nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--SLUG-->
                    <div class="g_margin_bottom_20">
                        <label for="slug">Slug <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="slug" name="slug" wire:model.live="slug">
                        <p class="leyenda">La producto debe tener un slug único.</p>
                        @error('slug')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div>
                        <label for="descripcion">Descripción <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" name="descripcion" wire:model="descripcion" rows="3"></textarea>
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Variación</h4>

                    <div class="g_fila">
                        <div class="g_columna_6">
                            <!--TALLA-->
                            <div class="g_margin_bottom_20">
                                <div class="boton_checkbox boton_checkbox_deshabilitado">
                                    <label for="variacion_talla">Tiene talla</label>
                                    <input type="checkbox" id="variacion_talla" name="variacion_talla"
                                        @if ($producto->variacion_talla) checked @endif onclick="return false;">
                                </div>
                                <p class="leyenda">No se puede modificar.</p>
                            </div>
                        </div>

                        <div class="g_columna_6">
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

            <div class="g_columna_4">
                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Activo</h4>

                    <!--ACTIVO-->
                    <select id="activo" name="activo" wire:model="activo">
                        <option value="0" selected>DESACTIVADO</option>
                        <option value="1">ACTIVO</option>
                    </select>
                    @error('activo')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Detalle</h4>

                    <!--SUBCATEGORIA-->
                    <div class="g_margin_bottom_20">
                        <label for="categoria_id">Subcategoria <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="categoria_id" name="categoria_id" wire:model="categoria_id">
                            <option value="" selected disabled>Seleccione</option>
                            @if ($subcategorias)
                                @foreach ($subcategorias as $subcategoria)
                                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('categoria_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--MARCA-->
                    <div>
                        <label for="marca_id">Marca <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="marca_id" name="marca_id" wire:model="marca_id">
                            <option value="" selected disabled>Seleccione</option>
                            @if ($marcas)
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('marca_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Imagenes</h4>

                    <div class="formulario_botones g_margin_bottom_20">
                        <button wire:click="$set('modal', true)" class="guardar">Subir imagenes</button>
                    </div>

                    <!--IMAGENES-->
                    @if ($imagenes_seleccionadas)
                        <div class="formulario_grid_imagenes">
                            @foreach ($imagenes_seleccionadas as $index => $imagen)
                                <div class="item_grid_imagen">
                                    <div class="grid_contenedor_imagen">
                                        <img src="{{ $imagen['url'] }}" class="imagen_grid">
                                    </div>

                                    <div class="grid_botones">
                                        <a href="{{ $imagen['url'] }}" target="_blank"
                                            class="g_boton g_boton_info"><i class="fa-solid fa-eye"></i></a>
                                            
                                        <button wire:click="eliminarImagen({{ $index }})"
                                            class="g_boton g_boton_danger"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button wire:click="actualizar" class="guardar">Guardar</button>

                <a href="{{ route('erp.producto.vista.todas') }}" class="cancelar">Cancelar</a>
            </div>
        </div>
    </div>

    <!--MODAL IMAGEN-->
    <x-modal wire:model="modal" maxWidth="4xl">
        @livewire('erp.imagen.imagen-modal-todas-livewire')
    </x-modal>
</div>
