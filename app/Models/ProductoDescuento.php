<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoDescuento extends Model
{
    use HasFactory;

    protected $table = 'producto_descuentos';

    protected $fillable = [
        'producto_id',
        'lista_precio_id',
        'porcentaje_descuento',
        'fecha_fin'
    ];
    
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function listaPrecio()
    {
        return $this->belongsTo(ListaPrecio::class);
    }
}
