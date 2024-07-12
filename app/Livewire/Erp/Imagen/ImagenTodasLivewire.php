<?php

namespace App\Livewire\Erp\Imagen;

use App\Models\Imagen;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

#[Layout('layouts.erp.layout-erp')]
class ImagenTodasLivewire extends Component
{
    use WithFileUploads;

    public $imagenes;

    public $photos = [], $newPhotos = [];

    public $modal = false, $imagenId, $url, $titulo, $descripcion, $nuevo;

    public function mount()
    {
        $this->imagenes = Imagen::all();
    }

    public function updatedPhotos($photos)
    {
        foreach ($photos as $photo) {
            $this->newPhotos[] = $photo;
        }
    }

    public function removePhoto($index)
    {
        array_splice($this->newPhotos, $index, 1);
    }

    public function deleteImagenNueva()
    {
        $this->nuevo = null;
    }

    public function store()
    {
        foreach ($this->newPhotos as $photo) {
            $path = $photo->store('images', 'public');
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

    public function edit($id)
    {
        $imagen = Imagen::find($id);
        $this->imagenId = $imagen->id;
        $this->titulo = $imagen->titulo;
        $this->descripcion = $imagen->descripcion;
        $this->url = $imagen->url;


        $this->modal = true;
    }

    public function update()
    {
        $imagen = Imagen::find($this->imagenId);
        $imagen->titulo = $this->titulo;

        if ($this->nuevo) {
            Storage::delete($imagen->path);
            $path = $this->nuevo->store('images', 'public');
            $url = Storage::url($path);
            $imagen->path = $path;
            $imagen->url = $url;
        }

        $imagen->descripcion = $this->descripcion;
        $imagen->save();

        $this->reset();
        $this->imagenes = Imagen::all();
    }

    public function delete($id)
    {
        $imagen = Imagen::find($id);
        Storage::delete($imagen->path);
        $imagen->delete();
        $this->imagenes = Imagen::all();
    }

    public function render()
    {
        return view('livewire.erp.imagen.imagen-todas-livewire');
    }
}
