function xDataLayoutEcommerce() {
    return {
        estadoSuperponer: false,
        toggleSuperponer() {
            this.estadoSuperponer = !this.estadoSuperponer;
        },
        activarSuperponer() {
            this.estadoSuperponer = true;
        },
        cerrarSuperponer() {
            this.estadoSuperponer = false;
        },
        cerrarTodo() {
            this.estadoSuperponer = false;

            document.dispatchEvent(new CustomEvent('cerrar-sidebars-ecommerce'));
        },
        initLayoutEcommerce() {
            document.addEventListener('activar-superponer', () => {
                this.activarSuperponer();
            });

            document.addEventListener('cerrar-superponer', () => {
                this.cerrarSuperponer();
            });
        }
    };
}

function xDataMenuEcommerce(categorias) {

    return {
        dataMenuPrincipal: categorias || [],
        dataSubMenu1: [],
        dataSubMenu2: [],
        estadoAsideAbierto: false,
        estadoNavSubcategoriasAbierto: false,
        estadoNavItemsSubcategoriaAbierto: false,
        initMenuEcommerce() {
            this.$watch('estadoAsideAbierto', value => {
                document.body.style.overflow = value ? 'hidden' : 'auto';
            });

            window.addEventListener('resize', () => {
                this.cerrarSidebars();
            });

            document.addEventListener('cerrar-sidebars-ecommerce', () => {
                this.cerrarSidebars();
            });
        },

        toggleContenedorSidebar() {
            this.estadoAsideAbierto = !this.estadoAsideAbierto
            this.estadoNavSubcategoriasAbierto = false
            this.estadoNavItemsSubcategoriaAbierto = false

            if (this.estadoAsideAbierto) {
                this.activarSuperponer();
            } else {
                this.cerrarSuperponer();
                this.cerrarSidebars();
            }
        },

        toggleContenedorSidebarSubcategorias(dataMenu) {
            this.estadoNavSubcategoriasAbierto = true
            this.dataSubMenu1 = dataMenu
        },

        toggleContenedorSidebarItemsSubcategoria(dataMenu) {
            this.estadoNavItemsSubcategoriaAbierto = true
            this.dataSubMenu2 = dataMenu
        },

        cerrarSidebars() {
            this.estadoAsideAbierto = false
            this.estadoNavSubcategoriasAbierto = false
            this.estadoNavItemsSubcategoriaAbierto = false
            this.dataSubMenu1 = []
            this.dataSubMenu2 = []
            this.cerrarSuperponer();
        },

        cerrarSidebarSubcategorias() {
            this.estadoNavSubcategoriasAbierto = false
        },

        cerrarSidebarItemsSubcategoria() {
            this.estadoNavItemsSubcategoriaAbierto = false
        },

        activarSuperponer() {
            document.dispatchEvent(new CustomEvent('activar-superponer'));
        },

        cerrarSuperponer() {
            document.dispatchEvent(new CustomEvent('cerrar-superponer'));
        },
    };
}