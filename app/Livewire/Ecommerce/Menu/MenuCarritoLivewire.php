<?php

namespace App\Livewire\Ecommerce\Menu;

use App\Http\Controllers\Ecommerce\Layout\EcommerceLayoutController;
use Livewire\Component;
use Livewire\Attributes\On;

class MenuCarritoLivewire extends Component
{
    public $cantidad_items = 0;

    public function mount()
    {
        $this->handleCantidadDetalleCarritoOn();
    }

    #[On('handleCantidadDetalleCarritoOn')]
    public function handleCantidadDetalleCarritoOn()
    {
        $newController = new EcommerceLayoutController();
        $this->cantidad_items = $newController->getEcommerceCantidadItemsCarrito();
    }

    public function render()
    {
        return view('livewire.ecommerce.menu.menu-carrito-livewire');
    }
}
