<?php

namespace App\Http\Controllers\Sesion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompradorController extends Controller
{

    public function ver()
    {
        return view('sesion.comprador.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRole('comprador')) {
                return redirect()->route('comprador.inicio');
            }
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'No tienes permisos para acceder como comprador.']);
        }

        return redirect()->back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }
}
