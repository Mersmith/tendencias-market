<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variacion extends Model
{
    use HasFactory;
    protected $table = 'variacions';
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function talla()
    {
        return $this->belongsTo(Talla::class, 'talla_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    public function listaPrecios()
    {
        return $this->hasMany(VariacionListaPrecios::class);
    }

    public function precios()
    {
        return $this->belongsToMany(ListaPrecio::class, 'variacion_lista_precios', 'variacion_id', 'lista_precio_id')
            ->withPivot('precio')
            ->withTimestamps();
    }

    public function descuentos()
    {
        return $this->hasMany(Descuento::class);
    }

}
