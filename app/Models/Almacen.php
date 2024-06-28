<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = ['sede_id', 'nombre', 'ubicacion'];

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
