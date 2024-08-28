<div>
    <!-- Botón para abrir el modal de nueva dirección -->

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
    <!-- Modal de edición -->
    @if ($editModalVisible)
        <div class="comprador_modal">
            <div class="modal_contenedor">
                <div class="modal_cerrar">
                    <button wire:click="$set('editModalVisible', false)">&times;</button>
                </div>

                <div class="modal_titulo comprador_titulo">
                    <h2>Editar dirección</h2>
                </div>

                <div class="modal_cuerpo comprador_formulario">
                    <div class="bloque">
                        <div class="item_formulario">
                            <label for="recibe_nombres">Nombres de quién recibe</label>
                            <input type="recibe_nombres" wire:model="recibe_nombres" id="recibe_nombres">
                            @error('recibe_nombres')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="bloque">
                        <div class="item_formulario">
                            <label for="recibe_celular">Celular a contactar</label>
                            <input type="recibe_celular" wire:model="recibe_celular" id="recibe_celular">
                            @error('recibe_celular')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="bloque">
                        <div class="codigo_postal">
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

                    <div class="bloque">
                        <div class="codigo_postal">
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
                    </div>

                    <div class="bloque">
                        <div class="codigo_postal">
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

                    <div class="bloque">
                        <div class="item_formulario">
                            <label for="direccion">Avenida / Calle / Jirón</label>
                            <input type="text" wire:model="direccion" id="direccion">
                            @error('direccion')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="bloque">
                        <div class="item_formulario">
                            <label for="direccion_numero">Número</label>
                            <input type="text" wire:model="direccion_numero" id="direccion_numero">
                            @error('direccion_numero')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="bloque">
                        <div class="codigo_postal">
                            <label for="codigo_postal">Código postal</label>
                            <input type="text" wire:model="codigo_postal" id="codigo_postal">
                            @error('codigo_postal')
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

    <!-- Modal de confirmación de eliminación -->
    @if ($deleteModalVisible)
        <div class="modal">
            <div class="modal-content">
                <h3>¿Estás seguro de que deseas eliminar esta dirección?</h3>
                <button wire:click="deleteDireccion">Eliminar</button>
                <button wire:click="$set('deleteModalVisible', false)">Cancelar</button>
            </div>
        </div>
    @endif

    <!-- Modal de creación de nueva dirección -->
    @if ($newModalVisible)
        <div class="modal">
            <div class="modal-content">
                <h3>Nueva Dirección</h3>

                <input type="text" wire:model.live="recibe_nombres" placeholder="Nombres">
                <input type="text" wire:model.live="recibe_celular" placeholder="Celular">
                <input type="text" wire:model.live="direccion" placeholder="Dirección">
                <input type="text" wire:model.live="direccion_numero" placeholder="Número de Dirección">
                <input type="text" wire:model.live="codigo_postal" placeholder="Código Postal">

                <select wire:model.live="departamento_id">
                    <option value="">Selecciona un Departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>

                <select wire:model.live="provincia_id">
                    <option value="">Selecciona una Provincia</option>
                    @foreach ($provincias as $provincia)
                        <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                    @endforeach
                </select>

                <select wire:model.live="distrito_id">
                    <option value="">Selecciona un Distrito</option>
                    @foreach ($distritos as $distrito)
                        <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                    @endforeach
                </select>

                <button wire:click="createDireccion">Guardar Dirección</button>
                <button wire:click="$set('newModalVisible', false)">Cancelar</button>
            </div>
        </div>
    @endif
</div>
