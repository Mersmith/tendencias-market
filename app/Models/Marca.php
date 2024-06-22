<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;
}
