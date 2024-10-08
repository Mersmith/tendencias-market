<?php

use App\Http\Controllers\Erp\AlmacenController;
use App\Http\Controllers\Erp\CategoriaController;
use App\Http\Controllers\Erp\ColorController;
use App\Http\Controllers\Erp\ErpInicioController;
use App\Http\Controllers\Erp\Footer\ErpFooterController;
use App\Http\Controllers\Erp\MarcaController;
use App\Http\Controllers\Erp\ListaPrecioController;
use App\Http\Controllers\Erp\SedeController;
use App\Http\Controllers\Erp\SerieController;
use App\Http\Controllers\Erp\SubcategoriaController;
use App\Http\Controllers\Erp\TallaController;
use App\Http\Controllers\Erp\TipoDocumentoController;
use App\Livewire\Erp\Categoria\CategoriaTodasLivewire;
use App\Livewire\Erp\Descuento\ProductoDescuentoTodasLivewire;
use App\Livewire\Erp\GuiaEntradaDirecto\GuiaEntradaDirectoCrearLivewire;
use App\Livewire\Erp\GuiaEntradaDirecto\GuiaEntradaDirectoTodasLivewire;
use App\Livewire\Erp\GuiaEntradaDirectoDetalle\GuiaEntradaDirectoDetalleVerLivewire;
use App\Livewire\Erp\GuiaSalidaDirecto\GuiaSalidaDirectoCrearLivewire;
use App\Livewire\Erp\GuiaSalidaDirecto\GuiaSalidaDirectoTodasLivewire;
use App\Livewire\Erp\GuiaSalidaDirectoDetalle\GuiaSalidaDirectoDetalleVerLivewire;
use App\Livewire\Erp\Imagen\ImagenTodasLivewire;
use App\Livewire\Erp\Inventario\InventarioTodasLivewire;
use App\Livewire\Erp\Inventario\InventarioVariacionListaPrecioTodasLivewire;
use App\Livewire\Erp\ListaPrecio\ProductoListaPrecioTodasLivewire;
use App\Livewire\Erp\Plantilla\Banner\BannerCrearLivewire;
use App\Livewire\Erp\Plantilla\Footer\FooterEditarLivewire;
use App\Livewire\Erp\Plantilla\Grid\GridCrearLivewire;
use App\Livewire\Erp\Plantilla\Mostrador\MostradorCrearLivewire;
use App\Livewire\Erp\Plantilla\Slider\SliderCrearLivewire;
use App\Livewire\Erp\Producto\ProductoCrearLivewire;
use App\Livewire\Erp\Producto\ProductoDescuentoEditarLivewire;
use App\Livewire\Erp\Producto\ProductoEditarLivewire;
use App\Livewire\Erp\Producto\ProductoInventarioVerLivewire;
use App\Livewire\Erp\Producto\ProductoListaPrecioEditarLivewire;
use App\Livewire\Erp\Producto\ProductoTodasLivewire;
use App\Livewire\Erp\Producto\ProductoVariacionEditarLivewire;
use App\Livewire\Erp\TransferenciaAlmacen\TransferenciaAlmacenCrearLivewire;
use App\Livewire\Erp\TransferenciaAlmacen\TransferenciaAlmacenTodasLivewire;
use App\Livewire\Erp\TransferenciaAlmacenDetalle\TransferenciaAlmacenDetalleVerLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', ErpInicioController::class)->name('inicio');

Route::controller(SedeController::class)->group(function () {//ok
    Route::get('sede', 'vistaTodas')->name('sede.vista.todas');
    Route::get('sede/crear', 'vistaCrear')->name('sede.vista.crear');
    Route::post('sede/crear', 'crear')->name('sede.crear');
    Route::get('sede/editar/{id}', 'vistaEditar')->name('sede.vista.editar');
    Route::put('sede/editar/{id}', 'editar')->name('sede.editar');
    Route::delete('sede/eliminar/{id}', 'eliminar')->name('sede.eliminar');
});

Route::controller(TipoDocumentoController::class)->group(function () {//ok
    Route::get('tipo-documento', 'vistaTodas')->name('tipo-documento.vista.todas');
    Route::get('tipo-documento/crear', 'vistaCrear')->name('tipo-documento.vista.crear');
    Route::post('tipo-documento/crear', 'crear')->name('tipo-documento.crear');
    Route::get('tipo-documento/editar/{id}', 'vistaEditar')->name('tipo-documento.vista.editar');
    Route::put('tipo-documento/editar/{id}', 'editar')->name('tipo-documento.editar');
    Route::delete('tipo-documento/eliminar/{id}', 'eliminar')->name('tipo-documento.eliminar');
});

Route::controller(SerieController::class)->group(function () {//ok
    Route::get('serie', 'vistaTodas')->name('serie.vista.todas');
    Route::get('serie/crear', 'vistaCrear')->name('serie.vista.crear');
    Route::post('serie/crear', 'crear')->name('serie.crear');
    Route::get('serie/editar/{id}', 'vistaEditar')->name('serie.vista.editar');
    Route::put('serie/editar/{id}', 'editar')->name('serie.editar');
    Route::delete('serie/eliminar/{id}', 'eliminar')->name('serie.eliminar');
});

Route::controller(AlmacenController::class)->group(function () {//ok
    Route::get('almacen', 'vistaTodas')->name('almacen.vista.todas');
    Route::get('almacen/crear', 'vistaCrear')->name('almacen.vista.crear');
    Route::post('almacen/crear', 'crear')->name('almacen.crear');
    Route::get('almacen/editar/{id}', 'vistaEditar')->name('almacen.vista.editar');
    Route::put('almacen/editar/{id}', 'editar')->name('almacen.editar');
    Route::delete('almacen/eliminar/{id}', 'eliminar')->name('almacen.eliminar');
});

Route::get('/categoria', CategoriaTodasLivewire::class)->name('categoria.vista.todas');//ok

Route::controller(CategoriaController::class)->group(function () {//ok
    //Route::get('categoria', 'vistaTodas')->name('categoria.vista.todas');
    Route::get('categoria/crear', 'vistaCrear')->name('categoria.vista.crear');
    Route::post('categoria/crear', 'crear')->name('categoria.crear');
    Route::get('categoria/editar/{id}', 'vistaEditar')->name('categoria.vista.editar');
    Route::put('categoria/editar/{id}', 'editar')->name('categoria.editar');
    Route::delete('categoria/eliminar/{id}', 'eliminar')->name('categoria.eliminar');
});

Route::controller(SubcategoriaController::class)->group(function () {//ok
    Route::get('subcategoria', 'vistaTodas')->name('subcategoria.vista.todas');
    Route::get('subcategoria/crear', 'vistaCrear')->name('subcategoria.vista.crear');
    Route::post('subcategoria/crear', 'crear')->name('subcategoria.crear');
    Route::get('subcategoria/editar/{id}', 'vistaEditar')->name('subcategoria.vista.editar');
    Route::put('subcategoria/editar/{id}', 'editar')->name('subcategoria.editar');
    Route::delete('subcategoria/eliminar/{id}', 'eliminar')->name('subcategoria.eliminar');
});

Route::controller(MarcaController::class)->group(function () {//ok
    Route::get('marca', 'vistaTodas')->name('marca.vista.todas');
    Route::get('marca/crear', 'vistaCrear')->name('marca.vista.crear');
    Route::post('marca/crear', 'crear')->name('marca.crear');
    Route::get('marca/editar/{id}', 'vistaEditar')->name('marca.vista.editar');
    Route::put('marca/editar/{id}', 'editar')->name('marca.editar');
    Route::delete('marca/eliminar/{id}', 'eliminar')->name('marca.eliminar');
    Route::post('/marca/restaurar/{id}', 'restaurar')->name('marca.restaurar');
});

Route::controller(TallaController::class)->group(function () {//ok
    Route::get('talla', 'vistaTodas')->name('talla.vista.todas');
    Route::get('talla/crear', 'vistaCrear')->name('talla.vista.crear');
    Route::post('talla/crear', 'crear')->name('talla.crear');
    Route::get('talla/editar/{id}', 'vistaEditar')->name('talla.vista.editar');
    Route::put('talla/editar/{id}', 'editar')->name('talla.editar');
    Route::delete('talla/eliminar/{id}', 'eliminar')->name('talla.eliminar');
});

Route::controller(ColorController::class)->group(function () {//ok
    Route::get('color', 'vistaTodas')->name('color.vista.todas');
    Route::get('color/crear', 'vistaCrear')->name('color.vista.crear');
    Route::post('color/crear', 'crear')->name('color.crear');
    Route::get('color/editar/{id}', 'vistaEditar')->name('color.vista.editar');
    Route::put('color/editar/{id}', 'editar')->name('color.editar');
    Route::delete('color/eliminar/{id}', 'eliminar')->name('color.eliminar');
});

Route::controller(ListaPrecioController::class)->group(function () {//ok
    Route::get('lista-precio', 'vistaTodas')->name('lista-precio.vista.todas');
    Route::get('lista-precio/crear', 'vistaCrear')->name('lista-precio.vista.crear');
    Route::post('lista-precio/crear', 'crear')->name('lista-precio.crear');
    Route::get('lista-precio/editar/{id}', 'vistaEditar')->name('lista-precio.vista.editar');
    Route::put('lista-precio/editar/{id}', 'editar')->name('lista-precio.editar');
    Route::delete('lista-precio/eliminar/{id}', 'eliminar')->name('lista-precio.eliminar');
});

Route::get('/imagen', ImagenTodasLivewire::class)->name('imagen.vista.todas');//ok

Route::get('/producto', ProductoTodasLivewire::class)->name('producto.vista.todas');//ok
Route::get('/producto/crear', ProductoCrearLivewire::class)->name('producto.vista.crear');//ok
Route::get('/producto/editar/{id}', ProductoEditarLivewire::class)->name('producto.vista.editar');//ok
Route::get('/producto/variacion/editar/{item}', ProductoVariacionEditarLivewire::class)->name('producto.variacion.vista.editar');//ok
Route::get('/producto/inventario/ver/{id}', ProductoInventarioVerLivewire::class)->name('producto.inventario.vista.ver');//ok
Route::get('/producto/lista-precio/editar/{id}', ProductoListaPrecioEditarLivewire::class)->name('producto.lista-precio.vista.editar');//ok
Route::get('/producto/descuento/editar/{id}', ProductoDescuentoEditarLivewire::class)->name('producto.descuento.vista.editar');//ok

Route::get('/inventario', InventarioTodasLivewire::class)->name('inventario.vista.todas');//ok
Route::get('/inventario-variacion-lista-precio', InventarioVariacionListaPrecioTodasLivewire::class)->name('inventario.variacion-lista-precio.vista.todas');//ok

Route::get('/producto-lista-precio', ProductoListaPrecioTodasLivewire::class)->name('producto-lista-precio.vista.todas');//ok

Route::get('/producto-descuento', ProductoDescuentoTodasLivewire::class)->name('producto-descuento.vista.todas');//ok

Route::get('/guia-entrada-directo', GuiaEntradaDirectoTodasLivewire::class)->name('guia-entrada-directo.vista.todas');//ok
Route::get('/guia-entrada-directo/crear', GuiaEntradaDirectoCrearLivewire::class)->name('guia-entrada-directo.vista.crear');//ok
Route::get('/guia-entrada-directo/{id}/detalle', GuiaEntradaDirectoDetalleVerLivewire::class)->name('guia-entrada-directo-detalle.vista.ver');//ok

Route::get('/transferencia-almacen', TransferenciaAlmacenTodasLivewire::class)->name('transferencia-almacen.vista.todas');//ok
Route::get('/transferencia-almacen/crear', TransferenciaAlmacenCrearLivewire::class)->name('transferencia-almacen.vista.crear');//ok
Route::get('/transferencia-almacen/{id}/detalle', TransferenciaAlmacenDetalleVerLivewire::class)->name('transferencia-almacen-detalle.vista.ver');//ok

Route::get('/guia-salida-directo', GuiaSalidaDirectoTodasLivewire::class)->name('guia-salida-directo.vista.todas');//ok
Route::get('/guia-salida-directo/crear', GuiaSalidaDirectoCrearLivewire::class)->name('guia-salida-directo.vista.crear');//ok
Route::get('/guia-salida-directo/{id}/detalle', GuiaSalidaDirectoDetalleVerLivewire::class)->name('guia-salida-directo-detalle.vista.ver');//ok

Route::get('/plantilla/footer', FooterEditarLivewire::class)->name('plantilla.footer.vista.editar');
Route::controller(ErpFooterController::class)->group(function () {
    Route::put('plantilla/footer', 'set')->name('plantilla.footer.json.set');
    Route::get('plantilla/footer/get', 'get')->name('plantilla.footer.json.get');
});

Route::get('/plantilla/slider/crear', SliderCrearLivewire::class)->name('plantilla.slider.vista.crear');

Route::get('/plantilla/banner/crear', BannerCrearLivewire::class)->name('plantilla.banner.vista.crear');

Route::get('/plantilla/mostrador/crear', MostradorCrearLivewire::class)->name('plantilla.mostrador.vista.crear');

Route::get('/plantilla/grid/crear', GridCrearLivewire::class)->name('plantilla.grid.vista.crear');