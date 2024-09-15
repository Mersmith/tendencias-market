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

        //dd($this->favoritos);
    }

    /*public function loadFavoritos()
    {
        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        // Limpiar favoritos antes de cargar la lista
        app(CompradorFavoritoController::class)
            ->limpiarFavoritos($almacenEcommerceId, $listaPrecioEtiquetaId);

        $user = Auth::user();

        if ($user) {
            $favorito = Favorito::where('user_id', $user->id)->first();
            if ($favorito) {
                // Cargar la lista de productos favoritos filtrados
                $this->favoritos = FavoritoDetalle::with('producto')
                    ->where('favorito_id', $favorito->id)
                    ->get()
                    ->pluck('producto');
            } else {
                $this->favoritos = collect([]);
            }
        } else {
            $this->favoritos = collect([]);
        }
    }*/

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
