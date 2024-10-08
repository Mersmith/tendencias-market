<?php

namespace App\Livewire\Session\Administrador;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdministradorLoginLivewire extends Component
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
            if ($user->hasRole('admin')) {
                return redirect()->route('erp.inicio');
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
        return view('livewire.session.administrador.administrador-login-livewire');
    }
}
