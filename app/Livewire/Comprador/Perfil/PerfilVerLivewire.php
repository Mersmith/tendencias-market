<?php

namespace App\Livewire\Comprador\Perfil;

use Livewire\Component;
use App\Models\Comprador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class PerfilVerLivewire extends Component
{
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $dni;
    public $celular;
    public $email;

    public $clave_actual;
    public $clave_nueva;

    public function mount()
    {
        $comprador = Comprador::where('user_id', Auth::id())->firstOrFail();

        // Asignar los valores del comprador a las propiedades del componente
        $this->nombre = $comprador->nombre;
        $this->apellido_paterno = $comprador->apellido_paterno;
        $this->apellido_materno = $comprador->apellido_materno;
        $this->dni = $comprador->dni;
        $this->celular = $comprador->celular;
        $this->email = $comprador->email;
    }

    public function actualizarDatos()
    {
        // Validar los datos
        $validatedData = $this->validate([
            'nombre' => 'nullable|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'dni' => [
                'required',
                'string',
                'size:8',
                Rule::unique('compradors')->ignore(Auth::id(), 'user_id'),
            ],
            'celular' => 'nullable|string|max:15',
        ]);

        // Actualizar los datos del comprador
        $comprador = Comprador::where('user_id', Auth::id())->firstOrFail();
        $comprador->update($validatedData);

        // Redirigir con un mensaje de éxito
        session()->flash('success', 'Perfil actualizado correctamente.');
    }

    public function actualizarClave()
    {
        // Validar las contraseñas
        $validatedData = $this->validate([
            'clave_actual' => 'required|string',
            'clave_nueva' => 'required|string|min:8',
        ]);

        // Obtener el comprador autenticado
        $comprador = Comprador::where('user_id', Auth::id())->firstOrFail();

        // Verificar si la contraseña actual coincide
        if (!\Hash::check($this->clave_actual, $comprador->user->password)) {
            $this->addError('clave_actual', 'La contraseña actual no es correcta.');
            return;
        }

        // Actualizar la contraseña con la nueva
        $comprador->user->update([
            'password' => bcrypt($this->clave_nueva),
        ]);

        // Limpiar los campos de la contraseña después de la actualización
        $this->reset(['clave_actual', 'clave_nueva']);

        // Redirigir con un mensaje de éxito
        session()->flash('success', 'Contraseña actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.comprador.perfil.perfil-ver-livewire');
    }
}
