<?php

namespace App\Livewire\Session\Comprador;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CompradorLoginLivewire extends Component
{
    public $email, $password, $recordarme = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials, $this->recordarme)) {
            $user = Auth::user();
            if ($user->hasRole('comprador')) {
                return redirect()->intended(route('comprador.perfil.vista.ver'));
            } else {
                Auth::logout();
                session()->flash('error', 'No tienes permisos para acceder como administrador.');
            }
        } else {
            session()->flash('error', 'Credenciales incorrectas.');
        }
    }

    public function render()
    {
        return view('livewire.session.comprador.comprador-login-livewire');
    }
}
