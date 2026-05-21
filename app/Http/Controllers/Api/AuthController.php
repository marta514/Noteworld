<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validamos que envíen correo y contraseña
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Buscamos al usuario en la base de datos
        $user = User::where('email', $request->email)->first();

        // 3. Verificamos que exista y que la contraseña coincida
        if (! $user || ! Hash::check($request->password, $user->password)) {
            // Código 401: No autorizado
            return response()->json([
                'success' => false,
                'message' => 'Las credenciales son incorrectas.'
            ], 401);
        }

        // 4. ¡GENERAMOS EL TOKEN REAL!
        $token = $user->createToken('API Token de ' . $user->name)->plainTextToken;

        // 5. Devolvemos el token al usuario
        return response()->json([
            'success' => true,
            'message' => 'Login exitoso',
            'token' => $token, // Aquí viaja el token real
            'user' => $user
        ], 200);
    }
}