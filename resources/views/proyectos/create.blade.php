@extends('layouts.app')

@section('content')
    <h2>Crear Nuevo Proyecto</h2>

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf <div class="form-group">
            <label for="nombre">Nombre del Proyecto</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" value="Planificado" required>
        </div>
        <div class="form-group">
            <label for="responsable">Responsable</label>
            <input type="text" name="responsable" id="responsable" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" name="monto" id="monto" step="0.01" required>
        </div>
        
        <button type="submit" class="btn btn-success">Guardar Proyecto</button>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection