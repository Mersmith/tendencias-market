<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'codigo_color', 'estado'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;
}
