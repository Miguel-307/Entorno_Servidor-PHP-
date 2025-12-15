<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function index()
    {
        return view('calculadora');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric',
            'op'   => 'required|in:+,-,*,/'
        ]);

        $num1 = $request->num1;
        $num2 = $request->num2;
        $op   = $request->op;

        $resultado = null;
        $error = null;

        switch ($op) {
            case '+': $resultado = $num1 + $num2; break;
            case '-': $resultado = $num1 - $num2; break;
            case '*': $resultado = $num1 * $num2; break;
            case '/':
                if ($num2 == 0) $error = "No se puede dividir entre 0";
                else $resultado = $num1 / $num2;
                break;
        }

        return view('calculadora', compact('resultado','error','num1','num2','op'));
    }
}
