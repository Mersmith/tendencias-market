<div class="g_modal">
    <div class="modal_contenedor">
        <div class="modal_cerrar">
            <button wire:click="cerrarEditarModal"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modal_titulo g_titulo">
            <h2>Editar dirección</h2>
        </div>

        <div class="modal_cuerpo g_formulario">
            <div class="g_bloque">
                <div class="item_formulario">
                    <label for="recibe_nombres">Nombres de quién recibe</label>
                    <input type="text" wire:model="recibe_nombres" id="recibe_nombres" name="recibe_nombres"
                        placeholder="Nombres y apellidos de quien recibe">
                    @error('recibe_nombres')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque dos_columnas">
                <div class="item_formulario">
                    <label for="recibe_celular">Celular a contactar</label>
                    <input type="text" wire:model="recibe_celular" id="recibe_celular" name="recibe_celular"
                        placeholder="Celular a contactar">
                    @error('recibe_celular')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="departamento_id">Departamento</label>
                    <select wire:model.live="departamento_id" id="departamento_id" name="departamento_id">
                        <option value="">Selecciona un Departamento</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                    @error('departamento_id')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque dos_columnas">
                <div class="item_formulario">
                    <label for="provincia_id">Provincia</label>
                    <select wire:model.live="provincia_id" id="provincia_id" name="provincia_id">
                        <option value="">Selecciona una Provincia</option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                        @endforeach
                    </select>
                    @error('provincia_id')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="distrito_id">Distrito</label>
                    <select wire:model.live="distrito_id" id="distrito_id" name="distrito_id">>
                        <option value="">Selecciona un Distrito</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                        @endforeach
                    </select>
                    @error('distrito_id')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque dos_columnas">
                <div class="item_formulario">
                    <label for="direccion">Avenida / Calle / Jirón</label>
                    <input type="text" wire:model="direccion" id="direccion" name="direccion"
                        placeholder="Nombre de la calle">
                    @error('direccion')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="direccion_numero">Número</label>
                    <input type="text" wire:model="direccion_numero" id="direccion_numero" name="direccion_numero"
                        placeholder="Número de la calle">
                    @error('direccion_numero')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque dos_columnas">
                <div class="item_formulario">
                    <label for="opcional">Dpto. / Interior / Piso / Lote (opcional)</label>
                    <input type="text" wire:model.live="opcional" id="opcional" name="opcional"
                        placeholder="Ejem: Casa 1 piso, lote 15.">
                    @error('opcional')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="codigo_postal">
                    <label for="codigo_postal">Código postal</label>
                    <input type="text" wire:model="codigo_postal" id="codigo_postal" name="codigo_postal">
                    @error('codigo_postal')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque">
                <div class="item_formulario">
                    <label for="instrucciones">Instrucción para la entrega (opcional)</label>
                    <textarea id="instrucciones" name="instrucciones" wire:model="instrucciones" rows="3"
                        placeholder="Detalle para el delivery o entrega del producto"></textarea>
                    @error('instrucciones')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="g_formulario_boton">
            <button wire:click="cerrarEditarModal" class="cancelar">Cancelar</button>
            <button wire:click="updateDireccion" class="guardar">Guardar Cambios</button>
        </div>
    </div>
</div>
