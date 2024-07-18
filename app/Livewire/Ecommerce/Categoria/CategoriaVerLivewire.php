<?php

namespace App\Livewire\Ecommerce\Categoria;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class CategoriaVerLivewire extends Component
{
    public $categoria;
    public $categoriaFamilia;
    
    public function mount($id, $slug = null)
    {
        $this->categoria = Categoria::where('id', $id)->firstOrFail();

        if (!$slug || $slug !== $this->categoria->slug) {
            return redirect()->route('ecommerce.categoria.vista.ver', [
                'id' => $this->categoria->id,
                'slug' => $this->categoria->slug
            ]);
        }

        $this->categoriaFamilia = $this->getCategoriaFamilia($this->categoria);
    }

    private function getCategoriaFamilia($categoria)
    {
        $familia = collect();

        // Agregar la categoría actual
        $familia->push($categoria);

        // Agregar la categoría padre si existe
        if ($categoria->categoriaPadre) {
            $familia->prepend($categoria->categoriaPadre);
        }

        // Agregar las subcategorias
        foreach ($categoria->subcategorias as $subcategoria) {
            $familia->push($subcategoria);
        }

        return $familia;
    }

    public function render()
    {
        return view('livewire.ecommerce.categoria.categoria-ver-livewire');
    }
}
