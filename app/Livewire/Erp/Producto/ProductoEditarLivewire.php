<?php

namespace App\Livewire\Erp\Producto;

use App\Http\Requests\ProductoRequest;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Subcategoria;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

#[Layout('layouts.erp.layout-erp')]
class ProductoEditarLivewire extends Component
{
    public $producto;
    public $imagenes_inicial = [];

    public $subcategorias, $marcas;

    public $nombre, $slug, $descripcion, $activo, $subcategoria_id = "", $marca_id = "";

    public $modal = false;

    public $imagenes_seleccionadas = [];

    public function mount($id)
    {
        $this->producto = Producto::with('imagens')->find($id);
        $this->imagenes_inicial = $this->producto->imagens->toArray();
        $this->imagenes_seleccionadas = $this->producto->imagens->toArray();

        $this->nombre = $this->producto->nombre;
        $this->slug = $this->producto->slug;
        $this->descripcion = $this->producto->descripcion;
        $this->activo = $this->producto->activo;
        $this->marca_id = $this->producto->marca_id;
        $this->subcategoria_id = $this->producto->subcategoria_id;

        $this->subcategorias = Subcategoria::all();
        $this->marcas = Marca::all();
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function actualizar()
    {
        $request = new ProductoRequest($this->producto->id);
        $data = $this->validate($request->rules(), $request->messages(), $request->attributes());

        $this->producto->update([
            "subcategoria_id" => $data['subcategoria_id'],
            "marca_id" => $data['marca_id'],
            "nombre" => $data['nombre'],
            "slug" => $data['slug'],
            "descripcion" => $data['descripcion'],
            "activo" => $data['activo'],
        ]);

        if ($this->imagenes_seleccionadas) {
            $imagenes_ids = array_column($this->imagenes_seleccionadas, 'id');
            $this->producto->imagens()->sync($imagenes_ids);
        }

        $this->dispatch('alertaLivewire', "Actualizado");
    }

    #[On('actualizarImagenesSeleccionadas')]
    public function actualizarImagenesSeleccionadas($imagenes)
    {
        foreach ($imagenes as $imagen) {
            if (!in_array($imagen['id'], array_column($this->imagenes_seleccionadas, 'id'))) {
                $this->imagenes_seleccionadas[] = $imagen;
            }
        }
        $this->reset('modal');
    }

    public function eliminarImagen($index)
    {
        unset($this->imagenes_seleccionadas[$index]);

        $this->imagenes_seleccionadas = array_values($this->imagenes_seleccionadas);
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-editar-livewire');
    }
}
