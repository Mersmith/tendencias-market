<?php

namespace App\Livewire\Comprador\Direccion;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class DireccionTodasLivewire extends Component
{
    public $direcciones;

    public function mount()
    {
        // Suponiendo que el modelo de User tiene una relación con Comprador.
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direcciones = $comprador->direcciones;
        } else {
            $this->direcciones = collect(); // Si no hay comprador, inicializa con una colección vacía.
        }
    }

    public function render()
    {
        return view('livewire.comprador.direccion.direccion-todas-livewire', [
            'direcciones' => $this->direcciones,
        ]);
    }
}
