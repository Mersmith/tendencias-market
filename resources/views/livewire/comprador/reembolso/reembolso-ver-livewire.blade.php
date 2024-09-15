<div>
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
            <h2>Datos para reembolso</h2>
        </div>

        <form wire:submit.prevent="updateReembolso" class="g_formulario">
            <div class="g_bloque dos_columnas">
                <div class="item_formulario">
                    <label for="banco_id">Banco:</label>
                    <select wire:model="banco_id" id="banco_id" name="banco_id">
                        <option value="">Seleccionar Banco</option>
                        @foreach ($bancos as $banco)
                            <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                        @endforeach
                    </select>
                    @error('banco_id')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="tipo_cuenta_id">Tipo de Cuenta:</label>
                    <select wire:model="tipo_cuenta_id" id="tipo_cuenta_id" name="tipo_cuenta_id">
                        <option value="">Seleccionar Tipo de Cuenta</option>
                        @foreach ($tipoCuentas as $tipoCuenta)
                            <option value="{{ $tipoCuenta->id }}">{{ $tipoCuenta->nombre }}</option>
                        @endforeach
                    </select>
                    @error('tipo_cuenta_id')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque dos_columnas">
                <div class="item_formulario">
                    <label for="clave_actual">Cuenta Interbancaria</label>
                    <input type="text" wire:model="cuenta_interbancaria" id="clave_actual" name="clave_actual">
                    @error('cuenta_interbancaria')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="clave_nueva">Cuenta Bancaria</label>
                    <input type="text" wire:model="cuenta_bancaria" id="clave_nueva" name="clave_nueva">
                    @error('clave_nueva')
                        <span class="formulario_error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="g_bloque tres_columnas">
                <div class="g_formulario_boton">
                    <button type="submit" class="guardar">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
