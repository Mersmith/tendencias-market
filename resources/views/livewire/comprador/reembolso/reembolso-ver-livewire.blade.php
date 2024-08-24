<div>
    <form wire:submit.prevent="updateReembolso">
        <div>
            <label for="banco_id">Banco:</label>
            <select id="banco_id" wire:model="reembolso.banco_id">
                <option value="">Seleccionar Banco</option>
                @foreach($bancos as $banco)
                    <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tipo_cuenta_id">Tipo de Cuenta:</label>
            <select id="tipo_cuenta_id" wire:model="reembolso.tipo_cuenta_id">
                <option value="">Seleccionar Tipo de Cuenta</option>
                @foreach($tipoCuentas as $tipoCuenta)
                    <option value="{{ $tipoCuenta->id }}">{{ $tipoCuenta->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="cuenta_interbancaria">Cuenta Interbancaria:</label>
            <input type="text" id="cuenta_interbancaria" wire:model="reembolso.cuenta_interbancaria">
        </div>

        <div>
            <label for="cuenta_bancaria">Cuenta Bancaria:</label>
            <input type="text" id="cuenta_bancaria" wire:model="reembolso.cuenta_bancaria">
        </div>

        <button type="submit">Guardar Cambios</button>
    </form>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>
