<?php

namespace App\Livewire\Comprador\Favorito;

use App\Http\Controllers\Comprador\CompradorFavoritoController;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;
use App\Models\FavoritoDetalle;
class DetalleFavoritoLivewire extends Component
{
    public $favoritos;

    public function mount()
    {
        $this->loadFavoritos();
    }

    public function loadFavoritos()
    {
        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        $user = Auth::user();
        if ($user) {
            $favorito = Favorito::where('user_id', $user->id)->first();
            if ($favorito) {
                $this->favoritos = app(CompradorFavoritoController::class)
                    ->getCompradorFavorito($almacenEcommerceId, $listaPrecioEtiquetaId, $favorito->id);
            } else {
                $this->favoritos = collect([]);
            }
        } else {
            $this->favoritos = collect([]);
        }
    }

    public function eliminarFavorito($productoId)
    {
        $user = Auth::user();

        if ($user) {
            $favorito = Favorito::where('user_id', $user->id)->first();
            if ($favorito) {
                FavoritoDetalle::where('favorito_id', $favorito->id)
                    ->where('producto_id', $productoId)
                    ->delete();

                // Reload favoritos after deletion
                $this->loadFavoritos();
            }
        }
    }

    public function render()
    {
        return view('livewire.comprador.favorito.detalle-favorito-livewire');
    }
}
