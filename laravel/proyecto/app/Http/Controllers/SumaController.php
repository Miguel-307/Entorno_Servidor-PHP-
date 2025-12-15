<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SumaController extends Controller
{
    // Muestra el formulario vacío cuando entras a la página
    public function index()
    {
        return view('suma');
    }

    // Recibe los datos, SUMA y devuelve el resultado
    public function suma(Request $request)
    {
        // 1. Capturamos los números que escribiste en el formulario
        $num1 = $request->input('num1');
        $num2 = $request->input('num2');

        // 2. Hacemos la operación matemática
        $resultado = $num1 + $num2;

        // 3. Retornamos la vista 'suma' pero enviándole la variable $resultado
        return view('suma', ['resultado' => $resultado]);
    }
}