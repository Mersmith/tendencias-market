<?php

namespace App\Livewire\Erp\Plantilla\Mostrador;

use App\Models\Mostrador;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.erp.layout-erp')]
class MostradorCrearLivewire extends Component
{
    public $nombre;
    public $imagenes = [];
    public $activo = false;

    public function mount()
    {
        $this->imagenes = [
            [
                'id' => 1,
                'imagen' => '',
                'titulo' => '',
                'link' => '',
            ],
        ];
    }

    public function addImage()
    {
        $maxId = collect($this->imagenes)->max('id');

        $nextId = $maxId ? $maxId + 1 : 1;

        $this->imagenes[] = [
            'id' => $nextId,
            'imagen' => '',
            'titulo' => '',
            'link' => '',
        ];
    }

    public function removeImage($index)
    {
        array_splice($this->imagenes, $index, 1);
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'imagenes.*.id' => 'required|integer',
            'imagenes.*.imagen' => 'required|string',
            'imagenes.*.titulo' => 'nullable|string',
            'imagenes.*.link' => 'required|url',
            'activo' => 'boolean',
        ]);

        $imagenesJson = json_encode($this->imagenes);

        Mostrador::create([
            'nombre' => $this->nombre,
            'imagenes' => $imagenesJson,
            'activo' => $this->activo,
        ]);

        $this->reset(['nombre', 'imagenes', 'activo']);
    }

    #[On('handleMostradorOn')]
    public function handleMostradorOn($item, $position)
    {
        $index = array_search($item, array_column($this->imagenes, 'id'));

        if ($index !== false) {
            $element = array_splice($this->imagenes, $index, 1)[0];
            array_splice($this->imagenes, $position, 0, [$element]);
        }
    }

    public function render()
    {
        return view('livewire.erp.plantilla.mostrador.mostrador-crear-livewire');
    }
}
