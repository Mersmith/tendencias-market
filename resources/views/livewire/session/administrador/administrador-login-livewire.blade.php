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
                <span>¿Ya tienes cuenta?</span>
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

            <form wire:submit.prevent="login">
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" wire:model="email" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" wire:model="password" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>

            <div class="contenedor_olvidaste">
                <span>¿Olvidaste tu contraseña?</span>
                <a href="">Recuperalo</a>
            </div>

        </div>
    </div>
</div>
