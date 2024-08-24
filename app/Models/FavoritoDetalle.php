<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritoDetalle extends Model
{
    use HasFactory;

    protected $fillable = ['carrito_id', 'variacion_id'];

    // Relación con el carrito
    public function favorito()
    {
        return $this->belongsTo(Favorito::class);
    }

    // Relación con la variacion del producto
    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }
}
