<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaSalidaDirectoDetalle extends Model
{
    use HasFactory;

    protected $table = 'guia_salida_directo_detalles';

    protected $fillable = [
        'guia_salida_directo_id',
        'variacion_id',
        'cantidad',
    ];

    public function guiaSalidaDirecto()
    {
        return $this->belongsTo(GuiaSalidaDirecto::class);
    }

    public function variacion()
    {
        return $this->belongsTo(Variacion::class);
    }
}
