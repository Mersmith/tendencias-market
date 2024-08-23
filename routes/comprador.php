<?php

use App\Http\Controllers\Comprador\CompradorCarritoController;
use App\Http\Controllers\Comprador\CompradorPerfilController;
use Illuminate\Support\Facades\Route;

Route::controller(CompradorPerfilController::class)->group(function () {
    Route::get('/', 'ver')->name('perfil.vista.ver');
    Route::put('/', 'actualizar')->name('perfil.actualizar');
});

Route::controller(CompradorCarritoController::class)->group(function () {
    Route::get('carrito', 'ver')->name('carrito.vista.ver');
    Route::post('carrito/detalle/{id}/eliminar', 'eliminarDetalle')->name('carrito.detalle.eliminar');
    Route::post('carrito/detalle/{id}/actualizar', 'actualizarCantidad')->name('carrito.detalle.actualizar');
});