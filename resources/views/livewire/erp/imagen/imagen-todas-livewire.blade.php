@section('tituloPagina', 'Imagenes')

@section('anchoPantalla', '100%')

<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Imagenes</h2>

        <!--BOTONES-->
        <div class="cabecera_titulo_botones">
            <a class="g_boton g_boton_primary">
                <label for="imagenes_inicial" style="cursor: pointer;">Subir <i
                        class="fa-solid fa-square-plus"></i></label>
            </a>
        </div>
    </div>

    <!--FORMULARIO-->
    <form wire:submit.prevent="guardar" class="formulario">
        <div class="g_panel">
            <!--IMAGENES-->
            <div class="g_margin_bottom_20">
                <input type="file" id="imagenes_inicial" wire:model="imagenes_inicial" multiple required
                    accept="image/*" style="display: none;">

                <div class="contenedor_dropzone">
                    @if ($imagenes_final)
                        @foreach ($imagenes_final as $index => $photo)
                            <div class="dropzone_item">
                                <img src="{{ $photo->temporaryUrl() }}" class="dropzone_image">
                                <button type="button" class="remove_button"
                                    wire:click="eliminarImagenTemporal({{ $index }})"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>
                        @endforeach
                    @else
                        <div class="g_vacio">
                            <p>No hay imagen.</p>
                            <i class="fa-regular fa-face-grin-wink"></i>
                        </div>
                    @endif
                </div>
            </div>
            @if ($imagenes_final)
                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>
                </div>
            @endif
        </div>
    </form>

    <!--MODAL EDITAR-->
    @if ($imagenId)
        <x-dialog-modal wire:model="modal">
            <x-slot name="title">
                <div>
                    <!--TITULO-->
                    <h4 class="g_panel_titulo">Editar</h4>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="formulario">
                    <!--TITULO-->
                    <div class="g_margin_bottom_20">
                        <label for="titulo">Titulo <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="titulo" name="titulo" wire:model="titulo">
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('titulo')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--DESCRIPCION-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Descripción <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="descripcion" name="descripcion" wire:model="descripcion"> </textarea>
                        <p class="leyenda">Se mostrará en el SEO.</p>
                        @error('descripcion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--IMAGEN-->
                    <div class="g_margin_bottom_20">
                        <label for="descripcion">Imagen</label>

                        <div class="dropzone_item">
                            <img src="{{ $url }}" class="dropzone_image">
                        </div>
                    </div>
                </div>

                <div class="cabecera_titulo_botones g_margin_bottom_20">
                    <a class="g_boton g_boton_primary">
                        <label for="imagen_edit" style="cursor: pointer;">Cambiar imagen <i
                                class="fa-solid fa-square-plus"></i></label>
                    </a>
                    <input type="file" id="imagen_edit" wire:model="imagen_edit" accept="image/*"
                        style="display: none;">
                </div>

                <div class="contenedor_dropzone">
                    @if ($imagen_edit)
                        <div class="dropzone_item">
                            <img src="{{ $imagen_edit->temporaryUrl() }}" class="dropzone_image">
                            <button type="button" wire:click="eliminarImagenEditTemporal()" class="remove_button"><i
                                    class="fa-solid fa-xmark"></i></button>
                        </div>
                    @else
                        <div class="g_vacio">
                            <p>No hay imagen.</p>
                            <i class="fa-regular fa-face-grin-wink"></i>
                        </div>
                    @endif
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="formulario_botones">
                    <button type="button" wire:click="editarFormulario" class="guardar">Actualizar</button>

                    <button type="button" wire:click="$set('modal', false)" class="cancelar">Cancelar</button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif

    <!--TABLA-->
    <div class="g_panel">
        @if ($imagenes->count())
            <div class="grid_instagram">
                @foreach ($imagenes as $imagen)
                    <div class="item">
                        <div class="contenedor_imagen">
                            <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}" class="imagen">
                        </div>

                        <div class="botones">
                            <a href="{{ $imagen->url }}" target="_blank" class="g_boton g_boton_info"><i
                                    class="fa-solid fa-eye"></i></a>
                            <button wire:click="seleccionarImagen({{ $imagen->id }})"
                                class="g_boton g_boton_primary"><i class="fa-solid fa-pencil"></i></button>
                            <button wire:click="eliminarImagen({{ $imagen->id }})"
                                class="g_boton g_boton_danger"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($imagenes->hasPages())
                <div>
                    {{ $imagenes->links('pagination::tailwind') }}
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
