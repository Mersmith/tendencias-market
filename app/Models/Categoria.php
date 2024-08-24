<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'codigo',
        'descripcion',
        'icono',
        'imagen_ruta',
        'activo',
        'categoria_padre_id',
        'orden',
    ];

    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_padre_id');
    }

    public function categoriaPadre()
    {
        return $this->belongsTo(Categoria::class, 'categoria_padre_id');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function marcas()
    {
        return $this->belongsToMany(Marca::class, 'categoria_marcas');
    }

    public function imagens()
    {
        return $this->morphToMany(Imagen::class, 'imagenable');
    }

    public function cupons()
    {
        return $this->hasMany(Cupon::class, 'categoria_id');
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
