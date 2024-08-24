<?php

namespace App\Livewire\Ecommerce\Producto;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;
use App\Models\FavoritoDetalle;
use App\Models\Producto;
class AgregarFavoritoLivewire extends Component
{
    public $productoId;
    public $esFavorito = false;

    public function mount($productoId)
    {
        $this->productoId = $productoId;
        $this->checkFavorito();
    }

    public function checkFavorito()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $favorito = Favorito::where('user_id', $user->id)->first();
            if ($favorito) {
                $this->esFavorito = FavoritoDetalle::where('favorito_id', $favorito->id)
                    ->where('producto_id', $this->productoId)
                    ->exists();
            }
        }
    }

    public function toggleFavorito()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $favorito = Favorito::firstOrCreate(['user_id' => $user->id]);

        $detalle = FavoritoDetalle::where('favorito_id', $favorito->id)
            ->where('producto_id', $this->productoId)
            ->first();

        if ($detalle) {
            $detalle->delete();
            $this->esFavorito = false;
        } else {
            FavoritoDetalle::create([
                'favorito_id' => $favorito->id,
                'producto_id' => $this->productoId,
            ]);
            $this->esFavorito = true;
        }
    }


    public function render()
    {
        return view('livewire.ecommerce.producto.agregar-favorito-livewire');
    }
}
