<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaPrecio extends Model
{
    use HasFactory;

    protected $table = 'lista_precios';
    protected $fillable = ['nombre'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;

    public function variaciones()
    {
        return $this->belongsToMany(Variacion::class, 'variacion_lista_precios', 'lista_precio_id', 'variacion_id')
            ->withPivot('precio')
            ->withTimestamps();
    }
}
