<?php

use App\Http\Controllers\Comprador\CompradorCarritoController;
use App\Http\Controllers\Sesion\AdminController;
use App\Http\Controllers\Sesion\CompradorController;
use App\Http\Controllers\Sesion\VendedorController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('admin/login', 'ver')->name('admin.login.vista.ver');
    Route::post('admin/login', 'login')->name('admin.login.ingresar');
});

Route::controller(VendedorController::class)->group(function () {
    Route::get('vendedor/login', 'ver')->name('vendedor.login.vista.ver');
    Route::post('vendedor/login', 'login')->name('vendedor.login.ingresar');
});

Route::controller(CompradorController::class)->group(function () {
    Route::get('comprador/login', 'ver')->name('comprador.login.vista.ver');
    Route::post('comprador/login', 'login')->name('comprador.login.ingresar');
});

Route::get('/cart', CompradorCarritoController::class)->name('carrito.vista.ver');
