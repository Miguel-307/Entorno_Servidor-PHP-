@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header bg-dark text-white">
        <h3 class="mb-0">Calculadora Laravel</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('calculadora.calcular') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="num1" class="form-label">Número 1</label>
                <input type="number" step="any" name="num1" class="form-control" required value="{{ $num1 ?? '' }}">
            </div>

            <div class="mb-3">
                <label for="num2" class="form-label">Número 2</label>
                <input type="number" step="any" name="num2" class="form-control" required value="{{ $num2 ?? '' }}">
            </div>

            <div class="mb-3">
                <label for="operacion" class="form-label">Operación</label>
                <select name="operacion" class="form-select">
                    <option value="suma" {{ (isset($operacion_seleccionada) && $operacion_seleccionada == 'suma') ? 'selected' : '' }}>Suma (+)</option>
                    <option value="resta" {{ (isset($operacion_seleccionada) && $operacion_seleccionada == 'resta') ? 'selected' : '' }}>Resta (-)</option>
                    <option value="multiplicacion" {{ (isset($operacion_seleccionada) && $operacion_seleccionada == 'multiplicacion') ? 'selected' : '' }}>Multiplicación (x)</option>
                    <option value="division" {{ (isset($operacion_seleccionada) && $operacion_seleccionada == 'division') ? 'selected' : '' }}>División (/)</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Calcular</button>
            </div>
        </form>

        @if(isset($resultado))
            <div class="alert alert-success mt-4 text-center">
                <h4>Resultado: {{ $resultado }}</h4>
            </div>
        @endif
    </div>
</div>
@endsection