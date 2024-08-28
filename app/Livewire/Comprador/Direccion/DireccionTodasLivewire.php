<?php

namespace App\Livewire\Comprador\Direccion;

use App\Models\CompradorDireccion;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class DireccionTodasLivewire extends Component
{
    public $direcciones;
    public $editModalVisible = false;
    public $deleteModalVisible = false;
    public $newModalVisible = false;
    public $editar_direccion_id;
    public $eliminar_direccion_id;

    public function mount()
    {
        $this->refreshDirecciones();
    }

    #[On('emitCompradorRefreshDirecciones')]
    public function refreshDirecciones()
    {
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direcciones = $comprador->direcciones()->orderBy('es_principal', 'desc')->get();
        } else {
            $this->direcciones = collect();
        }
    }

    public function editDireccion($direccionId)
    {
        $this->editModalVisible = true;
        $this->editar_direccion_id = $direccionId;
    }

    public function establecerPrincipal($direccionId)
    {
        $comprador = Auth::user()->comprador;

        // Desactivar la dirección principal actual
        CompradorDireccion::where('comprador_id', $comprador->id)
            ->where('es_principal', true)
            ->update(['es_principal' => false]);

        // Establecer la nueva dirección como principal
        CompradorDireccion::where('id', $direccionId)
            ->where('comprador_id', $comprador->id)
            ->update(['es_principal' => true]);

        // Recargar las direcciones para reflejar el cambio
        $this->mount();
    }

    #[On('emitCompradorCerrarModalCrearDireccion')]
    public function cerrarCrearEditar()
    {
        $this->newModalVisible = false;
    }

    #[On('emitCompradorCerrarModalEditarDireccion')]
    public function cerrarModalEditar()
    {
        $this->editModalVisible = false;
    }

    public function confirmDelete($direccionId)
    {
        $this->eliminar_direccion_id = $direccionId;
        $this->deleteModalVisible = true;
    }

    public function deleteDireccion()
    {
        CompradorDireccion::destroy($this->eliminar_direccion_id);
        $this->mount();
        $this->reset(['eliminar_direccion_id']);
        $this->deleteModalVisible = false;
    }

    public function render()
    {
        return view('livewire.comprador.direccion.direccion-todas-livewire', [
            'direcciones' => $this->direcciones,
        ]);
    }
}
