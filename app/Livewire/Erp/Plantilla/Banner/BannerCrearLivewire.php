<?php

namespace App\Livewire\Erp\Plantilla\Banner;

use App\Models\Banner;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class BannerCrearLivewire extends Component
{
    public $nombre;
    public $imagen_computadora;
    public $imagen_movil;
    public $link;
    public $activo = false;

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'imagen_computadora' => 'required|string|max:255',
            'imagen_movil' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'activo' => 'boolean',
        ]);

        Banner::create([
            'nombre' => $this->nombre,
            'imagen_computadora' => $this->imagen_computadora,
            'imagen_movil' => $this->imagen_movil,
            'link' => $this->link,
            'activo' => $this->activo,
        ]);

        $this->reset(['nombre', 'imagen_computadora', 'imagen_movil', 'link']);
    }

    public function render()
    {
        return view('livewire.erp.plantilla.banner.banner-crear-livewire');
    }
}
