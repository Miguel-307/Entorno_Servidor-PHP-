<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

// Ruta para ver el formulario (GET)
Route::get('/', [NewsController::class, 'index']);

// Ruta para procesar el formulario (POST)
Route::post('/buscar', [NewsController::class, 'buscar'])->name('news.buscar');