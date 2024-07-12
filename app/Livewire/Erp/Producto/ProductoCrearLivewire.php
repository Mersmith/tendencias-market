<?php

namespace App\Livewire\Erp\Producto;

use App\Http\Requests\ProductoRequest;
use App\Models\Color;
use App\Models\Imagen;
use App\Models\Inventario;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\Talla;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

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

    public $modal = false;

    public $imagenes_seleccionadas = [];
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

            //$inventario_nuevo = new Inventario();
            //$inventario_nuevo->variacion_id = $variacion_nuevo->id;
            //$inventario_nuevo->save();
        }

        // Agregar las relaciones en la tabla imagenables
        if ($this->imagenes_seleccionadas) {
            foreach ($this->imagenes_seleccionadas as $imagen) {
                \DB::table('imagenables')->insert([
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
