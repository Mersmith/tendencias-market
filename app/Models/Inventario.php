<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }
}
