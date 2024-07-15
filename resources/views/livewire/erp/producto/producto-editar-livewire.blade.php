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

    <div class="formulario">
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>

                    <div class="g_margin_bottom_20">
                        <label for="nombre">Nombre <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="nombre" name="nombre" wire:model.live="nombre">
                        <p class="leyenda">La producto debe tener un nombre único.</p>
                        @error('nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="slug">Slug <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="slug" name="slug" wire:model.live="slug">
                        <p class="leyenda">La producto debe tener un slug único.</p>
                        @error('slug')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

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
            </div>

            <div class="g_columna_4">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">Activo</h4>

                    <select id="activo" name="activo" wire:model="activo">
                        <option value="" disabled>Seleccione</option>
                        <option value="2">DESACTIVADO</option>
                        <option value="1">ACTIVO</option>
                    </select>
                    @error('activo')
                        <p class="mensaje_error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Detalle</h4>

                    <div class="g_margin_bottom_20">
                        <label for="subcategoria_id">Subcategoria <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <select id="subcategoria_id" name="subcategoria_id" wire:model="subcategoria_id">
                            <option value="" selected disabled>Seleccione</option>
                            @if ($subcategorias)
                                @foreach ($subcategorias as $subcategoria)
                                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('subcategoria_id')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

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
                    <h4 class="g_panel_titulo">Imagenes</h4>

                    <div class="formulario_botones g_margin_bottom_20">
                        <button wire:click="$set('modal', true)" class="guardar">Subir imagenes</button>
                    </div>

                    @if ($imagenes_seleccionadas)
                        <div class="formulario_grid_imagenes">
                            @foreach ($imagenes_seleccionadas as $index => $imagen)
                                <div class="item_grid_imagen">
                                    <div class="grid_contenedor_imagen">
                                        <img src="{{ $imagen['url'] }}" class="imagen_grid">
                                    </div>
                                    
                                    <div class="grid_botones">
                                        <a href="{{ $imagen['url'] }}" target="_blank" class="g_boton g_boton_info"><i
                                                class="fa-solid fa-eye"></i></a>
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

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div>
                <h2 style="font-weight: bold">Imagenes</h2>
            </div>
        </x-slot>
        <x-slot name="content">

            @livewire('erp.imagen.imagen-modal-todas-livewire')

        </x-slot>
        <x-slot name="footer">
            <button type="button" wire:click="$set('modal', false)">Cancelar</button>
        </x-slot>
    </x-dialog-modal>

</div>
