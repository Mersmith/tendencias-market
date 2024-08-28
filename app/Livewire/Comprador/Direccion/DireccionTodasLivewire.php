<?php

namespace App\Livewire\Comprador\Direccion;

use App\Models\CompradorDireccion;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class DireccionTodasLivewire extends Component
{
    public $direcciones;
    public $direccion_seleccionada;
    public $editModalVisible = false;
    public $deleteModalVisible = false;
    public $newModalVisible = false;
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
        $this->resetValuesForm();

        $this->direccion_seleccionada = CompradorDireccion::find($direccionId);
        $this->recibe_nombres = $this->direccion_seleccionada->recibe_nombres;
        $this->recibe_celular = $this->direccion_seleccionada->recibe_celular;
        $this->direccion = $this->direccion_seleccionada->direccion;
        $this->direccion_numero = $this->direccion_seleccionada->direccion_numero;
        $this->codigo_postal = $this->direccion_seleccionada->codigo_postal;

        $this->editModalVisible = true;

        $this->departamento_id = $this->direccion_seleccionada->departamento_id;
        $this->loadProvincias();
        $this->provincia_id = $this->direccion_seleccionada->provincia_id;
        $this->loadDistritos();
        $this->distrito_id = $this->direccion_seleccionada->distrito_id;
    }

    public function updateDireccion()
    {
        $this->direccion_seleccionada->recibe_nombres = $this->recibe_nombres;
        $this->direccion_seleccionada->recibe_celular = $this->recibe_celular;
        $this->direccion_seleccionada->direccion = $this->direccion;
        $this->direccion_seleccionada->direccion_numero = $this->direccion_numero;
        $this->direccion_seleccionada->codigo_postal = $this->codigo_postal;

        $this->direccion_seleccionada->departamento_id = $this->departamento_id;
        $this->direccion_seleccionada->provincia_id = $this->provincia_id;
        $this->direccion_seleccionada->distrito_id = $this->distrito_id;

        $this->direccion_seleccionada->save();
        $this->editModalVisible = false;
        $this->mount();
        $this->resetValuesForm();
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

    public function resetValuesForm()
    {
        $this->reset([
            'recibe_nombres',
            'recibe_celular',
            'direccion',
            'direccion_numero',
            'codigo_postal',
            'departamento_id',
            'provincia_id',
            'distrito_id',
            'eliminar_direccion_id',
        ]);
    }

    #[On('emitCompradorCerrarModalCrearDireccion')]
    public function closeCreateModal()
    {
        $this->newModalVisible = false;
    }

    public function confirmDelete($direccionId)
    {
        $this->eliminar_direccion_id = $direccionId;
        $this->deleteModalVisible = true;
    }

    public function deleteDireccion()
    {
        CompradorDireccion::destroy($this->eliminar_direccion_id);
        $this->deleteModalVisible = false;
        $this->mount();
        $this->resetValuesForm();
    }

    public function render()
    {
        return view('livewire.comprador.direccion.direccion-todas-livewire', [
            'direcciones' => $this->direcciones,
        ]);
    }
}
