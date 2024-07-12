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

    public $imagenes, $name, $photos = [], $newPhotos = [], $type, $imagenId;
    public function mount()
    {
        $this->imagenes = Imagen::all();
    }

    public function updatedPhotos($photos)
    {
        // Agrega las nuevas fotos al arreglo de newPhotos
        foreach ($photos as $photo) {
            $this->newPhotos[] = $photo;
        }
    }

    public function removePhoto($index)
    {
        array_splice($this->newPhotos, $index, 1);
    }

    public function store()
    {
        foreach ($this->newPhotos as $photo) {
            $path = $photo->store('images', 'public');
            $url = Storage::url($path);

            Imagen::create([
                'name' => $this->name,
                'path' => $path,
                'url' => $url,
                'type' => $this->type,
            ]);
        }

        $this->reset();
        $this->imagenes = Imagen::all();
    }

    public function edit($id)
    {
        $imagen = Imagen::find($id);
        $this->imagenId = $imagen->id;
        $this->name = $imagen->name;
        $this->type = $imagen->type;
    }

    public function update()
    {
        $imagen = Imagen::find($this->imagenId);
        $imagen->name = $this->name;

        if ($this->photos) {
            Storage::delete($imagen->path);
            $path = $this->photos[0]->store('images', 'public'); // Asumiendo solo actualizas una imagen
            $url = Storage::url($path);
            $imagen->path = $path;
            $imagen->url = $url;
        }

        $imagen->type = $this->type;
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
