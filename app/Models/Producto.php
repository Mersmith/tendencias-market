<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'update_at'];

    const ACTIVADO = 1;
    const DESACTIVADO = 2;

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
