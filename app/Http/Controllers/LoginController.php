<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;

class LoginController extends Controller
{
    /**
     * Maneja el inicio de sesión del usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Si la validación falla, devolver los errores
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // Obtener al usuario autenticado

            // Responder con los datos del usuario si la autenticación es exitosa
            return response()->json([
                'message' => 'Usuario autenticado exitosamente',
                'user' => $user
            ], 200);
        }

        // Si las credenciales son incorrectas, devolver un error
        return response()->json([
            'message' => 'Credenciales inválidas'
        ], 401);
    }

    /**
     * Método para obtener el perfil del usuario autenticado.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserProfile()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'user' => $user
            ], 200);
        }

        return response()->json([
            'message' => 'Usuario no autenticado'
        ], 401);
    }
}