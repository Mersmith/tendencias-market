<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    // Relación uno a muchos con CartItem
    public function detalle()
    {
        return $this->hasMany(FavoritoDetalle::class);
    }

    // Relación con el usuario (opcional si el carrito está asociado a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
