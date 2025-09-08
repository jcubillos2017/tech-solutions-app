<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    public function index()
    {
        // Se especifica el guardia 'api'
        $proyectos = Proyecto::where('created_by', auth()->guard('api')->user()->id)->get();
        return response()->json($proyectos);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string|max:100',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $proyecto = Proyecto::create(array_merge(
            $validator->validated(),
            // Se especifica el guardia 'api'
            ['created_by' => auth()->guard('api')->user()->id] 
        ));

        return response()->json($proyecto, 201);
    }

    public function show($id)
    {

        
        // Se especifica el guardia 'api'
        $proyecto = Proyecto::where('created_by', auth()->guard('api')->user()->id)->where('id', $id)->firstOrFail();
        return response()->json($proyecto);
    }

    public function update(Request $request, $id)
    {
        // Se especifica el guardia 'api'
        $proyecto = Proyecto::where('created_by', auth()->guard('api')->user()->id)->where('id', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:255',
            'fecha_inicio' => 'date',
            'estado' => 'string|max:100',
            'responsable' => 'string|max:255',
            'monto' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $proyecto->update($validator->validated());
        return response()->json($proyecto);
    }

    public function destroy($id)
    {
        // Se especifica el guardia 'api'
        $proyecto = Proyecto::where('created_by', auth()->guard('api')->user()->id)->where('id', $id)->firstOrFail();
        $proyecto->delete();
        return response()->noContent();
    }
}