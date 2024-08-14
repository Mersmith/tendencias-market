<?php

namespace App\Http\Controllers\Sesion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendedorController extends Controller
{

    public function ver()
    {
        return view('sesion.vendedor.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRole('vendedor')) {
                return redirect()->route('vendedor.inicio');
            }
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'No tienes permisos para acceder como vendedor.']);
        }

        return redirect()->back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }
}
