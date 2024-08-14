<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    use HasFactory;

    protected $fillable = ['carrito_id', 'variacion_id', 'cantidad', 'precio'];

    // Relación con el carrito
    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    // Relación con la variacion del producto
    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }
}
