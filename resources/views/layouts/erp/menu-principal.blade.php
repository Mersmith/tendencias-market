<aside class="contenedor_aside" :class="{ 'estilo_abierto_contenedor_aside': estadoAsideAbierto }">
    <div class="contenedor_nav_iconos">
        <span x-on:click="toggleContenedorNavLinks" class="contenedor_menu_hamburguesa"><i
                class="fa-solid fa-bars"></i></span>
        <ul>
            <template x-for="dataMenu in dataMenuPrincipal" :key="dataMenu.id">
                <li>
                    <span @click.prevent="toggleSubmenuPrincipal(dataMenu)"><i
                            :class="dataMenu.icono"></i></span>
                </li>
            </template>
        </ul>
    </div>

    <!-- BLOQUE PARTE -->
    <div class="contenedor_nav_links" :class="{ 'estilo_abierto_contenedor_nav_links': estadoNavAbierto }">
        <div class="contenedor_logo">
            <a href="#">
                <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/logos/logo.svg"
                    alt="">
            </a>
        </div>

        <nav class="sidebar_nav">
            <div class="sidebar_scroll">
                <ul>
                    <template x-for="dataMenu in dataSubMenuPrincipal" :key="dataMenu.id">
                        <li>
                            <a :href="dataMenu.submenu.length ? '#' : dataMenu.url"
                                @click.prevent="toggleSubmenu(dataMenu)"
                                :class="{ 'has-children': dataMenu.submenu.length > 0 }" class="menu-item">
                                <i class="fa-solid fa-user-gear"></i>
                                <span x-text="dataMenu.title"></span>
                                <i class="fa-solid fa-sort-down" x-show="dataMenu.submenu.length > 0"></i>
                            </a>
                            <!-- SUBMENU 1 -->
                            <ul class="submenu1" x-show="dataMenu.open && dataMenu.submenu.length > 0">
                                <template x-for="dataSubmenu1 in dataMenu.submenu" :key="dataSubmenu1.id">
                                    <li>
                                        <a :href="dataSubmenu1.submenu.length ? '#' : dataSubmenu1.url"
                                            @click.prevent="toggleSubmenu(dataSubmenu1)"
                                            :class="{ 'has-children': dataSubmenu1.submenu.length > 0 }">
                                            <i class="fa-solid fa-user-gear"></i>
                                            <span x-text="dataSubmenu1.title"></span>
                                            <i class="fa-solid fa-sort-down"
                                                x-show="dataSubmenu1.submenu.length > 0"></i>
                                        </a>
                                        <!-- SUBMENU 2 -->
                                        <ul class="submenu2"
                                            x-show="dataSubmenu1.open && dataSubmenu1.submenu.length > 0">
                                            <template x-for="dataSubMenu2 in dataSubmenu1.submenu"
                                                :key="dataSubMenu2.id">
                                                <li>
                                                    <a :href="dataSubMenu2.submenu.length ? '#' : dataSubMenu2.url"
                                                        @click.prevent="toggleSubmenu(dataSubMenu2)"
                                                        :class="{ 'has-children': dataSubMenu2.submenu.length > 0 }">
                                                        <i class="fa-solid fa-user-gear"></i>
                                                        <span x-text="dataSubMenu2.title"></span>
                                                        <i class="fa-solid fa-sort-down"
                                                            x-show="dataSubMenu2.submenu.length > 0"></i>
                                                    </a>
                                                    <!-- SUBMENU 3 -->
                                                    <ul class="submenu3"
                                                        x-show="dataSubMenu2.open && dataSubMenu2.submenu.length">
                                                        <template x-for="dataSubmenu3 in dataSubMenu2.submenu"
                                                            :key="dataSubmenu3.id">
                                                            <li>
                                                                <a :href="dataSubmenu3.submenu.length ? '#' : dataSubmenu3
                                                                    .url"
                                                                    @click.prevent="toggleSubmenu(dataSubmenu3)"
                                                                    :class="{
                                                                        'has-children': dataSubmenu3.submenu
                                                                            .length > 0
                                                                    }">
                                                                    <i class="fa-solid fa-user-gear"></i>
                                                                    <span x-text="dataSubmenu3.title"></span>
                                                                    <i class="fa-solid fa-sort-down"
                                                                        x-show="dataSubmenu3.submenu.length > 0"></i>
                                                                </a>
                                                                <!-- SUBMENU 4 -->
                                                                <ul class="submenu4"
                                                                    x-show="dataSubmenu3.open && dataSubmenu3.submenu.length">
                                                                    <template
                                                                        x-for="dataSubmenu4 in dataSubmenu3.submenu"
                                                                        :key="dataSubmenu4.id">
                                                                        <li>
                                                                            <a :href="dataSubmenu4.submenu.length ? '#' :
                                                                                dataSubmenu4.url"
                                                                                @click.prevent="toggleSubmenu(dataSubmenu4)"
                                                                                :class="{
                                                                                    'has-children': dataSubmenu4
                                                                                        .submenu.length > 0
                                                                                }">
                                                                                <i
                                                                                    class="fa-solid fa-user-gear"></i>
                                                                                <span
                                                                                    x-text="dataSubmenu4.title"></span>
                                                                                <i class="fa-solid fa-sort-down"
                                                                                    x-show="dataSubmenu4.submenu.length > 0"></i>
                                                                            </a>
                                                                            <!-- SUBMENU 5 -->
                                                                        </li>
                                                                    </template>
                                                                </ul>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </li>
                                            </template>
                                        </ul>
                                    </li>
                                </template>
                            </ul>
                        </li>
                    </template>
                </ul>
            </div>
        </nav>
    </div>
</aside>