<?php

namespace App\Livewire\Erp\Producto;

use App\Http\Requests\ProductoRequest;
use App\Models\Color;
use App\Models\Inventario;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\Talla;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Layout('layouts.erp.layout-erp')]
class ProductoCrearLivewire extends Component
{
    public $subcategorias = [], $marcas = [];

    public $subcategoria_id = "";
    public $marca_id = "";
    public $nombre = null;
    public $slug = null;
    public $descripcion = null;
    public $variacion_talla = false;
    public $variacion_color = false;
    public $activo = "2";

    public function mount()
    {
        $this->subcategorias = Subcategoria::all();
        $this->marcas = Marca::all();
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function guardar()
    {
        $data = $this->validate((new ProductoRequest())->rules(), (new ProductoRequest())->messages(), (new ProductoRequest())->attributes());

        $producto_nuevo = new Producto();
        $producto_nuevo->subcategoria_id = $data['subcategoria_id'];
        $producto_nuevo->marca_id = $data['marca_id'];
        $producto_nuevo->nombre = $data['nombre'];
        $producto_nuevo->slug = $data['slug'];
        $producto_nuevo->descripcion = $data['descripcion'];
        $producto_nuevo->variacion_talla = $this->variacion_talla;
        $producto_nuevo->variacion_color = $this->variacion_color;
        $producto_nuevo->save();

        if (!$this->variacion_talla && !$this->variacion_color) {
            $variacion_nuevo = new Variacion();
            $variacion_nuevo->producto_id = $producto_nuevo->id;
            $variacion_nuevo->save();

            $inventario_nuevo = new Inventario();
            $inventario_nuevo->variacion_id = $variacion_nuevo->id;
            $inventario_nuevo->save();

        }

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('erp.producto.vista.todas');
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-crear-livewire');
    }
}
