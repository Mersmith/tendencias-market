<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenciaAlmacenDetalle extends Model
{
    use HasFactory;

    protected $table = 'transferencia_almacen_detalles';

    protected $fillable = [
        'transferencia_almacen_id',
        'variacion_id',
        'cantidad',
    ];

    public function transferenciaAlmacen()
    {
        return $this->belongsTo(TransferenciaAlmacen::class);
    }

    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }
}
