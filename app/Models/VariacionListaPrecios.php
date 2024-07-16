<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariacionListaPrecios extends Model
{
    use HasFactory;

    protected $table = 'variacion_lista_precios';

    protected $fillable = [
        'variacion_id',
        'lista_precio_id',
        'precio',
        'precio_antiguo',
        'simbolo',
    ];

    public function listaPrecio()
    {
        return $this->belongsTo(ListaPrecio::class);
    }

    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }
}
