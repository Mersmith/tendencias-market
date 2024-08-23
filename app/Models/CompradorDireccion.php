<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompradorDireccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'comprador_id',
        'recibe_nombres',
        'recibe_celular',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'direccion',
        'direccion_numero',
        'opcional',
        'codigo_postal',
        'instrucciones',
        'es_principal',
    ];

    public function comprador()
    {
        return $this->belongsTo(Comprador::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
}
