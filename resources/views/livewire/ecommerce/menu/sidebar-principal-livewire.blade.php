<div x-data="xDataMenuEcommerce({{ $categorias }})" x-init="initMenuEcommerce">
    <header class="ecommerce_menu_principal">
        <!-- MENU ARRIBA -->
        <div class="menu_principal_arriba">
            <!-- LOGO COMPUTADORA -->
            <div class="logo_computadora">
                <span class="menu_hamburguesa_movil" x-on:click="toggleContenedorSidebar">
                    <i class="fa-solid fa-bars"></i>
                </span>

                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/ecommerce/imagenes/logo/tendendecias-market-logo-computadora.svg') }}"
                        alt="Tendencias Market" class="imagen_logo_computadora" />

                    <img src="{{ asset('assets/ecommerce/imagenes/logo/tendendecias-market-logo-movil.svg') }}"
                        alt="Tendencias Market" class="imagen_logo_movil" />
                </a>
            </div>

            <!-- BUSCADOR PRINCIPAL -->
            <div class="buscador_principal">
                <div class="contenedor_input_buscador_principal">
                    <input type="text" placeholder="Busca las mejores Tendencias" />
                </div>

                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <!-- MENU HAMBURGUESA COMPUTADORA -->
            <div class="menu_hamburguesa_computadora" x-on:click="toggleContenedorSidebar">
                <span>
                    <i class="fa-solid fa-bars"></i>
                </span>

                <p>Categorias</p>
            </div>

            <!-- MENU PRINCIPAL USUARIOS -->
            <ul class="menu_principal_usuarios">
                <!-- ITEM CUENTA  -->
                <li>
                    <a href="#">
                        <i class="fa-regular fa-user"></i>
                        <span>Cuenta</span>
                    </a>
                </li>

                <!-- ITEM FAVORITOS -->
                <li>
                    <a href="#">
                        <i class="fa-regular fa-heart"></i>
                        <span>Favoritos</span>
                    </a>
                </li>

                <!-- ITEM PUNTOS  -->
                <li>
                    <a href="#">
                        <i class="fa-regular fa-circle-dot"></i>
                        <span>Puntos</span>
                    </a>
                </li>

                <!-- ITEM CARRITO  -->
                <li class="menu_carrito">
                    <a href="#">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Carrito</span>
                        <div class="carrito_numero">
                            <p>0</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <!-- MENU ABAJO -->
        <nav class="menu_principal_abajo">
            <!-- UBICACION -->
            <div class="contenedor_menu_ubicacion">
                <i class="fa-solid fa-location-dot"></i>
                <span>Ingresa tu ubicación</span>
            </div>

            <!-- INFORMACION -->
            <ul class="contenedor_informacion">
                <li>
                    <a href="#">
                        Vende en Tendendecias
                    </a>
                </li>
                <li>
                    <a href="#">
                        Acumula puntos
                    </a>
                </li>
                <li>
                    <a href="#">
                        Venta telefónica
                    </a>
                </li>
                <li>
                    <a href="#">
                        Cupones
                    </a>
                </li>
                <li>
                    <a href="#">
                        Asesor <i class="fa-solid fa-angle-down"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- CONTENEDOR SIDEBAR -->
    <aside class="ecommerce_sidebar_categorias" :class="{ 'estilo_abierto_contenedor_sidebar': estadoAsideAbierto }">
        <!-- SIDEBAR CONTENEDOR -->
        <div class="sidebar_contenedor">
            <!-- SIDEBAR CABECERA -->
            <div class="sidebar_cabecera">
                <div class="saludo">¡Buen día!</div>

                <span x-on:click="toggleContenedorSidebar">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>

            <!-- SIDEBAR CONTENIDO -->
            <div class="sidebar_contenido">
                <!-- CATEGORIAS -->
                <div class="sidebar_cotenido_item">
                    <ul class="sidebar_cotenido_item_ul">
                        <h5>Categorias</h5>
                        <template x-for="dataMenu in dataMenuPrincipal" :key="dataMenu.id">
                            <li x-on:click="toggleContenedorSidebarSubcategorias(dataMenu)">
                                <!-- SIDEBAR CONTENIDO ELEMENTO -->
                                <div class="sidebar_cotenido_elemento">
                                    <span x-text="dataMenu.nombre">
                                    </span>
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>

                <!-- TIENDAS -->
                @if (isset($tiendas['titulo']) && isset($tiendas['items']) && count($tiendas['items']) > 0)
                    <div class="sidebar_cotenido_item">
                        <ul class="sidebar_cotenido_item_ul">
                            <h5>{{ $tiendas['titulo'] }}</h5>
                            @foreach ($tiendas['items'] as $tienda)
                                <li>
                                    <a href="{{ $tienda['url'] }}">
                                        <div class="sidebar_cotenido_elemento">
                                            <span>{{ $tienda['nombre'] }}</span>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- OPORTUNIDADES -->
                @if (isset($oportunidades['titulo']) && isset($oportunidades['items']) && count($oportunidades['items']) > 0)
                    <div class="sidebar_cotenido_item">
                        <ul class="sidebar_cotenido_item_ul">
                            <h5>{{ $oportunidades['titulo'] }}</h5>
                            @foreach ($oportunidades['items'] as $oportunidad)
                                <li>
                                    <a href="{{ $oportunidad['url'] }}">
                                        <div class="sidebar_cotenido_elemento">
                                            <span>{{ $oportunidad['nombre'] }}</span>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- AYUDAS -->
                @if (isset($ayudas['titulo']) && isset($ayudas['items']) && count($ayudas['items']) > 0)
                    <div class="sidebar_cotenido_item">
                        <ul class="sidebar_cotenido_item_ul">
                            <h5>{{ $ayudas['titulo'] }}</h5>
                            @foreach ($ayudas['items'] as $ayuda)
                                <li>
                                    <a href="{{ $ayuda['url'] }}">
                                        <div class="sidebar_cotenido_elemento">
                                            <span>{{ $ayuda['nombre'] }}</span>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- PIE -->
                <div class="sidebar_cotenido_item sidebar_pie">
                    <a href="#">
                        <img src="{{ asset('assets/ecommerce/imagenes/logo/tendendecias-market-logo-computadora.svg') }}"
                            alt="Tendencias Market" />
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- CONTENEDOR SUBCATEGORIAS -->
    <nav class="contenedor_sidebar_subcategorias" :x-show="estadoNavSubcategoriasAbierto">
        <!-- SIDEBAR CONTENEDOR -->
        <div class="sidebar_contenedor">
            <!-- SIDEBAR CABECERA -->
            <div class="sidebar_cabecera sidebar_cabecera_subcategorias">
                <div class="retroceder" x-on:click="cerrarSidebarSubcategorias">
                    <i class="fa-solid fa-angle-left"></i>

                    <span>Retroceder</span>
                </div>

                <span x-on:click="cerrarSidebars">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>

            <!-- SIDEBAR CONTENIDO -->
            <div class="sidebar_contenido">
                <!-- CONTENEDOR SUBCATEGORIA CABECERA  -->
                <div class="sidebar_contenido_cabecera">
                    <a x-text="dataSubMenu1.nombre">
                    </a>
                    <i class="fa-solid fa-angle-right"></i>
                </div>

                <!-- CONTENEDOR SUBCATEGORIA CUERPO  -->
                <div class="contenedor_subcategoria_cuerpo">
                    <div class="contenedor_subcategoria_cuerpo_items">
                        <template x-for="dataMenu in dataSubMenu1.subcategorias" :key="dataMenu.id">
                            <ul x-on:click="toggleContenedorSidebarItemsSubcategoria(dataMenu)">
                                <!-- SIDEBAR CONTENIDO ELEMENTO  -->
                                <div class="sidebar_cotenido_elemento_subcategorias">
                                    <h3 x-text="dataMenu.nombre"></h3>
                                    <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}"
                                        alt="Logo" />
                                </div>

                                <!-- CONTENEDOR ITEM SUBCATEGORIA   -->
                                <div class="contenedor_item_subcategoria">
                                    <template x-for="items in dataMenu.subcategorias" :key="items.id">
                                        <li>
                                            <a href="#" x-text="items.nombre"> </a>
                                        </li>
                                    </template>
                                </div>
                            </ul>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENEDOR ITEMS SUBCATEGORIA -->
    <div class="contenedor_sidebar_items_subcategoria" :x-show="estadoNavItemsSubcategoriaAbierto">
        <!-- SIDEBAR CONTENEDOR -->
        <div class="sidebar_contenedor_items_subcategoria">
            <!-- SIDEBAR CABECERA -->
            <div class="sidebar_cabecera sidebar_cabecera_items_subcategoria">
                <div class="retroceder">
                    <img src="{{ asset('assets/ecommerce/iconos/icono_retroceder.svg') }}" alt="Logo"
                        x-on:click="cerrarSidebarItemsSubcategoria" />
                    <span>Retroceder</span>
                </div>

                <img src="{{ asset('assets/ecommerce/iconos/icono_cerrar.svg') }}" alt="Logo"
                    x-on:click="cerrarSidebars" />
            </div>

            <!-- SIDEBAR CONTENIDO -->
            <div class="sidebar_contenido_items_subcategoria">
                <!-- CONTENEDOR ITEMS SUBCATEGORIA CABECERA  -->
                <div class="contenedor_items_subcategoria_cabecera">
                    <!-- CONTENEDOR ITEMS SUBCATEGORIA TITULO  -->
                    <div class="contenedor_items_subcategoria_titulo">
                        <p x-text="dataSubMenu2.nombre"></p>
                    </div>
                </div>

                <!-- CONTENEDOR ITEMS SUBCATEGORIA CUERPO  -->
                <ul class="contenedor_items_subcategoria_cuerpo">
                    <!-- CONTENEDOR ITEMS SUBCATEGORIA CABECERA  -->
                    <template x-for="items in dataSubMenu2.subcategorias" :key="items.id">
                        <li>
                            <div class="sidebar_cotenido_elemento_items_subcategoria">
                                <a href="#" x-text="items.nombre"></a>
                                <blockquote x-show="items.etiqueta" x-text="items.etiqueta"></blockquote>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>
