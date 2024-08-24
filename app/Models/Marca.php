<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nombre', 'slug', 'descripcion', 'activo'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($marca) {
            $marca->activo = false;
            $marca->save();
        });
    }

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
