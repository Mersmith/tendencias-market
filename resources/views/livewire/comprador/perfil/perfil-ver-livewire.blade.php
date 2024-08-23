<div>
    <div>
        <p>Datos</p>
        <!-- Formulario de actualización de perfil -->
        <form wire:submit.prevent="actualizarDatos">
            <div class="container priority">
                <div class="cell">
                    <label for="nombre">Nombre</label>
                    <input type="text" wire:model="nombre" id="nombre">
                    @error('nombre')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="cell">
                    <label for="apellido_paterno">Apellido paterno</label>
                    <input type="text" wire:model="apellido_paterno" id="apellido_paterno">
                    @error('apellido_paterno')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="cell">
                    <label for="apellido_materno">Apellido materno</label>
                    <input type="text" wire:model="apellido_materno" id="apellido_materno">
                    @error('apellido_materno')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="container priority">
                <div class="cell">
                    <label for="dni">DNI</label>
                    <input type="text" wire:model="dni" id="dni">
                    @error('dni')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="cell">
                    <label for="celular">Celular</label>
                    <input type="text" wire:model="celular" id="celular">
                    @error('celular')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="cell">
                    <label for="email">Email</label>
                    <input type="text" wire:model="email" id="email" disabled>
                </div>
            </div>

            <div class="boton">
                <button type="submit">Guardar</button>
            </div>

            @if (session()->has('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>
    
    <div>
        <p>Seguridad</p>
        <form wire:submit.prevent="actualizarClave">
            <div class="container priority">
                <div class="cell">
                    <label for="clave_actual">Contraseña actual</label>
                    <input type="password" wire:model="clave_actual" id="clave_actual">
                    @error('clave_actual')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="cell">
                    <label for="clave_nueva">Nueva contraseña</label>
                    <input type="password" wire:model="clave_nueva" id="clave_nueva">
                    @error('clave_nueva')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
    
            <div class="boton">
                <button type="submit">Guardar</button>
            </div>
    
            @if (session()->has('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>
    


</div>
