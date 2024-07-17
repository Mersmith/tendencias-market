<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoListaPrecios extends Model
{
    use HasFactory;

    protected $table = 'producto_lista_precios';

    protected $fillable = [
        'producto_id',
        'lista_precio_id',
        'precio',
        'precio_antiguo',
        'simbolo',
    ];

    public function listaPrecio()
    {
        return $this->belongsTo(ListaPrecio::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
