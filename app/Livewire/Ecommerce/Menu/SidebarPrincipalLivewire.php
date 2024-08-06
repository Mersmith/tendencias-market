<?php

namespace App\Livewire\Ecommerce\Menu;

use App\Http\Controllers\Erp\CategoriaController;
use Livewire\Component;

class SidebarPrincipalLivewire extends Component
{
    public $categorias;

    public $tiendas = [
        'titulo' => 'NUESTRAS TIENDAS',
        'items' => [
            ['id' => 1, 'nombre' => 'Falabella', 'url' => '#'],
            ['id' => 2, 'nombre' => 'Sodimac', 'url' => '#'],
            ['id' => 3, 'nombre' => 'Tottus', 'url' => '#'],
            ['id' => 4, 'nombre' => 'Linio', 'url' => '#'],
        ],
    ];

    public $oportunidades = [
        'titulo' => 'OPORTUNIDADES',
        'items' => [
            ['id' => 1, 'nombre' => 'Vende en Tendencias', 'url' => '#'],
        ],
    ];

    public $ayudas = [
        'titulo' => 'AYUDAS',
        'items' => [
            ['id' => 1, 'nombre' => 'Guías de compra', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Centro de ayuda', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Horario de tiendas', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Seguros', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Guías de compra', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Centro de ayuda', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Horario de tiendas', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Seguros', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Guías de compra', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Centro de ayuda', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Horario de tiendas', 'url' => '#'],
            ['id' => 1, 'nombre' => 'Seguros', 'url' => '#'],
        ],
    ];

    public function mount()
    {
        $categoriaController = new CategoriaController();
        $this->categorias = $categoriaController->getEcommerceCategoriaAnidadas();

        //dd($this->categorias);

    }

    public function render()
    {
        return view('livewire.ecommerce.menu.sidebar-principal-livewire', [
            'categorias' => $this->categorias,
            'tiendas' => $this->tiendas,
            'oportunidades' => $this->oportunidades,
            'ayudas' => $this->ayudas,
        ]);
    }
}
