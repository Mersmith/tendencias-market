<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use App\Models\Comprador;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompradorPerfilController extends Controller
{
    public function ver()
    {
        // Obtener el comprador autenticado
        $comprador = Comprador::where('user_id', Auth::id())->firstOrFail();

        // Pasar los datos del comprador a la vista
        return view('comprador.perfil.perfil-pagina', compact('comprador'));
    }

    public function actualizar(Request $request)
    {
        // Obtener el comprador autenticado
        $comprador = Comprador::where('user_id', Auth::id())->firstOrFail();

        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'dni' => 'required|string|size:8|unique:compradors,dni,' . $comprador->id,
            'celular' => 'nullable|string|max:15',
        ]);


        // Actualizar los datos del comprador
        $comprador->update([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'dni' => $request->input('dni'),
            'celular' => $request->input('celular'),
        ]);

        // Redirigir de nuevo al perfil con un mensaje de éxito
        return redirect()->route('comprador.perfil.vista.ver')->with('success', 'Perfil actualizado correctamente.');
    }
}
