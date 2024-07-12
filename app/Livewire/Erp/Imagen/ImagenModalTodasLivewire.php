<?php

namespace App\Livewire\Erp\Imagen;

use Livewire\Component;
use App\Models\Imagen;

class ImagenModalTodasLivewire extends Component
{
    public $imagenes;
    public $imagenes_seleccionadas = [];

    public function mount()
    {
        $this->imagenes = Imagen::all();
    }

    public function seleccionarImagen($imagenId)
    {
        $imagen = Imagen::find($imagenId);

        if (in_array($imagen->id, array_column($this->imagenes_seleccionadas, 'id'))) {
            // Si la imagen ya está seleccionada, eliminarla
            $this->imagenes_seleccionadas = array_filter($this->imagenes_seleccionadas, function ($img) use ($imagenId) {
                return $img['id'] != $imagenId;
            });
        } else {
            // Si no está seleccionada, agregarla
            $this->imagenes_seleccionadas[] = [
                'id' => $imagen->id,
                'url' => $imagen->url
            ];
        }
    }

    public function enviar()
    {
        $this->dispatch('actualizarImagenesSeleccionadas', $this->imagenes_seleccionadas);
        $this->reset('imagenes_seleccionadas');
    }

    public function render()
    {
        return view('livewire.erp.imagen.imagen-modal-todas-livewire');
    }
}
