<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relación con el usuario (comprador)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con la dirección del comprador
    public function direccion()
    {
        return $this->belongsTo(CompradorDireccion::class, 'comprador_direccion_id');
    }

    // Relación con el cupón
    public function cupon()
    {
        return $this->belongsTo(Cupon::class, 'cupon_id');
    }

    // Relación con los detalles de la venta
    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }
}
