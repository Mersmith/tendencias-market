<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $fillable = [
        'variacion_id',
        'lista_precio_id',
        'porcentaje_descuento',
        'fecha_fin'
    ];
    
    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }

    public function listaPrecio()
    {
        return $this->belongsTo(ListaPrecio::class);
    }
}
