<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\Erp\Inicio\ErpInicioController;
use App\Http\Controllers\Erp\Marca\MarcaController;
use App\Http\Controllers\TallaController;
use Illuminate\Support\Facades\Route;

Route::get('/', ErpInicioController::class)->name('inicio');

Route::controller(MarcaController::class)->group(function () {
    Route::get('marca', 'vistaTodas')->name('marca.vista.todas');
    Route::get('marca/crear', 'vistaCrear')->name('marca.vista.crear');
    Route::post('marca/crear', 'crear')->name('marca.crear');
    Route::get('marca/editar/{id}', 'vistaEditar')->name('marca.vista.editar');
    Route::put('marca/editar/{id}', 'editar')->name('marca.editar');
    Route::delete('marca/eliminar/{id}', 'eliminar')->name('marca.eliminar');
});

Route::controller(CategoriaController::class)->group(function () {
    Route::get('categoria', 'vistaTodas')->name('categoria.vista.todas');
    Route::get('categoria/crear', 'vistaCrear')->name('categoria.vista.crear');
    Route::post('categoria/crear', 'crear')->name('categoria.crear');
    Route::get('categoria/editar/{id}', 'vistaEditar')->name('categoria.vista.editar');
    Route::put('categoria/editar/{id}', 'editar')->name('categoria.editar');
    Route::delete('categoria/eliminar/{id}', 'eliminar')->name('categoria.eliminar');
});

Route::controller(TallaController::class)->group(function () {
    Route::get('talla', 'vistaTodas')->name('talla.vista.todas');
    Route::get('talla/crear', 'vistaCrear')->name('talla.vista.crear');
    Route::post('talla/crear', 'crear')->name('talla.crear');
    Route::get('talla/editar/{id}', 'vistaEditar')->name('talla.vista.editar');
    Route::put('talla/editar/{id}', 'editar')->name('talla.editar');
    Route::delete('talla/eliminar/{id}', 'eliminar')->name('talla.eliminar');
});

Route::controller(ColorController::class)->group(function () {
    Route::get('color', 'vistaTodas')->name('color.vista.todas');
    Route::get('color/crear', 'vistaCrear')->name('color.vista.crear');
    Route::post('color/crear', 'crear')->name('color.crear');
    Route::get('color/editar/{id}', 'vistaEditar')->name('color.vista.editar');
    Route::put('color/editar/{id}', 'editar')->name('color.editar');
    Route::delete('color/eliminar/{id}', 'eliminar')->name('color.eliminar');
});