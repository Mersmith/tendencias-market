<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenciaAlmacen extends Model
{
    use HasFactory;

    protected $table = 'transferencia_almacens';

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function sedeOrigen()
    {
        return $this->belongsTo(Sede::class, 'sede_origen_id');
    }

    public function almacenOrigen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_origen_id');
    }

    public function sedeDestino()
    {
        return $this->belongsTo(Sede::class, 'sede_destino_id');
    }

    public function almacenDestino()
    {
        return $this->belongsTo(Almacen::class, 'almacen_destino_id');
    }

    public function detalles()
    {
        return $this->hasMany(TransferenciaAlmacenDetalle::class);
    }

}
