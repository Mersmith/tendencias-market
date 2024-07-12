@section('tituloPagina', 'Footer')

<div x-data="dataFooter">

    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Footer</h2>
    </div>

    <form wire:submit.prevent="submitForm" class="formulario">
        @csrf
        @method('PUT')
        <div class="g_fila">
            <div class="g_columna_8">
                <div class="g_panel">
                    <h4 class="g_panel_titulo">General</h4>

                    <div class="g_margin_bottom_20">
                        <label for="derechos">Derechos <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="derechos" name="derechos" wire:model="derechos" rows="3"></textarea>
                        @error('derechos')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="g_margin_bottom_20">
                        <label for="direccion">Dirección <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <textarea id="direccion" name="direccion" wire:model="direccion" rows="3"></textarea>
                        @error('direccion')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Redes sociales</h4>

                    <!--BOTON-->
                    <div class="formulario_botones g_margin_bottom_20">
                        <button type="button" wire:click="agregarRedSocial()" class="agregar">
                            <i class="fa-solid fa-plus"></i>
                            Agregar
                        </button>
                    </div>

                    <table class="tabla_eliminar">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Link</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody x-sort="handleRedesSociales">
                            @foreach ($redesSociales as $index => $redSocial)
                                <tr class="sorteable_item" x-sort:item="{{ $redSocial['id'] }}">
                                    <td><i class="fa-solid fa-up-down-left-right"></i></td>
                                    <td>
                                        <input type="text" wire:model="redesSociales.{{ $index }}.nombre">
                                    </td>
                                    <td>
                                        <input type="text" wire:model="redesSociales.{{ $index }}.link">
                                    </td>
                                    <td>
                                        <button type="button" class="boton_eliminar"
                                            wire:click="eliminarRedSocial({{ $index }})">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="g_panel">
                    <h4 class="g_panel_titulo">Términos y Condiciones</h4>

                    <!--BOTON-->
                    <div class="formulario_botones g_margin_bottom_20">
                        <button type="button" wire:click="agregarTermino()" class="agregar">
                            <i class="fa-solid fa-plus"></i>
                            Agregar
                        </button>
                    </div>

                    <table class="tabla_eliminar">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Link</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody x-sort="handleTerminos">
                            @foreach ($terminos as $index => $termino)
                                <tr class="sorteable_item" x-sort:item="{{ $termino['id'] }}">
                                    <td><i class="fa-solid fa-up-down-left-right"></i></td>
                                    <td>
                                        <input type="text" wire:model="terminos.{{ $index }}.nombre">
                                    </td>
                                    <td>
                                        <input type="text" wire:model="terminos.{{ $index }}.link">
                                    </td>
                                    <td>
                                        <button type="button" class="boton_eliminar"
                                            wire:click="eliminarTermino({{ $index }})">
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
                    <h4 class="g_panel_titulo">Color fondo</h4>

                    <input type="color" name="backgroundColor" wire:model="backgroundColor">
                    <p class="leyenda">Color de fondo.</p>
                    @error('backgroundColor')
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
        function dataFooter() {
            return {
                handleRedesSociales(item, position) {
                    Livewire.dispatch('handleRedesSocialesOn', {
                        item: item,
                        position: position,
                    });
                },
                handleTerminos(item, position) {
                    Livewire.dispatch('handleRedesTerminosOn', {
                        item: item,
                        position: position,
                    });
                },
            }
        }
    </script>
</div>
