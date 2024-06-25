<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'slug', 'descripcion', 'icono', 'imagen_ruta', 'estado'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
