<?php

use App\Http\Controllers\Erp\Inicio\ErpInicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', ErpInicioController::class)->name('inicio');
