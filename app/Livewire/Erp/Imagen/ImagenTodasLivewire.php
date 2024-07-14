<?php

namespace App\Livewire\Erp\Imagen;

use App\Models\Imagen;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class ImagenTodasLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;


    public $imagenes_inicial = [], $imagenes_final = [];

    public $modal = false;

    public $imagenId, $url, $titulo, $descripcion, $imagen_edit;

    public function updatedImagenesInicial($imagenes_inicial)
    {
        foreach ($imagenes_inicial as $imagen) {
            $this->imagenes_final[] = $imagen;
        }
    }

    public function eliminarImagenTemporal($index)
    {
        array_splice($this->imagenes_final, $index, 1);
    }

    public function eliminarImagenEditTemporal()
    {
        $this->imagen_edit = null;
    }

    public function guardar()
    {
        foreach ($this->imagenes_final as $imagen) {
            $path = $imagen->store('images', 'public');
            $url = Storage::url($path);

            Imagen::create([
                'titulo' => $this->titulo,
                'path' => $path,
                'url' => $url,
                'descripcion' => $this->descripcion,
            ]);
        }

        $this->reset();
        $this->imagenes = Imagen::all();
    }

    public function seleccionarImagen($id)
    {
        $imagen = Imagen::find($id);
        $this->imagenId = $imagen->id;
        $this->titulo = $imagen->titulo;
        $this->descripcion = $imagen->descripcion;
        $this->url = $imagen->url;

        $this->modal = true;
    }

    public function editarFormulario()
    {
        $imagen = Imagen::find($this->imagenId);
        $imagen->titulo = $this->titulo;

        if ($this->imagen_edit) {
            Storage::delete($imagen->path);
            $path = $this->imagen_edit->store('images', 'public');
            $url = Storage::url($path);
            $imagen->path = $path;
            $imagen->url = $url;
        }

        $imagen->descripcion = $this->descripcion;
        $imagen->save();

        $this->reset();
        $this->imagenes = Imagen::all();
    }

    public function eliminarImagen($id)
    {
        $imagen = Imagen::find($id);
        Storage::delete($imagen->path);
        $imagen->delete();
        $this->imagenes = Imagen::all();
    }

    public function render()
    {
        $imagenes = Imagen::orderBy('created_at', 'desc')->paginate(24);

        return view('livewire.erp.imagen.imagen-todas-livewire', [
            'imagenes' => $imagenes,
        ]);
    }
}
