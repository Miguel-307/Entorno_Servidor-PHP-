<?php

use App\Http\Controllers\CalculadoraController;
use Illuminate\Support\Facades\Route;

// Ruta de bienvenida (la página principal de Laravel)
Route::get('/', function () {
    return view('welcome');
});

// Ruta para la página de inicio
Route::get('/inicio', function () {
    return view('inicio');
});

// Ruta para mostrar el formulario de suma
Route::get('/suma', function () {
    return view('suma');
});

Route::get('/calculadora', [CalculadoraController::class, 'index'])
    ->name('calculadora.index');

Route::post('/calculadora', [CalculadoraController::class, 'calcular'])
    ->name('calculadora.calcular');