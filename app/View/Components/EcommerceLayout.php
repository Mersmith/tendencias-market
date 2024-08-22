<?php

namespace App\View\Components;

use App\Http\Controllers\Ecommerce\Layout\EcommerceLayoutController;
use App\Http\Controllers\Erp\CategoriaController;
use Illuminate\View\Component;
use Illuminate\View\View;

class EcommerceLayout extends Component
{
    public $footer;
    public $categorias;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $categoriaController = new EcommerceLayoutController();
        $this->footer = $categoriaController->getEcommerceFooter(1);
        $this->categorias = $categoriaController->getEcommerceCategoriaAnidadas();
        //dd($this->categorias);
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.ecommerce.layout-ecommerce', [
            'footer' => $this->footer,
            'categorias' => $this->categorias,
        ]);
    }
}
