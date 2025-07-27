@extends('layouts.app')

@section('content')
    <h2>Listado de Proyectos</h2>
    <a href="{{ route('proyectos.create') }}" class="btn btn-primary">Agregar Nuevo Proyecto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de Inicio</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto['id'] }}</td>
                    <td>{{ $proyecto['nombre'] }}</td>
                    <td>{{ $proyecto['fecha_inicio'] }}</td>
                    <td>{{ $proyecto['estado'] }}</td>
                    <td>{{ $proyecto['responsable'] }}</td>
                    <td>{{ $proyecto['monto'] }}</td>
                    <td>




                        <a href="{{ route('proyectos.show', $proyecto['id']) }}"
                            class="btn btn-secondary dropdown-toggle">Ver</a>
                        <a href="{{ route('proyectos.edit', $proyecto['id']) }}" class="btn btn-primary">Editar</a>

                        <form action="{{ route('proyectos.destroy', $proyecto['id']) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay proyectos para mostrar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
