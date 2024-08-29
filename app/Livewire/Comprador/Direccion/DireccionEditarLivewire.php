<?php

namespace App\Livewire\Comprador\Direccion;

use Livewire\Component;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\CompradorDireccion;

class DireccionEditarLivewire extends Component
{
    public $direccion_seleccionada;
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

    public function mount($direccionId, $origen)
    {
        $this->editDireccion($direccionId);
        $this->origen = $origen;
        $this->departamentos = Departamento::all();
    }

    public function editDireccion($direccionId)
    {
        $this->direccion_seleccionada = CompradorDireccion::find($direccionId);
        $this->recibe_nombres = $this->direccion_seleccionada->recibe_nombres;
        $this->recibe_celular = $this->direccion_seleccionada->recibe_celular;
        $this->direccion = $this->direccion_seleccionada->direccion;
        $this->direccion_numero = $this->direccion_seleccionada->direccion_numero;
        $this->codigo_postal = $this->direccion_seleccionada->codigo_postal;


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

        if ($this->origen == 'comprador-pagar') {
            $this->dispatch('emitCompradorPagarRefreshDirecciones');
        } else {
            $this->dispatch('emitCompradorRefreshDirecciones');
        }        
        $this->resetValuesForm();
        $this->cerrarEditarModal();
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

    public function cerrarEditarModal()
    {
        if ($this->origen == 'comprador-pagar') {
            $this->dispatch('emitCompradorPagarCerrarModalEditarDireccion');
        } else {
            $this->dispatch('emitCompradorCerrarModalEditarDireccion');
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
        return view('livewire.comprador.direccion.direccion-editar-livewire');
    }
}
