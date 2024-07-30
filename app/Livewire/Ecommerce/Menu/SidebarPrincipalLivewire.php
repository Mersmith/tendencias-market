<?php

namespace App\Livewire\Ecommerce\Menu;

use App\Http\Controllers\Erp\CategoriaController;
use Livewire\Component;

class SidebarPrincipalLivewire extends Component
{
    public $categorias;

    public function mount()
    {
        $categoriaController = new CategoriaController();
        $this->categorias = $categoriaController->getEcommerceCategoriaAnidadas();
    }

    public function render()
    {
        return view('livewire.ecommerce.menu.sidebar-principal-livewire', [
            'categorias' => $this->categorias,
        ]);
    }
}
