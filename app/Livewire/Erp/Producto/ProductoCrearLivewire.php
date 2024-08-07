<?php

namespace App\Livewire\Erp\Producto;

use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use DB;

#[Layout('layouts.erp.layout-erp')]
class ProductoCrearLivewire extends Component
{
    public $subcategorias = [], $marcas = [];

    public $categoria_id = "", $marca_id = "", $nombre, $slug, $descripcion, $variacion_talla = false, $variacion_color = false, $activo = "0";

    public $imagenes_seleccionadas = [];
    public $modal = false;

    public function mount()
    {
        $categoriasPadres = Categoria::whereNull('categoria_padre_id')->get();
        $this->subcategorias = Categoria::whereIn('categoria_padre_id', $categoriasPadres->pluck('id'))->get();
        
        $this->marcas = Marca::where('activo', true)->get();
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function guardar()
    {
        $data = $this->validate((new ProductoRequest())->rules(), (new ProductoRequest())->messages(), (new ProductoRequest())->attributes());
        

        $producto_nuevo = new Producto();
        $producto_nuevo->marca_id = $data['marca_id'];
        $producto_nuevo->categoria_id = $data['categoria_id'];
        $producto_nuevo->nombre = $data['nombre'];
        $producto_nuevo->slug = $data['slug'];
        $producto_nuevo->descripcion = $data['descripcion'];
        $producto_nuevo->variacion_talla = $this->variacion_talla;
        $producto_nuevo->variacion_color = $this->variacion_color;
        $producto_nuevo->activo = $data['activo'];
        $producto_nuevo->save();

        if (!$this->variacion_talla && !$this->variacion_color) {
            $variacion_nuevo = new Variacion();
            $variacion_nuevo->producto_id = $producto_nuevo->id;
            $variacion_nuevo->save();
        }

        // Agregar las relaciones en la tabla imagenables
        if ($this->imagenes_seleccionadas) {
            foreach ($this->imagenes_seleccionadas as $imagen) {
                DB::table('imagenables')->insert([
                    'imagen_id' => $imagen['id'],
                    'imagenable_id' => $producto_nuevo->id,
                    'imagenable_type' => Producto::class,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('erp.producto.vista.todas');
    }

    #[On('actualizarImagenesSeleccionadas')]
    public function actualizarImagenesSeleccionadas($imagenes)
    {
        foreach ($imagenes as $imagen) {
            if (!in_array($imagen['id'], array_column($this->imagenes_seleccionadas, 'id'))) {
                $this->imagenes_seleccionadas[] = $imagen; // Agregar la imagen si no está
            }
        }
        $this->reset('modal');
    }

    public function eliminarImagen($index)
    {
        // Elimina la imagen del arreglo usando el índice
        unset($this->imagenes_seleccionadas[$index]);

        // Reindexa el arreglo para mantener índices consecutivos
        $this->imagenes_seleccionadas = array_values($this->imagenes_seleccionadas);
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-crear-livewire');
    }
}
