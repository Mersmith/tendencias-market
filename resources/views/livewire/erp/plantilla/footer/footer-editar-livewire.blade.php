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

                    <div id="redes-sociales" x-sort="handleRedesSociales">
                        @foreach ($redesSociales as $index => $redSocial)
                            <div class="red-social" x-sort:item="{{ $redSocial['id'] }}">
                                <label>Nombre:</label>
                                <input type="text" wire:model="redesSociales.{{ $index }}.nombre">

                                <label>Link:</label>
                                <input type="text" wire:model="redesSociales.{{ $index }}.link">

                                <button type="button"
                                    wire:click="eliminarRedSocial({{ $index }})">Eliminar</button>
                            </div>
                        @endforeach
                        <button type="button" wire:click="agregarRedSocial()">Agregar Red Social</button>
                    </div>
                </div>

                <div class="g_panel">
                    <h4>Términos y Condiciones</h4>

                    <div id="terminos" x-sort="handleTerminos">
                        @foreach ($terminos as $index => $termino)
                            <div class="termino" x-sort:item="{{ $termino['id'] }}">
                                <label>Nombre:</label>
                                <input type="text" wire:model="terminos.{{ $index }}.nombre">

                                <label>Link:</label>
                                <input type="text" wire:model="terminos.{{ $index }}.link">

                                <button type="button"
                                    wire:click="eliminarTermino({{ $index }})">Eliminar</button>
                            </div>
                        @endforeach
                        <button type="button" wire:click="agregarTermino()">Agregar Término</button>
                    </div>
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
