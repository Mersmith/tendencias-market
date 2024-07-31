<div>
    <!--CABECERA TITULO PAGINA-->
    <div class="g_panel cabecera_titulo_pagina">
        <!--TITULO-->
        <h2>Banner</h2>
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

                    <!--IMAGEN COMPUTADORA-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Imagen computadora <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="imagen_computadora" name="imagen_computadora"
                            wire:model.live="imagen_computadora">
                        @error('imagen_computadora')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--IMAGEN MOVIL-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Imagen móvil <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="imagen_movil" name="imagen_movil" wire:model.live="imagen_movil">
                        @error('imagen_movil')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!--LINK-->
                    <div class="g_margin_bottom_20">
                        <label for="nombre">Link <span class="obligatorio"><i
                                    class="fa-solid fa-asterisk"></i></span></label>
                        <input type="text" id="link" name="link" wire:model.live="link">
                        @error('link')
                            <p class="mensaje_error">{{ $message }}</p>
                        @enderror
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
            </div>
        </div>

        <div>
            <div class="formulario_botones">
                <button type="submit" class="guardar">Guardar</button>
            </div>
        </div>
    </form>
</div>
