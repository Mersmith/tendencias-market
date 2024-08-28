<div>
    @if (session()->has('success'))
        <div class="comprador_alerta exito">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="comprador_alerta error">
            {{ session('error') }}
        </div>
    @endif

    <div class="comprador_panel">
        <div class="comprador_titulo">
            <h2>Mi perfil</h2>
        </div>

        <form wire:submit.prevent="actualizarDatos" class="comprador_formulario">
            <div class="bloque tres_columnas">
                <div class="item_formulario">
                    <label for="nombre">Nombre</label>
                    <input type="text" wire:model="nombre" id="nombre">
                    @error('nombre')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="apellido_paterno">Apellido paterno</label>
                    <input type="text" wire:model="apellido_paterno" id="apellido_paterno">
                    @error('apellido_paterno')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="apellido_materno">Apellido materno</label>
                    <input type="text" wire:model="apellido_materno" id="apellido_materno">
                    @error('apellido_materno')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bloque tres_columnas">
                <div class="item_formulario">
                    <label for="dni">DNI</label>
                    <input type="text" wire:model="dni" id="dni">
                    @error('dni')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="celular">Celular</label>
                    <input type="text" wire:model="celular" id="celular">
                    @error('celular')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="email">Email</label>
                    <input type="text" wire:model="email" id="email" disabled>
                </div>
            </div>

            <div class="comprador_formulario_boton">
                <button type="submit" class="guardar">Guardar</button>
            </div>
        </form>
    </div>

    <div class="comprador_panel">
        <div class="comprador_titulo">
            <h2>Cambiar contraseña</h2>
        </div>

        <form wire:submit.prevent="actualizarClave" class="comprador_formulario">
            <div class="bloque dos_columnas">
                <div class="item_formulario">
                    <label for="clave_actual">Contraseña actual</label>
                    <input type="password" wire:model="clave_actual" id="clave_actual">
                    @error('clave_actual')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="clave_nueva">Nueva contraseña</label>
                    <input type="password" wire:model="clave_nueva" id="clave_nueva">
                    @error('clave_nueva')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="comprador_formulario_boton">
                <button type="submit" class="guardar">Actualizar</button>
            </div>
        </form>
    </div>
</div>
