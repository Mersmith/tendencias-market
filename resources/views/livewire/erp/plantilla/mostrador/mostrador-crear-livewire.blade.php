@section('tituloPagina', 'Mostrador')

@section('anchoPantalla', '100%')

<!-- resources/views/livewire/erp/plantilla/slider/slider-crear-livewire.blade.php -->
<div x-data="dataMostrador">

    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Mostrador</h2>
    </div>

    <form wire:submit.prevent="store" class="formulario">

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
                        <p class="leyenda">El slider debe tener un nombre único.</p>
                        @error('nombre')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Sliders</h4>

                    <!--BOTON-->
                    <div class="formulario_botones g_margin_bottom_20">
                        <button type="button" wire:click="addImage()" class="agregar">
                            <i class="fa-solid fa-plus"></i>
                            Agregar item
                        </button>
                    </div>

                    <table class="tabla_eliminar">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Título</th>
                                <th>Link</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody x-sort="handleMostrador">
                            @foreach ($imagenes as $index => $imagen)
                                <tr class="sorteable_item" x-sort:item="{{ $imagen['id']  }}">
                                    <td><i class="fa-solid fa-up-down-left-right"></i></td>
                                    <td>
                                        <input type="number" wire:model="imagenes.{{ $index }}.id"
                                            class="form-control" value="{{ $imagen['id'] }}" readonly>
                                        @error("imagenes.$index.id")
                                            <p class="mensaje_error">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text"
                                            wire:model="imagenes.{{ $index }}.imagen"
                                            class="form-control">
                                        @error("imagenes.$index.imagen")
                                            <p class="mensaje_error">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" wire:model="imagenes.{{ $index }}.titulo"
                                            class="form-control">
                                        @error("imagenes.$index.titulo")
                                            <p class="mensaje_error">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" wire:model="imagenes.{{ $index }}.link"
                                            class="form-control">
                                        @error("imagenes.$index.link")
                                            <p class="mensaje_error">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <button type="button" wire:click="removeImage({{ $index }})"
                                            class="boton_eliminar">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button type="submit" class="guardar">Guardar</button>
            </div>
        </div>
    </form>

    <script>
        function dataMostrador() {
            return {
                handleMostrador(item, position) {
                    console.log(item, position);
                    Livewire.dispatch('handleMostradorOn', {
                        item: item,
                        position: position,
                    });
                },
            }
        }
    </script>
</div>