@extends('layouts.app')

@section('content')
<h2>Inicio de Sesión</h2>
<form action="/api/login" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="password">Clave</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-success">Iniciar Sesión</button>
</form>
@endsection