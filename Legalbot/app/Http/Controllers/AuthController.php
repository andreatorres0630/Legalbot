<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
   public function login(Request $request)
{
    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['error' => 'El correo no existe en la BD'], 404);
    }

    if (\Illuminate\Support\Facades\Hash::check($request->password, $user->password_hash)) {
        Auth::login($user);
        return response()->json(['redirect' => $user->rol === 'admin' ? '/dashboard' : '/inicio']);
    }

    return response()->json([
        'error' => 'La contraseña no coincide con el hash de la BD',
        'enviada' => $request->password,
        'hash_en_bd' => $user->password_hash
    ], 401);
}

    public function register(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuario',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'password_hash' => Hash::make($request->password),
                'rol' => 'ciudadano',
            ]);

            return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar: ' . $e->getMessage()], 400);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['redirect' => '/login']);
    }
  
}