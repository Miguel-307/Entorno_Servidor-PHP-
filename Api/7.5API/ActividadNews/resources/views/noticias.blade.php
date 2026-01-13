<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 7.5.3 Laravel</title>
</head>
<body>
    <h1>Buscador de Noticias (Laravel)</h1>

    <form action="{{ route('news.buscar') }}" method="POST">
        @csrf <label>Selecciona opción:</label>
        <select name="endpoint">
            <option value="everything">Todo (Tecnología)</option>
            <option value="top-headlines">Titulares (EEUU)</option>
            <option value="sources">Fuentes</option>
        </select>
        <button type="submit">Consultar</button>
    </form>
    
    <hr>

    @if(isset($data))
        
        @if(isset($data['articles']))
            <h2>Resultados (Artículos)</h2>
            <ul>
            @foreach($data['articles'] as $item)
                <li>
                    <h3>{{ $item['title'] }}</h3>
                    <p>Fuente: {{ $item['source']['name'] }}</p>
                    <p>{{ $item['description'] }}</p>
                    <a href="{{ $item['url'] }}" target="_blank">Leer más</a>
                </li>
                <br>
            @endforeach
            </ul>

        @elseif(isset($data['sources']))
            <h2>Resultados (Fuentes)</h2>
            <ul>
            @foreach($data['sources'] as $item)
                <li>
                    <h3>{{ $item['name'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                    <a href="{{ $item['url'] }}" target="_blank">Ir a la web</a>
                </li>
                <br>
            @endforeach
            </ul>
        @endif

    @endif
</body>
</html>