<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Simple</title>
</head>
<body>

<div class="card">
    <h2>Calculadora</h2>

    <form action="{{ route('calculadora.calcular') }}" method="POST">
        @csrf

        <label>Número 1</label>
        <input type="number" step="any" name="num1" value="{{ old('num1', $num1 ?? '') }}" required>

        <label>Operación</label>
        <select name="op" required>
            <option value="+" {{ (old('op', $op ?? '')=='+') ? 'selected' : '' }}>Suma (+)</option>
            <option value="-" {{ (old('op', $op ?? '')=='-') ? 'selected' : '' }}>Resta (-)</option>
            <option value="*" {{ (old('op', $op ?? '')=='*') ? 'selected' : '' }}>Multiplica (*)</option>
            <option value="/" {{ (old('op', $op ?? '')=='/') ? 'selected' : '' }}>Divide (/)</option>
        </select>

        <label>Número 2</label>
        <input type="number" step="any" name="num2" value="{{ old('num2', $num2 ?? '') }}" required>

        <button type="submit">Calcular</button>
    </form>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $e)
                <p>{{ $e }}</p>
            @endforeach
        </div>
    @endif

    {{-- Error lógico (división entre 0) --}}
    @if (!empty($error))
        <div class="error">{{ $error }}</div>
    @endif

    {{-- Resultado --}}
    @isset($resultado)
        <div class="result">
            <strong>Resultado:</strong> {{ $resultado }}
        </div>
    @endisset
</div>

</body>
</html>
