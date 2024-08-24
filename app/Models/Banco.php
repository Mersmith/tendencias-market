<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Relación uno a muchos con CompradorReembolso
    public function compradorReembolsos()
    {
        return $this->hasMany(CompradorReembolso::class);
    }

}
