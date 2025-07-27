@extends('layouts.app')

@section('content')
    <h2>Editar Proyecto: {{ $proyecto['nombre'] }}</h2>

    <form action="{{ route('proyectos.update', $proyecto['id']) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="nombre">Nombre del Proyecto</label>
            <input type="text" name="nombre" id="nombre" value="{{ $proyecto['nombre'] }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ $proyecto['fecha_inicio'] }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" value="{{ $proyecto['estado'] }}" required>
        </div>
        <div class="form-group">
            <label for="responsable">Responsable</label>
            <input type="text" name="responsable" id="responsable" value="{{ $proyecto['responsable'] }}" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" name="monto" id="monto" step="0.01" value="{{ $proyecto['monto'] }}" required>
        </div>
        
        <button type="submit" class="btn btn-success">Actualizar Proyecto</button>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection