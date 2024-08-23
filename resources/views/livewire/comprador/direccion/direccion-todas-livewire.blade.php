<div>
    <div>
        @if ($direcciones->isEmpty())
            <p>No tienes direcciones registradas.</p>
        @else
            @foreach ($direcciones as $direccion)
                <div class="direccion-item">
                    <h3>{{ $direccion->recibe_nombres }}</h3>
                    <p>Teléfono: {{ $direccion->recibe_celular }}</p>
                    <p>Dirección: {{ $direccion->direccion }} {{ $direccion->direccion_numero }}</p>
                    <p>
                        {{ $direccion->departamento->nombre }} / {{ $direccion->provincia->nombre }} /
                        {{ $direccion->distrito->nombre }}</p>
                    <p>Código Postal: {{ $direccion->codigo_postal }}</p>
                    @if ($direccion->es_principal)
                        <p><strong>Dirección principal</strong></p>
                    @endif

                    <div>
                        <button wire:click="editDireccion({{ $direccion->id }})">EDITAR</button>
                        <button wire:click="confirmDelete({{ $direccion->id }})">Eliminar</button>
                    </div>
                </div>
                <br>
            @endforeach
        @endif
    </div>

    <!-- Modal de edición -->
    @if ($editModalVisible)
        <div class="modal">
            <div class="modal-content">
                <h3>Editar Dirección</h3>

                <input type="text" wire:model.live="edit_recibe_nombres">
                <input type="text" wire:model.live="edit_recibe_celular" >
                <input type="text" wire:model.live="edit_direccion" >
                <input type="text" wire:model.live="edit_direccion_numero" >
                <input type="text" wire:model.live="edit_codigo_postal" >

                <select wire:model.live="selectedDepartamento">
                    <option value="">Selecciona un Departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>

                <select wire:model.live="selectedProvincia">
                    <option value="">Selecciona una Provincia</option>
                    @foreach ($provincias as $provincia)
                        <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                    @endforeach
                </select>

                <select wire:model.live="selectedDistrito">
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
</div>
