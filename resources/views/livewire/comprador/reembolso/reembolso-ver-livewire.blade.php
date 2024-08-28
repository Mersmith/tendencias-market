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
            <h2>Datos para reembolso</h2>
        </div>

        <form wire:submit.prevent="updateReembolso" class="comprador_formulario">
            <div class="bloque dos_columnas">
                <div class="item_formulario">
                    <label for="banco_id">Banco:</label>
                    <select id="banco_id" wire:model="banco_id">
                        <option value="">Seleccionar Banco</option>
                        @foreach ($bancos as $banco)
                            <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                        @endforeach
                    </select>
                    @error('banco_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="tipo_cuenta_id">Tipo de Cuenta:</label>
                    <select id="tipo_cuenta_id" wire:model="tipo_cuenta_id">
                        <option value="">Seleccionar Tipo de Cuenta</option>
                        @foreach ($tipoCuentas as $tipoCuenta)
                            <option value="{{ $tipoCuenta->id }}">{{ $tipoCuenta->nombre }}</option>
                        @endforeach
                    </select>
                    @error('tipo_cuenta_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bloque dos_columnas">
                <div class="item_formulario">
                    <label for="clave_actual">Cuenta Interbancaria</label>
                    <input type="text" id="cuenta_interbancaria" wire:model="cuenta_interbancaria">
                    @error('cuenta_interbancaria')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="item_formulario">
                    <label for="clave_nueva">Cuenta Bancaria</label>
                    <input type="text" id="cuenta_bancaria" wire:model="cuenta_bancaria">
                    @error('clave_nueva')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="comprador_formulario_boton">
                <button type="submit" class="guardar">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
