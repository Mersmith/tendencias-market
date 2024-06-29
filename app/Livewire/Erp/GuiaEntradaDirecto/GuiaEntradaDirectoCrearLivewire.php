<?php

namespace App\Livewire\Erp\GuiaEntradaDirecto;

use App\Models\Inventario;
use App\Models\ListaPrecio;
use App\Models\Sede;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class GuiaEntradaDirectoCrearLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;
    protected $paginate = 20;

    public $listasPrecios;

    public $variacion_id = null;
    public $inventarios = [];
    public $sedes = [];

    public function mount()
    {
        $this->listasPrecios = ListaPrecio::all();
        $this->sedes = Sede::where('activo', true)->get();
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function seleccionarIdVariacion($id)
    {
        $this->variacion_id = $id;
        $this->obtenerInventarios();
    }

    public function obtenerInventarios()
    {
        if ($this->variacion_id) {
            $this->inventarios = Inventario::where('variacion_id', $this->variacion_id)->get();
        } else {
            $this->inventarios = [];
        }
    }

    public function render()
    {
        $variacionesQuery = Variacion::with(['producto', 'color', 'talla']);

        if ($this->buscarProducto) {
            $variacionesQuery->whereHas('producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $variaciones = $variacionesQuery->paginate(20);

        return view('livewire.erp.guia-entrada-directo.guia-entrada-directo-crear-livewire', [
            'variaciones' => $variaciones,
        ]);
    }
}
