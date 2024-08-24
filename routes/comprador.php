<?php

use App\Http\Controllers\Comprador\CompradorCarritoController;
use App\Http\Controllers\Comprador\CompradorDireccionController;
use App\Http\Controllers\Comprador\CompradorFavoritoController;
use App\Http\Controllers\Comprador\CompradorPerfilController;
use Illuminate\Support\Facades\Route;

Route::controller(CompradorPerfilController::class)->group(function () {
    Route::get('/', 'ver')->name('perfil.vista.ver');
    //Route::put('/', 'actualizar')->name('perfil.actualizar');
});

Route::controller(CompradorDireccionController::class)->group(function () {
    Route::get('direccion', 'ver')->name('direccion.vista.ver');
});

Route::controller(CompradorCarritoController::class)->group(function () {
    Route::get('carrito', 'ver')->name('carrito.vista.ver');
    //Route::post('carrito/detalle/{id}/eliminar', 'eliminarDetalle')->name('carrito.detalle.eliminar');
    //Route::post('carrito/detalle/{id}/actualizar', 'actualizarCantidad')->name('carrito.detalle.actualizar');
});

Route::controller(CompradorFavoritoController::class)->group(function () {
    Route::get('/favorito', 'ver')->name('favorito.vista.ver');
});