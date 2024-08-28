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
        <div class="modal">
            <div class="modal-content">
                <h3>Editar Dirección</h3>

                <input type="text" wire:model.live="recibe_nombres">
                <input type="text" wire:model.live="recibe_celular">
                <input type="text" wire:model.live="direccion">
                <input type="text" wire:model.live="direccion_numero">
                <input type="text" wire:model.live="codigo_postal">

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

                <button wire:click="updateDireccion">Guardar Cambios</button>
                <button wire:click="$set('editModalVisible', false)">Cancelar</button>
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
