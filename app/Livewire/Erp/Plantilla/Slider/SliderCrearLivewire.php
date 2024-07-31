<?php

namespace App\Livewire\Erp\Plantilla\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.erp.layout-erp')]
class SliderCrearLivewire extends Component
{
    public $nombre;
    public $imagenes = [];
    public $activo = false;

    public function mount()
    {
        $this->imagenes = [
            [
                'id' => 1,
                'imagenComputadora' => '',
                'imagenMovil' => '',
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
            'imagenComputadora' => '',
            'imagenMovil' => '',
            'link' => '',
        ];
    }

    public function removeImage($index)
    {
        array_splice($this->imagenes, $index, 1);
    }

    public function store()
    {
        dd($this->imagenes);
        $this->validate([
            'nombre' => 'required|string|max:255',
            'imagenes.*.id' => 'required|integer',
            'imagenes.*.imagenComputadora' => 'required|string',
            'imagenes.*.imagenMovil' => 'required|string',
            'imagenes.*.link' => 'required|url',
            'activo' => 'boolean',
        ]);

        $imagenesJson = json_encode($this->imagenes);

        Slider::create([
            'nombre' => $this->nombre,
            'imagenes' => $imagenesJson,
            'activo' => $this->activo,
        ]);

        $this->reset(['nombre', 'imagenes', 'activo']);
    }

    #[On('handleSliderOn')]
    public function handleSliderOn($item, $position)
    {
        $index = array_search($item, array_column($this->imagenes, 'id'));

        if ($index !== false) {
            $element = array_splice($this->imagenes, $index, 1)[0];
            array_splice($this->imagenes, $position, 0, [$element]);
        }
    }

    public function render()
    {
        return view('livewire.erp.plantilla.slider.slider-crear-livewire');
    }
}
