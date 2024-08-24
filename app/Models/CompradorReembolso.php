<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompradorReembolso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'banco_id',
        'tipo_cuenta_id',
        'cuenta_interbancaria',
        'cuenta_bancaria',
    ];

    // Relación inversa: muchos a uno con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación inversa: muchos a uno con Banco
    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    // Relación inversa: muchos a uno con TipoCuenta
    public function tipoCuenta()
    {
        return $this->belongsTo(TipoCuenta::class);
    }
}
