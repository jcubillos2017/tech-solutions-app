<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProyectoController extends Controller
{
    public function __construct()
    {
        // VERIFICAMOS SI LA SESIÓN YA TIENE LOS PROYECTOS
        if (!session()->has('proyectos')) {
            // Si no los tiene (es la primera visita), creamos la colección inicial
            $proyectos = new Collection([
                ['id' => 1, 'nombre' => 'Modernización del Sistema de Ventas', 'fecha_inicio' => '2025-01-15', 'estado' => 'En progreso', 'responsable' => 'Ana Martínez', 'monto' => 120000.00],
                ['id' => 2, 'nombre' => 'Desarrollo de App Móvil', 'fecha_inicio' => '2025-03-01', 'estado' => 'Completado', 'responsable' => 'Carlos Rodriguez', 'monto' => 75000.50],
                ['id' => 3, 'nombre' => 'Migración a Servidores Cloud', 'fecha_inicio' => '2025-07-20', 'estado' => 'Planificado', 'responsable' => 'Sofía Gonzalez', 'monto' => 250000.00],
            ]);
            // Y la guardamos en la sesión
            session(['proyectos' => $proyectos]);
        }
    }

    /**
     * 1. Listar todos los proyectos (desde la sesión).
     */
    public function index()
    {
        // Obtenemos los datos directamente desde la sesión
        $proyectos = session('proyectos');
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto.
     */
    public function create()
    {
        return view('proyectos.create');
    }

    /**
     * 2. Agrega un proyecto nuevo (en la sesión).
     */
    public function store(Request $request)
    {
        // Obtenemos los proyectos actuales de la sesión
        $proyectos = session('proyectos');

        // Creamos un ID nuevo y único
        $newId = $proyectos->max('id') + 1;

        // Creamos el nuevo proyecto
        $nuevoProyecto = [
            'id' => $newId,
            'nombre' => $request->input('nombre'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'estado' => $request->input('estado'),
            'responsable' => $request->input('responsable'),
            'monto' => (float) $request->input('monto'),
        ];

        // Añadimos el nuevo proyecto a la colección
        $proyectos->push($nuevoProyecto);

        // Guardamos la colección actualizada de vuelta en la sesión
        session(['proyectos' => $proyectos]);

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto agregado exitosamente (temporalmente).');
    }

    /**
     * 5. Obtener un proyecto por su id (de la sesión).
     */
    public function show($id)
    {
        $proyectos = session('proyectos');
        $proyecto = $proyectos->firstWhere('id', $id);

        if (!$proyecto) {
            abort(404);
        }

        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Muestra el formulario para editar un proyecto.
     */
    public function edit($id)
    {
        $proyectos = session('proyectos');
        $proyecto = $proyectos->firstWhere('id', $id);
        if (!$proyecto) {
            abort(404);
        }
        return view('proyectos.edit', compact('proyecto'));
    }



    /* 4. Actualiza un proyecto por id (en la sesión).  */
    public function update(Request $request, $id)
    {
        $proyectos = session('proyectos');

        // Buscamos el índice del proyecto a actualizar
        $index = $proyectos->search(function ($proyecto) use ($id) {
            return $proyecto['id'] == $id;
        });

        // Si encontramos el proyecto, procedemos a actualizar
        if ($index !== false) {
            // Creamos un array con los datos actualizados del proyecto
            $proyectoActualizado = [
                'id' => (int)$id, // Mantenemos el ID original
                'nombre' => $request->input('nombre'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'estado' => $request->input('estado'),
                'responsable' => $request->input('responsable'),
                'monto' => (float) $request->input('monto'),
            ];

            // Reemplazamos el elemento antiguo con el nuevo en la colección
            $proyectos->put($index, $proyectoActualizado);

            // Guardamos la colección actualizada en la sesión
            session(['proyectos' => $proyectos]);
        }

        return redirect()->route('proyectos.index')
            ->with('success', "Proyecto ID: {$id} actualizado exitosamente (temporalmente).");
    }



    /**
     * 3. Elimina un proyecto por id (de la sesión).
     */
    public function destroy($id)
    {
        $proyectos = session('proyectos');

        // Filtramos la colección para remover el proyecto con el id correspondiente
        $proyectosActualizados = $proyectos->reject(function ($proyecto) use ($id) {
            return $proyecto['id'] == $id;
        })->values(); // values() re-indexa el array

        // Guardamos la nueva colección sin el elemento borrado
        session(['proyectos' => $proyectosActualizados]);

        return redirect()->route('proyectos.index')
            ->with('success', "Proyecto ID: {$id} eliminado exitosamente (temporalmente).");
    }
}
