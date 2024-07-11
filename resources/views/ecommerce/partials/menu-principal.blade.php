@php
    $json_menu = file_get_contents('erp-menu-principal.json');
    $menuPrincipal = collect(json_decode($json_menu, true));
@endphp

<div>
    <!-- MENU PRINCIPAL -->
    <header class="menu_principal">
        <!-- MENU ARRIBA -->
        <div class="menu_principal_arriba">

            <!-- LOGO COMPUTADORA -->
            <div class="logo_computadora">
                <img src="{{ asset('assets/ecommerce/iconos/icono_hamburguesa.svg') }}" alt="Logo"
                    class="imagen_icono_hamburguesa menu_hamburguesa_movil" x-on:click="toggleContenedorSidebar" />

                <a href="#">
                    <img src="{{ asset('assets/ecommerce/imagenes/logo/falabella-orange-logo.svg') }}" alt="Logo"
                        class="imagen_logo_computadora" />
                </a>
            </div>

            <!-- MENU HAMBURGUESA COMPUTADORA -->
            <div class="menu_hamburguesa_computadora" x-on:click="toggleContenedorSidebar">
                <img src="{{ asset('assets/ecommerce/iconos/icono_hamburguesa.svg') }}" alt="Logo"
                    class="imagen_icono_hamburguesa" />

                <span>Menú</span>
            </div>

            <!-- BUSCADOR PRINCIPAL -->
            <div class="buscador_principal">
                <div class="contenedor_input_buscador_principal">
                    <input type="text" placeholder="Buscar en falabella.com" />
                </div>

                <button>
                    <img src="{{ asset('assets/ecommerce/iconos/icono_buscar.svg') }}" alt="Logo" />
                </button>
            </div>

            <!-- MENU PRINCIPAL USUARIOS -->
            <ul class="menu_principal_usuarios">
                <!-- ITEM SESION  -->
                <li class="contenedor_menu_sesion">
                    <span>Hola,</span>
                    <span>Inicia sesión
                        <img src="{{ asset('assets/ecommerce/iconos/icono_abajo.svg') }}" alt="Logo" />
                    </span>
                </li>

                <!-- ITEM MIS COMPRAS  -->
                <li class="menu_compras">
                    <a href="#">
                        <span>Mis</span>
                        <span>compras</span>
                    </a>
                </li>

                <!-- ITEM FAVORITOS  -->
                <li class="menu_favoritos">
                    <a href="#">
                        <img src="{{ asset('assets/ecommerce/iconos/icono_corazon.svg') }}" alt="Logo" />
                    </a>
                </li>

                <!-- ITEM CARRITO  -->
                <li class="menu_carrito">
                    <a href="#">
                        <img src="{{ asset('assets/ecommerce/iconos/icono_carrito.svg') }}" alt="Logo" />
                    </a>
                </li>
            </ul>
        </div>

        <!-- MENU ABAJO -->
        <nav class="menu_principal_abajo">
            <!-- UBICACION -->
            <div class="contenedor_menu_ubicacion">
                <img src="{{ asset('assets/ecommerce/iconos/icono_ubicacion.svg') }}" alt="Logo" />
                <span>Ingresa tu ubicación</span>
            </div>

            <!-- MARCAS - INFORMACION -->
            <div class="contenedor_marcas_informacion">
                <!-- INFORMACION -->
                <ul class="contenedor_informacion">
                    <li>
                        <a href="#">
                            Vende en falabella.com
                        </a>
                    </li>
                    <li>Tarjeta CMR <img src="{{ asset('assets/ecommerce/iconos/icono_abajo.svg') }}" alt="Logo" />
                    </li>
                    <li>Venta telefónica <img src="{{ asset('assets/ecommerce/iconos/icono_abajo.svg') }}"
                            alt="Logo" /></li>
                    <li>Promos y cupones</li>
                    <li>Ayuda <img src="{{ asset('assets/ecommerce/iconos/icono_abajo.svg') }}" alt="Logo" /></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- CONTENEDOR SIDEBAR -->
    <aside class="contenedor_sidebar" :class="{ 'estilo_abierto_contenedor_sidebar': estadoAsideAbierto }">
        <!-- SIDEBAR CONTENEDOR -->
        <div class="sidebar_contenedor">
            <!-- SIDEBAR CABECERA -->
            <div class="sidebar_cabecera">
                <div class="saludo">¡Hola!</div>

                <img src="{{ asset('assets/ecommerce/iconos/icono_cerrar.svg') }}" alt="Logo"
                    x-on:click="toggleContenedorSidebar" />
            </div>

            <!-- SIDEBAR CONTENIDO -->
            <div class="sidebar_contenido">
                <!-- CATEGORIAS -->
                <div class="sidebar_cotenido_item">
                    <ul class="sidebar_cotenido_item_ul">
                        <template x-for="dataMenu in dataMenuPrincipal" :key="dataMenu.id">
                            <li x-on:click="toggleContenedorSidebarSubcategorias(dataMenu)">
                                <!-- SIDEBAR CONTENIDO ELEMENTO -->
                                <div class="sidebar_cotenido_elemento">
                                    <span x-text="dataMenu.nombre">
                                    </span>
                                    <blockquote x-show="dataMenu.etiqueta" x-text="dataMenu.etiqueta"></blockquote>
                                    <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}"
                                        alt="Logo" />
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>

                <!-- TIENDAS -->
                <div class="sidebar_cotenido_item">
                    <ul class="sidebar_cotenido_item_ul">
                        <h5>NUESTRAS TIENDAS</h5>
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Falabella</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Sodimac</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Tottus</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Linio</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- VENDE -->
                <div class="sidebar_cotenido_item">
                    <ul class="sidebar_cotenido_item_ul">
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Vende en falabella.com</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- INFORMACION -->
                <div class="sidebar_cotenido_item">
                    <ul class="sidebar_cotenido_item_ul">
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Guías de compra</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Centro de ayuda</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>GHorario de tiendas</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                        <li>
                            <div class="sidebar_cotenido_elemento">
                                <span>Seguros</span>
                                <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}" alt="Logo" />
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- PIE -->
                <div class="sidebar_cotenido_item sidebar_pie">
                    <a href="#">
                        <img src="{{ asset('assets/ecommerce/imagenes/logo/falabella-orange-logo.svg') }}"
                            alt="Logo" />
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- CONTENEDOR SUBCATEGORIAS -->
    <nav class="contenedor_sidebar_subcategorias" :x-show="estadoNavSubcategoriasAbierto">
        <!-- SIDEBAR CONTENEDOR -->
        <div class="sidebar_contenedor_subcategorias">
            <!-- SIDEBAR CABECERA -->
            <div class="sidebar_cabecera sidebar_cabecera_subcategorias">
                <div class="retroceder">
                    <img src="{{ asset('assets/ecommerce/iconos/icono_retroceder.svg') }}" alt="Logo"
                        x-on:click="cerrarSidebarSubcategorias" />
                    <span>Retroceder</span>
                </div>

                <img src="{{ asset('assets/ecommerce/iconos/icono_cerrar.svg') }}" alt="Logo"
                    x-on:click="cerrarSidebars" />
            </div>

            <!-- SIDEBAR CONTENIDO -->
            <div class="sidebar_contenido_subcategorias">
                <!-- CONTENEDOR SUBCATEGORIA CABECERA  -->
                <div class="contenedor_subcategoria_cabecera">
                    <!-- CONTENEDOR SUBCATEGORIA TITULO  -->
                    <div class="contenedor_subcategoria_titulo">
                        <div class="subcategoria_titulo_icono">
                            <img src="{{ asset('assets/ecommerce/iconos/icono_navidad.svg') }}" alt="Logo" />
                        </div>

                        <p x-text="dataSubMenu1.nombre"></p>
                    </div>

                    <!-- SUBCATEGORIA CABECERA LINK  -->
                    <a href="#">Ver todo</a>
                </div>

                <!-- CONTENEDOR SUBCATEGORIA CUERPO  -->
                <div class="contenedor_subcategoria_cuerpo">
                    <div class="contenedor_subcategoria_cuerpo_items">
                        <template x-for="dataMenu in dataSubMenu1.subCategorias" :key="dataMenu.id">
                            <ul x-on:click="toggleContenedorSidebarItemsSubcategoria(dataMenu)">
                                <!-- SIDEBAR CONTENIDO ELEMENTO  -->
                                <div class="sidebar_cotenido_elemento_subcategorias">
                                    <h3 x-text="dataMenu.titulo"></h3>
                                    <img src="{{ asset('assets/ecommerce/iconos/icono_derecha.svg') }}"
                                        alt="Logo" />
                                </div>

                                <!-- CONTENEDOR ITEM SUBCATEGORIA   -->
                                <div class="contenedor_item_subcategoria">
                                    <template x-for="items in dataMenu.items" :key="items.id">
                                        <li>
                                            <a href="#" x-text="items.nombre"> </a>
                                            <blockquote x-show="items.etiqueta" x-text="items.etiqueta">
                                            </blockquote>
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
                        <p x-text="dataSubMenu2.titulo"></p>
                    </div>
                </div>

                <!-- CONTENEDOR ITEMS SUBCATEGORIA CUERPO  -->
                <ul class="contenedor_items_subcategoria_cuerpo">
                    <!-- CONTENEDOR ITEMS SUBCATEGORIA CABECERA  -->
                    <template x-for="items in dataSubMenu2.items" :key="items.id">
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