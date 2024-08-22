<?php

use App\Http\Controllers\Ecommerce\Inicio\EcommerceInicioController;
use App\Http\Controllers\Ecommerce\Producto\EcommerceProductoController;
use App\Livewire\Ecommerce\Categoria\CategoriaVerLivewire;
use App\Livewire\Ecommerce\Marca\MarcaVerLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', EcommerceInicioController::class)->name('inicio');

Route::get('/product/{id}/{slug?}', EcommerceProductoController::class)->name('producto.vista.ver');

Route::get('/category/{id}/{slug?}', CategoriaVerLivewire::class)->name('categoria.vista.ver');

Route::get('/brand/{slug}', MarcaVerLivewire::class)->name('marca.vista.ver');
