<?php

namespace App\Livewire\Comprador\Reembolso;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CompradorReembolso;
use App\Models\Banco;
use App\Models\TipoCuenta;
class ReembolsoVerLivewire extends Component
{
    public $reembolso;
    public $bancos;
    public $tipoCuentas;

    public function mount()
    {
        $user = Auth::user();
        
        if ($user) {
            // Obtener el primer reembolso del usuario autenticado
            $this->reembolso = CompradorReembolso::where('user_id', $user->id)->first();
            
            // Cargar bancos y tipos de cuenta para los selects
            $this->bancos = Banco::all();
            $this->tipoCuentas = TipoCuenta::all();
        }
    }

    public function updateReembolso()
    {
        $this->validate([
            'reembolso.banco_id' => 'required|exists:bancos,id',
            'reembolso.tipo_cuenta_id' => 'required|exists:tipo_cuentas,id',
            'reembolso.cuenta_interbancaria' => 'required|string|max:20',
            'reembolso.cuenta_bancaria' => 'required|string|max:20',
        ]);

        $this->reembolso->save();

        session()->flash('message', 'Reembolso actualizado con éxito.');
    }


    public function render()
    {
        return view('livewire.comprador.reembolso.reembolso-ver-livewire');
    }
}
