<?php

namespace App\Livewire\Erp\Plantilla\Grid;

use App\Models\Grid;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.erp.layout-erp')]
class GridCrearLivewire extends Component
{
    public $tipos = [
        [
            'id' => 1,
            'nombre' => 'UN TIPO DE IMAGEN',
            'descripcion' => 'Solo una imagen',
        ],
        [
            'id' => 2,
            'nombre' => 'DOS TIPOS DE IMAGEN',
            'descripcion' => 'Dos imagenes',
        ]
    ];

    public $nombre;
    public $tipo_id;
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

        $rules = [
            'nombre' => 'required|string|max:255',
            'imagenes.*.id' => 'required|integer',
            'imagenes.*.imagenComputadora' => 'required|string',
            'imagenes.*.link' => 'required|url',
            'tipo_id' => 'required|string|max:2',
            'activo' => 'boolean',
        ];
        if ($this->tipo_id == 2) {
            $rules['imagenes.*.imagenMovil'] = 'required|string';
        } else {
            $rules['imagenes.*.imagenMovil'] = 'nullable|string';
        }

        $this->validate($rules);

        $imagenesJson = json_encode($this->imagenes);

        Grid::create([
            'nombre' => $this->nombre,
            'imagenes' => $imagenesJson,
            'tipo' => $this->tipo_id,
            'activo' => $this->activo,
        ]);

        $this->reset(['nombre', 'imagenes', 'tipo_id', 'activo']);
    }

    #[On('handleGridOn')]
    public function handleGridOn($item, $position)
    {
        $index = array_search($item, array_column($this->imagenes, 'id'));

        if ($index !== false) {
            $element = array_splice($this->imagenes, $index, 1)[0];
            array_splice($this->imagenes, $position, 0, [$element]);
        }
    }

    public function render()
    {
        return view('livewire.erp.plantilla.grid.grid-crear-livewire');
    }
}
