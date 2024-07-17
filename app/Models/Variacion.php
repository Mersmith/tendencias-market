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
}
