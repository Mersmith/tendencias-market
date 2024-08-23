<?php

namespace App\Livewire\Comprador\Direccion;

use App\Models\CompradorDireccion;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class DireccionTodasLivewire extends Component
{
    public $direcciones;
    public $editingDireccion;
    public $editModalVisible = false;
    public $deleteModalVisible = false;
    public $deleteDireccionId;

    // Variables para los selects anidados
    public $departamentos;
    public $provincias = [];
    public $distritos = [];

    public $selectedDepartamento = null;
    public $selectedProvincia = null;
    public $selectedDistrito = null;
    public $edit_recibe_nombres = null;
    public $edit_recibe_celular = null;
    public $edit_direccion = null;
    public $edit_direccion_numero = null;
    public $edit_codigo_postal = null;

    public function mount()
    {
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direcciones = $comprador->direcciones;
        } else {
            $this->direcciones = collect();
        }

        // Cargar todos los departamentos al montar el componente
        $this->departamentos = Departamento::all();
    }

    public function editDireccion($direccionId)
    {
        $this->editingDireccion = CompradorDireccion::find($direccionId);
        $this->edit_recibe_nombres = $this->editingDireccion->recibe_nombres;
        $this->edit_recibe_celular = $this->editingDireccion->recibe_celular;
        $this->edit_direccion = $this->editingDireccion->direccion;
        $this->edit_direccion_numero = $this->editingDireccion->direccion_numero;
        $this->edit_codigo_postal = $this->editingDireccion->codigo_postal;


        $this->editModalVisible = true;

        // Cargar provincias y distritos según la dirección a editar
        $this->selectedDepartamento = $this->editingDireccion->departamento_id;
        $this->loadProvincias();
        $this->selectedProvincia = $this->editingDireccion->provincia_id;
        $this->loadDistritos();
        $this->selectedDistrito = $this->editingDireccion->distrito_id;
    }

    public function updatedSelectedDepartamento($value)
    {
        // Reiniciar provincias y distritos cuando se cambia el departamento
        $this->selectedProvincia = null;
        $this->provincias = [];
        $this->distritos = [];
        $this->selectedDistrito = null;

        if ($value) {
            $this->loadProvincias();
        }
    }

    public function updatedSelectedProvincia($value)
    {
        // Reiniciar distritos cuando se cambia la provincia
        $this->distritos = [];
        $this->selectedDistrito = null;

        if ($value) {
            $this->loadDistritos();
        }
    }

    public function loadProvincias()
    {
        if (!is_null($this->selectedDepartamento)) {
            $this->provincias = Provincia::where('departamento_id', $this->selectedDepartamento)->get();
        }
    }

    public function loadDistritos()
    {
        if (!is_null($this->selectedProvincia)) {
            $this->distritos = Distrito::where('provincia_id', $this->selectedProvincia)->get();
        }
    }

    public function updateDireccion()
    {
        // Actualizar la dirección con los IDs seleccionados
        $this->editingDireccion->recibe_nombres = $this->edit_recibe_nombres;
        $this->editingDireccion->recibe_celular = $this->edit_recibe_celular;
        $this->editingDireccion->direccion = $this->edit_direccion;
        $this->editingDireccion->direccion_numero = $this->edit_direccion_numero;
        $this->editingDireccion->codigo_postal = $this->edit_codigo_postal;

        $this->editingDireccion->departamento_id = $this->selectedDepartamento;
        $this->editingDireccion->provincia_id = $this->selectedProvincia;
        $this->editingDireccion->distrito_id = $this->selectedDistrito;

        $this->editingDireccion->save();
        $this->editModalVisible = false;
        $this->mount(); // Refrescar las direcciones después de la actualización
    }

    public function confirmDelete($direccionId)
    {
        $this->deleteDireccionId = $direccionId;
        $this->deleteModalVisible = true;
    }

    public function deleteDireccion()
    {
        CompradorDireccion::destroy($this->deleteDireccionId);
        $this->deleteModalVisible = false;
        $this->mount(); // Refrescar las direcciones después de la eliminación
    }


    public function render()
    {
        return view('livewire.comprador.direccion.direccion-todas-livewire', [
            'direcciones' => $this->direcciones,
        ]);
    }
}
