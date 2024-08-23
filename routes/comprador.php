<?php

use App\Http\Controllers\Comprador\CompradorCarritoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "COMPRADOR";
})->name('inicio');


Route::controller(CompradorCarritoController::class)->group(function () {
    Route::get('carrito', 'ver')->name('carrito.vista.ver');
    Route::post('carrito/detalle/{id}/eliminar', 'eliminarDetalle')->name('carrito.detalle.eliminar');
    Route::post('carrito/detalle/{id}/actualizar', 'actualizarCantidad')->name('carrito.detalle.actualizar');
});