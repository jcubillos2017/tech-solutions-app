<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::resource('proyectos', ProyectoController::class);

// redireccion para que la ruta raiz del sitio vaya al listado de proyectos.
Route::get('/', function () {
    return redirect()->route('proyectos.index');
});
