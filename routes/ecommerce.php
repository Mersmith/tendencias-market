<?php

use App\Http\Controllers\Ecommerce\Inicio\EcommerceInicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', EcommerceInicioController::class)->name('inicio');
