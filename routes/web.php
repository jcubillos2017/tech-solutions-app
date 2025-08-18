<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::resource('proyectos', ProyectoController::class);

// redireccion para que la ruta raiz del sitio vaya al listado de proyectos.
Route::get('/', function () {
    return redirect()->route('proyectos.index');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', function () {
    return view('auth.login');
});