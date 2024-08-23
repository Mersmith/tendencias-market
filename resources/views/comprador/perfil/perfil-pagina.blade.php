<x-ecommerce-layout>
    <x-comprador-layout>
        <div class="contenedor_pagina_perfil">
            <div class="panel">
                <div>Título</div>

                <!-- Mostrar mensajes de éxito o errores -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario de actualización de perfil -->
                <form action="{{ route('comprador.perfil.actualizar') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="container priority">
                        <div class="cell">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $comprador->nombre) }}">
                        </div>

                        <div class="cell">
                            <label for="apellido_paterno">Apellido paterno</label>
                            <input type="text" name="apellido_paterno"
                                value="{{ old('apellido_paterno', $comprador->apellido_paterno) }}">
                        </div>

                        <div class="cell">
                            <label for="apellido_materno">Apellido materno</label>
                            <input type="text" name="apellido_materno"
                                value="{{ old('apellido_materno', $comprador->apellido_materno) }}">
                        </div>
                    </div>

                    <div class="container priority">
                        <div class="cell">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" value="{{ old('dni', $comprador->dni) }}">
                        </div>

                        <div class="cell">
                            <label for="celular">Celular</label>
                            <input type="text" name="celular" value="{{ old('celular', $comprador->celular) }}">
                        </div>

                        <div class="cell">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ old('email', $comprador->email) }}">
                        </div>
                    </div>

                    <div class="boton">
                        <button type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </x-comprador-layout>
</x-ecommerce-layout>
