<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'estado'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;
}
