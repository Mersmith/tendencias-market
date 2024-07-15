<?php

namespace App\Livewire\Erp\Imagen;

use Livewire\Component;
use App\Models\Imagen;
use Livewire\WithPagination;

class ImagenModalTodasLivewire extends Component
{
    use WithPagination;

    public $imagenes_seleccionadas = [];

    public function seleccionarImagen($imagenId)
    {
        $imagen = Imagen::find($imagenId);

        if (in_array($imagen->id, array_column($this->imagenes_seleccionadas, 'id'))) {
            $this->imagenes_seleccionadas = array_filter($this->imagenes_seleccionadas, function ($img) use ($imagenId) {
                return $img['id'] != $imagenId;
            });
        } else {
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

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $imagenes = Imagen::orderBy('created_at', 'desc')->paginate(24);

        return view('livewire.erp.imagen.imagen-modal-todas-livewire', [
            'imagenes' => $imagenes,
        ]);
    }
}
