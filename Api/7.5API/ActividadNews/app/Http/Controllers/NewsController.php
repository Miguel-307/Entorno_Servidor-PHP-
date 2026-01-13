<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsService; // Importamos nuestro modelo

class NewsController extends Controller
{
    public function index()
    {
        // Muestra la vista vacía al entrar
        return view('noticias');
    }

    public function buscar(Request $request)
    {
        $tipo = $request->input('endpoint');
        
        // Instanciamos el modelo y pedimos los datos
        $servicio = new NewsService();
        $datos = $servicio->obtenerDatos($tipo);

        // Devolvemos la vista con los datos
        return view('noticias', [
            'data' => $datos, 
            'tipoSeleccionado' => $tipo
        ]);
    }
}