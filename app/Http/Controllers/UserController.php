<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Registra un nuevo usuario en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Confirmación de la contraseña
        ]);

        // Si la validación falla, devolver los errores
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        // Crear un nuevo usuario
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash de la contraseña
        ]);

        // Responder con el usuario recién creado
        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user
        ], 201);
    }

    /**
     * Método para obtener el perfil del usuario autenticado.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserProfile()
    {
        // Obtener al usuario autenticado
        $user = auth()->user();

        // Si el usuario está autenticado, devolver su perfil
        if ($user) {
            return response()->json([
                'user' => $user
            ], 200);
        }

        // Si no hay un usuario autenticado
        return response()->json([
            'message' => 'Usuario no autenticado'
        ], 401);
    }
}