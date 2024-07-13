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
                <label for="photos" style="cursor: pointer;">Subir <i class="fa-solid fa-square-plus"></i></label>
            </a>
        </div>
    </div>

    <!--FORMULARIO-->
    <form wire:submit.prevent="store" class="formulario">
        <div class="g_panel">
            <!--IMAGENES-->
            <div class="g_margin_bottom_20">
                <input type="file" id="photos" wire:model="photos" multiple required accept="image/*"
                    style="display: none;">
                    
                <div class="contenedor_dropzone">
                    @if ($newPhotos)
                        @foreach ($newPhotos as $index => $photo)
                            <div class="dropzone_item">
                                <img src="{{ $photo->temporaryUrl() }}" class="dropzone_image">
                                <button type="button" class="remove_button"
                                    wire:click="removePhoto({{ $index }})"><i
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
            @if ($newPhotos)
                <div class="formulario_botones">
                    <button type="submit" class="guardar">Guardar</button>


                </div>
            @endif
        </div>
    </form>

    <!--TABLA-->
    <div class="g_panel">
        <h2>Lista de Imágenes</h2>
        <ul>
            @foreach ($imagenes as $imagen)
                <li>
                    <strong>{{ $imagen->titulo }}</strong>
                    <img src="{{ $imagen->url }}" alt="{{ $imagen->titulo }}"
                        style="max-width: 150px; max-height: 150px;">
                    <a href="{{ $imagen->url }}" target="_blank">Ver</a>
                    <button wire:click="edit({{ $imagen->id }})">Editar</button>
                    <button wire:click="delete({{ $imagen->id }})">Eliminar</button>
                </li>
            @endforeach
        </ul>
    </div>

    <!--MODAL EDITAR-->
    @if ($imagenId)
        <x-dialog-modal wire:model="modal">
            <x-slot name="title">
                <div>
                    <h2 style="font-weight: bold">Editar</h2>
                </div>
            </x-slot>
            <x-slot name="content">
                <input type="text" wire:model="titulo" placeholder="Nombre">
                <input type="text" wire:model="descripcion" placeholder="Tipo">

                <img src="{{ $url }}" style="max-width: 150px; max-height: 150px;">

                <div class="estilo_dropzone">
                    <label for="nuevo" style="cursor: pointer;">Subir imagen</label>
                    <input type="file" id="nuevo" wire:model="nuevo" accept="image/*" style="display: none;">

                    @if ($nuevo)
                        <div>
                            <img src="{{ $nuevo->temporaryUrl() }}" style="max-width: 150px; max-height: 150px;">
                            <button type="button" wire:click="deleteImagenNueva()">x</button>
                        </div>
                    @endif
                </div>
            </x-slot>
            <x-slot name="footer">
                <button type="button" wire:click="update">Actualizar</button>
                <button type="button" wire:click="$set('modal', false)">Cancelar</button>
            </x-slot>
        </x-dialog-modal>
    @endif

</div>
