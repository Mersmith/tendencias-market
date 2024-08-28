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
        @livewire('comprador.direccion.direccion-editar-livewire', ['direccionId' => $editar_direccion_id])       
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
