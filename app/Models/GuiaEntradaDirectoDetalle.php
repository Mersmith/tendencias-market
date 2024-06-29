<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaEntradaDirectoDetalle extends Model
{
    use HasFactory;

    protected $table = 'guia_entrada_directo_detalles';

    protected $fillable = [
        'guia_entrada_directo_id',
        'variacion_id',
        'stock',
        'stock_minimo'
    ];

    public function guiaEntradaDirecto()
    {
        return $this->belongsTo(GuiaEntradaDirecto::class);
    }

    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }
}
