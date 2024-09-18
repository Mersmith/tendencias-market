<div class="g_contenedor_100">
    @if (session()->has('success'))
        <div class="g_alerta alerta_exito">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="g_alerta alerta_error">
            {{ session('error') }}
        </div>
    @endif

    <div class="g_panel">
        <div class="g_titulo">
            <h2>Mi perfil</h2>
        </div>

        <form wire:submit.prevent="actualizarDatos" class="g_formulario">
            <div class="g_bloque tres_columnas">
                <div class="item_formulario">
                    <label for="nombre">Nombre</label>
                    <input type="text" wire:model="nombre" name="nombre" id="nombre" autocomplete="given-name">
                    @error('nombre')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="apellido_paterno">Apellido paterno</label>
                    <input type="text" wire:model="apellido_paterno" name="apellido_paterno" id="apellido_paterno"
                        autocomplete="additional-name">
                    @error('apellido_paterno')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="apellido_materno">Apellido materno</label>
                    <input type="text" wire:model="apellido_materno" name="apellido_materno" id="apellido_materno"
                        autocomplete="additional-name">
                    @error('apellido_materno')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque tres_columnas">
                <div class="item_formulario">
                    <label for="dni">DNI</label>
                    <input type="text" wire:model="dni" name="dni" id="dni" autocomplete="off">
                    @error('dni')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="celular">Celular</label>
                    <input type="text" wire:model="celular" name="celular" id="celular" autocomplete="tel">
                    @error('celular')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="email">Email</label>
                    <input type="email" wire:model="email" name="email" id="email" autocomplete="email"
                        readonly>
                </div>
            </div>

            <div class="g_bloque tres_columnas">
                <div class="g_formulario_boton">
                    <button type="submit" class="guardar">Guardar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="g_panel">
        <div class="g_titulo">
            <h2>Cambiar contraseña</h2>
        </div>

        <form wire:submit.prevent="actualizarClave" class="g_formulario">
            <div class="g_bloque dos_columnas">
                <div class="item_formulario">
                    <label for="clave_actual">Contraseña actual</label>
                    <input type="password" wire:model="clave_actual" name="clave_actual" id="clave_actual"
                        autocomplete="current-password">
                    @error('clave_actual')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="clave_nueva">Nueva contraseña</label>
                    <input type="password" wire:model="clave_nueva" name="clave_nueva" id="clave_nueva"
                        autocomplete="new-password">
                    @error('clave_nueva')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque tres_columnas">
                <div class="g_formulario_boton">
                    <button type="submit" class="guardar">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
