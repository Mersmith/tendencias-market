<?php

namespace App\Livewire\Comprador\Direccion;

use Livewire\Component;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\CompradorDireccion;
use Illuminate\Support\Facades\Auth;

class DireccionCrearLivewire extends Component
{
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
    public $opcional = null;
    public $instrucciones = null;

    public $origen = '';

    public function mount($origen)
    {
        $this->origen = $origen;
        $this->departamentos = Departamento::all();
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
        $direccion->opcional = $this->opcional;
        $direccion->instrucciones = $this->instrucciones;

        $direccion->save();

        if ($this->origen == 'comprador-pagar') {
            $this->dispatch('emitCompradorPagarRefreshDirecciones');
        } else {
            $this->dispatch('emitCompradorRefreshDirecciones');
        }
        $this->resetValuesForm();
        $this->cerrarCrearModal();
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

    public function cerrarCrearModal()
    {
        if ($this->origen == 'comprador-pagar') {
            $this->dispatch('emitCompradorPagarCerrarModalCrearDireccion');
        } else {
            $this->dispatch('emitCompradorCerrarModalCrearDireccion');
        }
        
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
        ]);
    }

    public function render()
    {
        return view('livewire.comprador.direccion.direccion-crear-livewire');
    }
}
