<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'update_at'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;

    public function variaciones()
    {
        return $this->hasMany(Variacion::class);
    }

    public function imagens()
    {
        return $this->morphToMany(Imagen::class, 'imagenable');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
    
    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
