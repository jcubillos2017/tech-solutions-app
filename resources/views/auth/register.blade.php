@extends('layouts.app')

@section('content')
<h2>Registro de Usuario</h2>
<form action="/api/register" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="password">Clave</label>
        <input type="password" name="password" id="password" required minlength="8">
    </div>
    <button type="submit" class="btn btn-primary">Registrarse</button>
</form>
@endsection