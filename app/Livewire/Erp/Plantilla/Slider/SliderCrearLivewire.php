<?php

namespace App\Livewire\Erp\Plantilla\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class SliderCrearLivewire extends Component
{
    public $nombre;
    public $imagenes = [];
    public $activo = false;

    // Initialize with one empty image
    public function mount()
    {
        $this->imagenes = [
            [
                'id' => '',
                'imagenComputadora' => '',
                'imagenMovil' => '',
                'link' => '',
            ],
        ];
    }

    public function addImage()
    {
        $this->imagenes[] = [
            'id' => '',
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
        // Validate the data
        $this->validate([
            'nombre' => 'required|string|max:255',
            'imagenes.*.id' => 'required|integer',
            'imagenes.*.imagenComputadora' => 'required|string',
            'imagenes.*.imagenMovil' => 'required|string',
            'imagenes.*.link' => 'required|url',
            'activo' => 'boolean',
        ]);

        // Convert `imagenes` to JSON
        $imagenesJson = json_encode($this->imagenes);

        // Create the new slider
        Slider::create([
            'nombre' => $this->nombre,
            'imagenes' => $imagenesJson,
            'activo' => $this->activo,
        ]);

        // Clear the form after saving
        $this->reset(['nombre', 'imagenes', 'activo']);
    }
    public function render()
    {
        return view('livewire.erp.plantilla.slider.slider-crear-livewire');
    }
}
