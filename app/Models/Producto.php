<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Producto extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['id', 'created_at', 'update_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($producto) {
            $producto->activo = false;
            $producto->save();
        });
    }
    
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

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function listaPrecios()
    {
        return $this->hasMany(ProductoListaPrecios::class);
    }

    public function precios()
    {
        return $this->belongsToMany(ListaPrecio::class, 'producto_lista_precios', 'producto_id', 'lista_precio_id')
            ->withPivot('precio')
            ->withTimestamps();
    }

    public function descuentos()
    {
        return $this->hasMany(ProductoDescuento::class);
    }

    public function cupons()
    {
        return $this->hasMany(Cupon::class, 'producto_id');
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
