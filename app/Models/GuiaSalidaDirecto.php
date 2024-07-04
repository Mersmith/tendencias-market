<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaSalidaDirecto extends Model
{
    use HasFactory;

    protected $table = 'guia_salida_directos';

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
        return $this->hasMany(GuiaSalidaDirectoDetalle::class);
    }

}
