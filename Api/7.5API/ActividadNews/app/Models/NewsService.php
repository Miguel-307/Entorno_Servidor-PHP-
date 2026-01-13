<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class NewsService
{

    
    public function obtenerDatos($tipo)
    {
        $apiKey = env('NEWS_API_KEY'); 
        $baseUrl = 'https://newsapi.org/v2';
        $url = '';

      
        switch ($tipo) {
            case 'everything':
                $url = "$baseUrl/everything?q=tecnologia&apiKey=$apiKey";
                break;
            case 'top-headlines':
                $url = "$baseUrl/top-headlines?country=us&apiKey=$apiKey";
                break;
            case 'sources':
                $url = "$baseUrl/top-headlines/sources?apiKey=$apiKey";
                break;
            default:
                return null;
        }

        
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}