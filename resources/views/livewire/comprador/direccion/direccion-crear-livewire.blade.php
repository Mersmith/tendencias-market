<div class="comprador_modal">
    <div class="modal_contenedor">

        <div class="modal_cerrar">
            <button wire:click="closeCreateModal"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modal_titulo comprador_titulo">
            <h2>Nueva dirección</h2>
        </div>

        <div class="modal_cuerpo comprador_formulario">

            <div class="bloque">
                <div class="item_formulario">
                    <label for="recibe_nombres">Nombres de quién recibe</label>
                    <input type="text" wire:model.live="recibe_nombres"
                        placeholder="Nombres y apellidos de quien recibe">
                    @error('recibe_nombres')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bloque dos_columnas">
                <div class="item_formulario">
                    <label for="recibe_celular">Celular a contactar</label>
                    <input type="text" wire:model.live="recibe_celular" placeholder="Celular a contactar">
                    @error('recibe_celular')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="departamento_id">Departamento</label>
                    <select wire:model.live="departamento_id">
                        <option value="">Selecciona un Departamento</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                    @error('departamento_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bloque dos_columnas">
                <div class="item_formulario">
                    <label for="provincia_id">Provincia</label>
                    <select wire:model.live="provincia_id">
                        <option value="">Selecciona una Provincia</option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                        @endforeach
                    </select>
                    @error('provincia_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="distrito_id">Distrito</label>
                    <select wire:model.live="distrito_id">
                        <option value="">Selecciona un Distrito</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                        @endforeach
                    </select>
                    @error('distrito_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bloque dos_columnas">
                <div class="item_formulario">
                    <label for="direccion">Avenida / Calle / Jirón</label>
                    <input type="text" wire:model.live="direccion" placeholder="Nombre de la calle">
                    @error('direccion')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="direccion_numero">Número</label>
                    <input type="text" wire:model.live="direccion_numero" placeholder="Número de la calle">
                    @error('direccion_numero')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bloque dos_columnas">
                <div class="item_formulario">
                    <label for="opcional">Dpto. / Interior / Piso / Lote / Bloque (opcional)</label>
                    <input type="text" wire:model.live="opcional" placeholder="Ejem: Casa 1 piso, lote 15.">
                    @error('opcional')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="codigo_postal">Código postal</label>
                    <input type="text" wire:model.live="codigo_postal" placeholder="Código postal">
                    @error('codigo_postal')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bloque">
                <div class="item_formulario">
                    <label for="opcional">Instrucción para la entrega (opcional)</label>
                    <textarea id="instrucciones" name="instrucciones" wire:model="instrucciones" rows="3"
                        placeholder="Detalle para el delivery o entrega del producto"></textarea>
                    @error('instrucciones')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="comprador_formulario_boton">
            <button wire:click="closeCreateModal" class="cancelar">Cancelar</button>
            <button wire:click="createDireccion" class="guardar">Guardar Dirección</button>
        </div>
    </div>
</div>
