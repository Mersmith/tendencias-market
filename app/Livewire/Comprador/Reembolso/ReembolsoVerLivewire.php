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
    public $banco_id;
    public $tipo_cuenta_id;
    public $cuenta_interbancaria;
    public $cuenta_bancaria;

    protected $rules = [
        'banco_id' => 'required|exists:bancos,id',
        'tipo_cuenta_id' => 'required|exists:tipo_cuentas,id',
        'cuenta_interbancaria' => 'required|string|max:20',
        'cuenta_bancaria' => 'required|string|max:20',
    ];

    protected $validationAttributes = [
        'banco_id' => 'banco',
        'tipo_cuenta_id' => 'tipo de cuenta',
        'cuenta_interbancaria' => 'cuenta interbancaria',
        'cuenta_bancaria' => 'cuenta bancaria',
    ];

    protected $messages = [
        'banco_id.required' => 'El :attribute es obligatorio.',
        'banco_id.exists' => 'El :attribute seleccionado no es válido.',
        'tipo_cuenta_id.required' => 'El :attribute es obligatorio.',
        'tipo_cuenta_id.exists' => 'El :attribute seleccionado no es válido.',
        'cuenta_interbancaria.required' => 'La :attribute es obligatoria.',
        'cuenta_interbancaria.string' => 'La :attribute debe ser una cadena de texto.',
        'cuenta_interbancaria.max' => 'La :attribute no debe tener más de :max caracteres.',
        'cuenta_bancaria.required' => 'La :attribute es obligatoria.',
        'cuenta_bancaria.string' => 'La :attribute debe ser una cadena de texto.',
        'cuenta_bancaria.max' => 'La :attribute no debe tener más de :max caracteres.',
    ];

    public function mount()
    {
        $user = Auth::user();

        $this->reembolso = CompradorReembolso::firstOrNew(['user_id' => $user->id]);

        if ($this->reembolso) {
            $this->banco_id = $this->reembolso->banco_id;
            $this->tipo_cuenta_id = $this->reembolso->tipo_cuenta_id;
            $this->cuenta_interbancaria = $this->reembolso->cuenta_interbancaria;
            $this->cuenta_bancaria = $this->reembolso->cuenta_bancaria;
        }

        $this->bancos = Banco::all();
        $this->tipoCuentas = TipoCuenta::all();
    }

    public function updateReembolso()
    {
        $this->validate();

        $this->reembolso->user_id = Auth::id();
        $this->reembolso->banco_id = $this->banco_id;
        $this->reembolso->tipo_cuenta_id = $this->tipo_cuenta_id;
        $this->reembolso->cuenta_interbancaria = $this->cuenta_interbancaria;
        $this->reembolso->cuenta_bancaria = $this->cuenta_bancaria;
        $this->reembolso->save();

        session()->flash('success', 'Reembolso guardado/actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.comprador.reembolso.reembolso-ver-livewire');
    }
}
