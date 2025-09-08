<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Función de Registro de Usuario.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Cifrado de la clave
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user
        ]);
    }

    /**
     * Función de Inicio de Sesión.
     */
    
    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $credentials = $request->only('email', 'password');

    if (! $token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'No autorizado'], 401);
    }


    //si las credenciales son correctas, devuelve el JWT
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
    //   'expires_in' => auth('api')->manager()->getTTL() * 60
     ]);
    }
}