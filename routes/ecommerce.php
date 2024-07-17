<?php

use App\Http\Controllers\Ecommerce\Inicio\EcommerceInicioController;
use App\Livewire\Ecommerce\Producto\ProductoVerLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', EcommerceInicioController::class)->name('inicio');

Route::get('/product/{id}/{slug?}', ProductoVerLivewire::class)->name('producto.vista.ver');
