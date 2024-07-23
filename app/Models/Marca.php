<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'slug', 'descripcion', 'activo'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_marcas');
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
