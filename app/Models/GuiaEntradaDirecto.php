<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaEntradaDirecto extends Model
{
    use HasFactory;

    const ESTADO_APROBADO = 1;
    const ESTADO_RECHAZADO = 2;
    const ESTADO_OBSERVADO = 3;
    const ESTADO_ELIMINADO = 0;

    protected $table = 'guia_entrada_directos';

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function detalles()
    {
        return $this->hasMany(GuiaEntradaDirectoDetalle::class);
    }
}
