<div>
    <div class="comprador_panel">

        <div class="comprador_titulo">
            <h2>Mis direcciones</h2>
        </div>

        <div class="comprador_lista">
            @if ($direcciones->isEmpty())
                <p>No tienes direcciones registradas.</p>
            @else
                @foreach ($direcciones as $direccion)
                    <div class="lista_item">
                        <div class="dos_bloques">
                            <div>
                                @if ($direccion->es_principal)
                                    <i class="fa-solid fa-heart"></i>
                                @else
                                    <i class="fa-regular fa-heart"
                                        wire:click="establecerPrincipal({{ $direccion->id }})"></i>
                                @endif
                            </div>

                            <div>
                                <p><span>Recibe: </span>{{ $direccion->recibe_nombres }}</p>
                                <p><span>Teléfono: </span>{{ $direccion->recibe_celular }}</p>
                                <p><span>Dirección: </span>{{ $direccion->direccion }}
                                    {{ $direccion->direccion_numero }}
                                </p>
                                <p><span>Dirección: </span>
                                    {{ $direccion->departamento->nombre }} / {{ $direccion->provincia->nombre }} /
                                    {{ $direccion->distrito->nombre }}</p>
                                <p><span>Código Postal:</span>{{ $direccion->codigo_postal }}</p>
                                @if ($direccion->es_principal)
                                    <p>Dirección principal</p>
                                @endif
                            </div>
                        </div>

                        <div class="botones">
                            <button wire:click="editDireccion({{ $direccion->id }})">Editar</button>
                            <button wire:click="confirmDelete({{ $direccion->id }})">Eliminar</button>
                        </div>
                    </div>
                    <br>
                @endforeach
            @endif
        </div>

        <div class="comprador_formulario_boton">
            <button wire:click="$set('newModalVisible', true)" class="guardar">Agregar Nueva Dirección</button>
        </div>
    </div>

    <!-- MODAL CREAR DIRECCION -->
    @if ($newModalVisible)
        @livewire('comprador.direccion.direccion-crear-livewire')
    @endif

    <!-- MODAL EDITAR DIRECCION -->
    @if ($editModalVisible)
        <div class="comprador_modal">
            <div class="modal_contenedor">
                <div class="modal_cerrar">
                    <button wire:click="$set('editModalVisible', false)"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="modal_titulo comprador_titulo">
                    <h2>Editar dirección</h2>
                </div>

                <div class="modal_cuerpo comprador_formulario">
                    <div class="bloque">
                        <div class="item_formulario">
                            <label for="recibe_nombres">Nombres de quién recibe</label>
                            <input type="recibe_nombres" wire:model="recibe_nombres" id="recibe_nombres"
                                placeholder="Nombres y apellidos de quien recibe">
                            @error('recibe_nombres')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="bloque dos_columnas">
                        <div class="item_formulario">
                            <label for="recibe_celular">Celular a contactar</label>
                            <input type="recibe_celular" wire:model="recibe_celular" id="recibe_celular"
                                placeholder="Celular a contactar">
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
                            <input type="text" wire:model="direccion" id="direccion"
                                placeholder="Nombre de la calle">
                            @error('direccion')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="item_formulario">
                            <label for="direccion_numero">Número</label>
                            <input type="text" wire:model="direccion_numero" id="direccion_numero"
                                placeholder="Número de la calle">
                            @error('direccion_numero')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="bloque dos_columnas">
                        <div class="item_formulario">
                            <label for="opcional">Dpto. / Interior / Piso / Lote / Bloque (opcional)</label>
                            <input type="text" wire:model.live="opcional"
                                placeholder="Ejem: Casa 1 piso, lote 15.">
                            @error('opcional')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="codigo_postal">
                            <label for="codigo_postal">Código postal</label>
                            <input type="text" wire:model="codigo_postal" id="codigo_postal">
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
                    <button wire:click="$set('editModalVisible', false)" class="cancelar">Cancelar</button>
                    <button wire:click="updateDireccion" class="guardar">Guardar Cambios</button>
                </div>
            </div>
        </div>
    @endif

    <!-- MODAL CONFIRMAR ELIMINAR DIRECCION -->
    @if ($deleteModalVisible)
        <div class="comprador_modal">
            <div class="modal_contenedor">
                <div class="modal_cerrar">
                    <button wire:click="$set('deleteModalVisible', false)"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="modal_titulo comprador_titulo">
                    <h2>Eliminar dirección</h2>
                </div>

                <div class="modal_cuerpo comprador_formulario">
                    <p>¿Realmente quieres eliminar la dirección?</p>
                </div>

                <div class="comprador_formulario_boton">
                    <button wire:click="$set('deleteModalVisible', false)" class="cancelar">Cancelar</button>
                    <button wire:click="deleteDireccion" class="guardar">Eliminar</button>
                </div>
            </div>
        </div>
    @endif
</div>
