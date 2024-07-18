<?php

namespace App\Livewire\Ecommerce\Categoria;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class CategoriaVerLivewire extends Component
{
    public $categoria;

    public function mount($id, $slug = null)
    {
        $this->categoria = Categoria::where('id', $id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.ecommerce.categoria.categoria-ver-livewire');
    }
}
