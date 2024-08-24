<?php

use App\Http\Controllers\Comprador\CompradorCarritoController;
use App\Http\Controllers\Comprador\CompradorDireccionController;
use App\Http\Controllers\Comprador\CompradorFavoritoController;
use App\Http\Controllers\Comprador\CompradorPagarController;
use App\Http\Controllers\Comprador\CompradorPerfilController;
use App\Http\Controllers\Comprador\CompradorReembolsoController;
use Illuminate\Support\Facades\Route;

Route::controller(CompradorPerfilController::class)->group(function () {
    Route::get('/', 'ver')->name('perfil.vista.ver');
});

Route::controller(CompradorDireccionController::class)->group(function () {
    Route::get('direccion', 'ver')->name('direccion.vista.ver');
});

Route::controller(CompradorCarritoController::class)->group(function () {
    Route::get('carrito', 'ver')->name('carrito.vista.ver');
});

Route::controller(CompradorFavoritoController::class)->group(function () {
    Route::get('/favorito', 'ver')->name('favorito.vista.ver');
});

Route::controller(CompradorReembolsoController::class)->group(function () {
    Route::get('/reembolso', 'ver')->name('reembolso.vista.ver');
});

Route::controller(CompradorPagarController::class)->group(function () {
    Route::get('/pagar', 'ver')->name('pagar.vista.ver');
});