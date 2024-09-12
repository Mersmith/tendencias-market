<div class="layout_sesion_contenedor_login">
    <!-- GRID IMAGEN -->
    <div class="elemento_grid_imagen">
        <img src="{{ asset('assets/imagenes/sesion/sesion-1.jpg') }}" alt="" />

        <div>
            <h2>"Canjea tus puntos para que ahorres."</h2>
            <h3>Nickol Sinchi </h3>
            <p>Odontologa</p>
        </div>
    </div>

    <!-- GRID FORMULARIO -->
    <div class="elemento_grid_formulario">
        <div class="centrar_formulario">
            <div class="contenedor_registrate">
                <span>¿No tienes cuenta?</span>
                <a href="">Registrate</a>
            </div>

            <div class="contenedor_logo">
                <a href="#">
                    <img src="{{ asset('assets/ecommerce/imagenes/logo/tendendecias-market-logo-computadora.svg') }}"
                        alt="Tendencias Market" class="imagen_logo_computadora" />
                </a>
            </div>

            <div class="titulo">
                <h1>¡HOLA! BIENVENIDO ADMINISTRADOR </h1>
                <p>Inicie sesión con los datos que se te proporciono. </p>
            </div>

            <form wire:submit.prevent="login" class="g_formulario">
                @if (session()->has('error'))
                    <div>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bloque">
                    <div class="item_formulario">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" wire:model="email" required name="email" id="email"
                            autocomplete="email">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="bloque">
                    <div class="item_formulario">
                        <label for="password">Contraseña:</label>
                        <input type="password" wire:model="password" required name="password" id="password"
                            autocomplete="current-password">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="bloque">
                    <div class="item_formulario">
                        <label for="recordarme">
                            <input type="checkbox" wire:model="recordarme" name="recordarme" id="recordarme"> Recordar
                            sesión
                        </label>
                        @error('recordarme')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="g_formulario_boton">
                    <button type="submit" class="guardar">Ingresar</button>
                </div>
            </form>

            <div class="contenedor_olvidaste">
                <span>¿Olvidaste tu contraseña?</span>
                <a href="">Recupéralo</a>
            </div>
        </div>
    </div>
</div>
