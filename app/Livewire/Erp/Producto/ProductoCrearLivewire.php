<?php

namespace App\Livewire\Erp\Producto;

use App\Http\Requests\ProductoRequest;
use App\Models\Color;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\Talla;
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

        Producto::create([
            'subcategoria_id' => $data['subcategoria_id'],
            'marca_id' => $data['marca_id'],
            'nombre' => $data['nombre'],
            'slug' => $data['slug'],
            'descripcion' => $data['descripcion'],
            'activo' => $data['activo'],
            'variacion_talla' => $this->variacion_talla,
            'variacion_color' => $this->variacion_color,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('erp.producto.vista.todas');
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-crear-livewire');
    }
}
