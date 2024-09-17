<div class="detalle_pagar">
    <!-- RESUMEN DETALLE PAGO -->
    <div class="resumen_detalle_pago">
        <!-- DIRECCION -->
        <div class="g_panel">
            <div>
                <h2 class="g_titulo">Tipo de entrega</h2>
            </div>

            <!-- ENTREGA -->
            <div class="g_lista">
                <!-- TIENDA -->
                <div class="lista_item g_seleccionado @if ($tipoEntrega === 'tienda') seleccionado_activo @endif">
                    <div class="dos_bloques">
                        <div>
                            <input type="radio" name="tipo_entrega" value="tienda" wire:model.live="tipoEntrega">
                        </div>

                        <div>
                            <p><span>Recoge: </span>En tienda.</p>
                        </div>
                    </div>

                    <div class="acciones">
                        <p class="precio">Gratis</p>
                    </div>
                </div>

                <!-- CASA -->
                <div class="lista_item g_seleccionado @if ($tipoEntrega === 'casa') seleccionado_activo @endif">
                    <div class="dos_bloques">
                        <div>
                            <input type="radio" name="tipo_entrega" value="casa" wire:model.live="tipoEntrega">
                        </div>

                        <div>
                            @if ($direccionEnvio)
                                <p><span>Recibe: </span>{{ $direccionEnvio->recibe_nombres }}</p>
                                <p><span>Teléfono: </span>{{ $direccionEnvio->recibe_celular }}</p>
                                <p><span>Dirección: </span>{{ $direccionEnvio->direccion }}
                                    {{ $direccionEnvio->direccion_numero }}
                                </p>
                                <p><span>Dirección: </span>
                                    {{ $direccionEnvio->departamento->nombre }} /
                                    {{ $direccionEnvio->provincia->nombre }} /
                                    {{ $direccionEnvio->distrito->nombre }}</p>
                                <p><span>Código Postal:</span>{{ $direccionEnvio->codigo_postal }}</p>
                            @else
                                <p>No tienes direcciones registradas.</p>
                            @endif
                        </div>
                    </div>

                    <div class="acciones">
                        <button wire:click="abrirModalSeleccionarDireccion()">
                            Cambiar dirección
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <p class="precio">S/.{{ $deliveryTotalCosto }} </p>
                    </div>
                </div>
            </div>

            <!-- MODAL SELECCIONAR DIRECCION -->
            @if ($estadoModalSeleccionarDireccion)
                <div class="g_modal">
                    <div class="modal_contenedor">
                        <div class="modal_cerrar">
                            <button wire:click="$set('estadoModalSeleccionarDireccion', false)"><i
                                    class="fa-solid fa-xmark"></i></button>
                        </div>

                        <div class="g_titulo">
                            <h2>Mis direcciones</h2>
                        </div>

                        <div class="modal_cuerpo">
                            <div class="g_lista">
                                @if ($direcciones->isEmpty())
                                    <p>No tienes direcciones registradas.</p>
                                @else
                                    @foreach ($direcciones as $direccion)
                                        <div
                                            class="lista_item g_seleccionado {{ $direccionEnvio && $direccionEnvio->id == $direccion->id ? 'seleccionado_activo' : '' }}">

                                            <div class="dos_bloques">
                                                <div>
                                                    <input type="radio" name="direccion" value="{{ $direccion->id }}"
                                                        wire:click="seleccionarDireccion({{ $direccion->id }})"
                                                        @checked($direccionEnvio && $direccionEnvio->id == $direccion->id)>
                                                </div>
                                                <div>
                                                    <p><span>Recibe: </span>{{ $direccion->recibe_nombres }}</p>
                                                    <p><span>Teléfono: </span>{{ $direccion->recibe_celular }}</p>
                                                    <p><span>Dirección: </span>{{ $direccion->direccion }}
                                                        {{ $direccion->direccion_numero }}
                                                    </p>
                                                    <p><span>Dirección: </span>
                                                        {{ $direccion->departamento->nombre }} /
                                                        {{ $direccion->provincia->nombre }} /
                                                        {{ $direccion->distrito->nombre }}</p>
                                                    <p><span>Código Postal:</span>{{ $direccion->codigo_postal }}
                                                    </p>
                                                    @if ($direccion->es_principal)
                                                        <p>Dirección principal</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="botones">
                                                <button class="editar_direccion"
                                                    wire:click="editarDireccion({{ $direccion->id }})">Editar</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="g_formulario_boton">
                            <button wire:click="$set('estadoModalSeleccionarDireccion', false)"
                                class="cancelar">Cancelar</button>

                            <button wire:click="$set('estadoModalCrear', true)" class="guardar">Crear nueva
                                dirección</button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- MODAL CREAR DIRECCION -->
            @if ($estadoModalCrear)
                @livewire('comprador.direccion.direccion-crear-livewire', ['origen' => 'comprador-pagar'])
            @endif

            <!-- MODAL EDITAR DIRECCION -->
            @if ($estadoModalEditar)
                @livewire('comprador.direccion.direccion-editar-livewire', ['direccionId' => $editar_direccion_id, 'origen' => 'comprador-pagar'])
            @endif
        </div>

        <!-- CUPON -->
        @if ($carritoCantidadItems == 1)
            <div class="g_panel">
                <div>
                    <h2 class="g_titulo">Cupón</h2>
                </div>

                <div class="g_formulario">
                    <div class="g_bloque">
                        <div class="item_formulario">
                            <label for="recibe_nombres">
                                @if ($cupon_tipo)
                                    {{ $cupon_tipo }} -
                                    @if ($cupon_tipo == 'FIJO')
                                        S/. {{ number_format($cupon_descuento, 2) }}
                                    @else
                                        % {{ $cupon_descuento }}
                                    @endif descuento
                                    = S/. {{ number_format($cuponTotalDescuento, 2) }}
                                @endif
                            </label>
                            <input type="text" wire:model="cupon_codigo" placeholder="Ingresa tu código de cupón" />
                            @if ($cupon_mensaje)
                                <span class="formulario_exito">{{ $cupon_mensaje }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="g_bloque dos_columnas">
                        <div class="g_formulario_boton">
                            <button wire:click="aplicarCupon" class="guardar">Aplicar cupón</button>
                            <button wire:click="eliminarCupon" class="cancelar">Eliminar cupón</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- CARRITO -->
        <div class="g_panel">
            <div>
                <h2 class="g_titulo">Productos ({{ $carritoCantidadItems }})</h2>
            </div>

            <div class="g_carrito">
                @if ($carrito && $carrito->detalle->count() > 0)
                    @foreach ($carrito->detalle as $detalle)
                        <div class="item_producto">
                            <div class="contenedor_imagen">
                                <img src="{{ $detalle->imagen_url }}" alt="">
                            </div>

                            <div class="info_producto">
                                <div class="contenedor_informacion">
                                    <h3 class="producto_nombre"> {{ $detalle->producto_nombre }}</h3>

                                    <h4 class="marca_nombre">{{ $detalle->marca_nombre }}</h4>

                                    <p class="variacion">Cantidad:
                                        <span>{{ $detalle->cantidad }}</span>
                                    </p>

                                    @if ($detalle->color_nombre)
                                        <p class="variacion">Color:
                                            <span>{{ $detalle->color_nombre }}</span>
                                        </p>
                                    @endif

                                    @if ($detalle->talla_nombre)
                                        <p class="variacion">Talla:
                                            <span>{{ $detalle->talla_nombre }}</span>
                                        </p>
                                    @endif
                                </div>

                                <div class="contenedor_precios">
                                    @if ($detalle->precio_oferta)
                                        <p class="precio precio_oferta">S/.
                                            {{ number_format($detalle->precio_oferta, 2) }}</p>
                                    @endif

                                    <p class="precio precio_normal">
                                        S/. {{ number_format($detalle->precio_normal, 2) }}
                                        @if ($detalle->porcentaje_descuento)
                                            <span class="descuento">
                                                - {{ $detalle->porcentaje_descuento }}%
                                            </span>
                                        @endif
                                    </p>
                                    <p class="precio precio_antiguo">S/.
                                        {{ number_format($detalle->precio_antiguo, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        @if (!$loop->last)
                            <div class="g_separacion"></div>
                        @endif
                    @endforeach
                @else
                    <p>Tu carrito está vacío.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- RESUMEN PAGO -->
    <div class="resumen_pago" x-data="{ mostrarMas: false }">
        <div @click="mostrarMas = !mostrarMas" class="g_icono_resumen_pago">
            <span><i :class="{ 'fa-chevron-down': mostrarMas, 'fa-chevron-up': !mostrarMas }"
                    class="fa-solid"></i></span>
        </div>

        <div class="g_panel">
            <div>
                <h2 class="g_titulo">Resumen de tu pedido</h2>
            </div>

            <div class="g_resumen_pagar">
                <div class="contenedor_pagar" :class="{ 'ocultar_pagar': !mostrarMas }">
                    <div class="monto">
                        <p class="texto">Descuento por promo:</p>
                        <span class="numero">- S/. {{ number_format($carritoTotalDescuento, 2) }}</span>
                    </div>

                    <div class="g_separacion"> </div>

                    <div class="monto">
                        <p class="texto">Subtotal:</p>
                        <span class="numero"> S/. {{ number_format($carritoTotalGeneral, 2) }}</span>
                    </div>

                    <div class="g_separacion"> </div>

                    @if ($carritoCantidadItems == 1)
                        @if ($cupon_tipo)
                            <div class="monto">
                                <p class="texto">
                                    Cupón descuento:
                                    @if ($cupon_tipo == 'FIJO')
                                        - S/. {{ number_format($cupon_descuento, 2) }}
                                    @else
                                        - % {{ $cupon_descuento }}
                                    @endif
                                </p>

                                <span class="numero">- S/. {{ number_format($cuponTotalDescuento, 2) }}</span>
                            </div>
                            <div class="g_separacion"> </div>
                        @endif
                    @endif

                    @if ($tipoEntrega == 'tienda')
                        @if ($direccionEnvio)
                            <div class="monto">
                                <p class="texto">Entrega:</p>
                                <span class="numero"> Gratis</span>
                            </div>
                        @endif
                    @else
                        @if ($direccionEnvio)
                            <div class="monto">
                                <p class="texto">Entrega:</p>
                                <span class="numero"> S/. {{ number_format($deliveryTotalCosto, 2) }}</span>
                            </div>
                        @endif
                    @endif

                    <div class="g_separacion"> </div>
                </div>

                <div class="monto">
                    <p class="texto">Total a pagar:</p>
                    <span class="numero"> S/. {{ number_format($total_a_pagar, 2) }}</span>
                </div>

                <button wire:click="pagarAhora" class="continuar_compra">
                    Pagar
                </button>
            </div>
        </div>
    </div>
</div>
