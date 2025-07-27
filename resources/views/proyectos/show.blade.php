@extends('layouts.app')

@section('content')
    <h2>Detalle del Proyecto</h2>
    
    <p><strong>ID:</strong> {{ $proyecto['id'] }}</p>
    <p><strong>Nombre:</strong> {{ $proyecto['nombre'] }}</p>
    <p><strong>Fecha de Inicio:</strong> {{ $proyecto['fecha_inicio'] }}</p>
    <p><strong>Estado:</strong> {{ $proyecto['estado'] }}</p>
    <p><strong>Responsable:</strong> {{ $proyecto['responsable'] }}</p>
    <p><strong>Monto:</strong> ${{ number_format($proyecto['monto'], 2) }}</p>

    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver al Listado</a>
@endsection