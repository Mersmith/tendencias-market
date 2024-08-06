<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceFooter extends Model
{
    use HasFactory;

    protected $fillable = ['redes_sociales', 'terminos', 'derechos', 'direccion', 'activo'];

}
