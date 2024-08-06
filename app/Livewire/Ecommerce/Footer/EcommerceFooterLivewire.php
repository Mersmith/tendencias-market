<?php

namespace App\Livewire\Ecommerce\Footer;

use App\Models\EcommerceFooter;
use Livewire\Component;

class EcommerceFooterLivewire extends Component
{
    public $enlaces_rapidos;
    public $redes_sociales;
    public $terminos;
    public $derechos;
    public $direccion;


    public function mount()
    {
        $footer = EcommerceFooter::find(1);

        $this->enlaces_rapidos = json_decode($footer->enlaces_rapidos, true);
        $this->redes_sociales = json_decode($footer->redes_sociales, true);
        $this->terminos = json_decode($footer->terminos, true);
        $this->derechos = $footer->derechos;
        $this->direccion = $footer->direccion;
    }

    public function render()
    {
        return view('livewire.ecommerce.footer.ecommerce-footer-livewire');
    }
}
