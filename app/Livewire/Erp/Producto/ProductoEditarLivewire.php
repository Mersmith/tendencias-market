<?php

namespace App\Livewire\Erp\Producto;

use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

#[Layout('layouts.erp.layout-erp')]
class ProductoEditarLivewire extends Component
{
    public $producto;

    public $subcategorias, $marcas;
    public $imagenes_inicial = [];

    public $categoria_id = "", $marca_id = "", $nombre, $slug, $descripcion, $activo;

    public $imagenes_seleccionadas = [];

    public $modal = false;

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
        $this->categoria_id = $this->producto->categoria_id;

        $categoriasPadres = Categoria::whereNull('categoria_padre_id')->get();
        $this->subcategorias = Categoria::whereIn('categoria_padre_id', $categoriasPadres->pluck('id'))->get();
        
        $this->marcas = Marca::where('activo', true)->get();
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
            "marca_id" => $data['marca_id'],
            "categoria_id" => $data['categoria_id'],
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
