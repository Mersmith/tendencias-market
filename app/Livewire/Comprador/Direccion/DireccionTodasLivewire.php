<?php

namespace App\Livewire\Comprador\Direccion;

use App\Models\CompradorDireccion;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class DireccionTodasLivewire extends Component
{
    public $direcciones;
    public $estadoModalEditar = false;
    public $estadoModalEliminar = false;
    public $estadoModalCrear = false;
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

    public function editarDireccion($direccionId)
    {
        $this->estadoModalEditar = true;
        $this->editar_direccion_id = $direccionId;
    }

    public function establecerPrincipal($direccionId)
    {
        $comprador = Auth::user()->comprador;

        CompradorDireccion::where('comprador_id', $comprador->id)
            ->where('es_principal', true)
            ->update(['es_principal' => false]);

        CompradorDireccion::where('id', $direccionId)
            ->where('comprador_id', $comprador->id)
            ->update(['es_principal' => true]);

        $this->mount();
    }

    #[On('emitCompradorCerrarModalCrearDireccion')]
    public function cerrarModalCrear()
    {
        $this->estadoModalCrear = false;
    }

    #[On('emitCompradorCerrarModalEditarDireccion')]
    public function cerrarModalEditar()
    {
        $this->estadoModalEditar = false;
    }

    public function confirmDelete($direccionId)
    {
        $this->eliminar_direccion_id = $direccionId;
        $this->estadoModalEliminar = true;
    }

    public function deleteDireccion()
    {
        CompradorDireccion::destroy($this->eliminar_direccion_id);
        $this->mount();
        $this->reset(['eliminar_direccion_id']);
        $this->estadoModalEliminar = false;
    }

    public function render()
    {
        return view('livewire.comprador.direccion.direccion-todas-livewire', [
            'direcciones' => $this->direcciones,
        ]);
    }
}
