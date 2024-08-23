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
    public $direccion_seleccionada;
    public $editModalVisible = false;
    public $deleteModalVisible = false;
    public $newModalVisible = false;

    public $departamentos;
    public $provincias = [];
    public $distritos = [];
    public $departamento_id = null;
    public $provincia_id = null;
    public $distrito_id = null;
    public $recibe_nombres = null;
    public $recibe_celular = null;
    public $direccion = null;
    public $direccion_numero = null;
    public $codigo_postal = null;

    public $eliminar_direccion_id;

    public function mount()
    {
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direcciones = $comprador->direcciones;
        } else {
            $this->direcciones = collect();
        }

        $this->departamentos = Departamento::all();
    }

    public function updatedDepartamentoId($value)
    {
        $this->provincia_id = null;
        $this->provincias = [];
        $this->distritos = [];
        $this->distrito_id = null;

        if ($value) {
            $this->loadProvincias();
        }
    }

    public function updatedProvinciaId($value)
    {
        $this->distritos = [];
        $this->distrito_id = null;

        if ($value) {
            $this->loadDistritos();
        }
    }

    public function loadProvincias()
    {
        if (!is_null($this->departamento_id)) {
            $this->provincias = Provincia::where('departamento_id', $this->departamento_id)->get();
        }
    }

    public function loadDistritos()
    {
        if (!is_null($this->provincia_id)) {
            $this->distritos = Distrito::where('provincia_id', $this->provincia_id)->get();
        }
    }

    public function createDireccion()
    {
        $direccion = new CompradorDireccion();
        $direccion->comprador_id = Auth::user()->comprador->id;
        $direccion->recibe_nombres = $this->recibe_nombres;
        $direccion->recibe_celular = $this->recibe_celular;
        $direccion->direccion = $this->direccion;
        $direccion->direccion_numero = $this->direccion_numero;
        $direccion->codigo_postal = $this->codigo_postal;
        $direccion->departamento_id = $this->departamento_id;
        $direccion->provincia_id = $this->provincia_id;
        $direccion->distrito_id = $this->distrito_id;

        $direccion->save();

        $this->newModalVisible = false;
        $this->mount();
        $this->resetValuesForm();
    }

    public function editDireccion($direccionId)
    {
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
