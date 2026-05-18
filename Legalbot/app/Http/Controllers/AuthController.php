<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Abogado;

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

    public function me(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        return response()->json([
            'id' => $user->id,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
            'email' => $user->email,
            'rol' => $user->rol,
        ]);
    }

    public function actividadReciente(Request $request)
    {
        $usuarios = User::select(['nombre', 'apellido', 'email'])
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $abogados = Abogado::select(['nombre', 'verificado'])
            ->orderByDesc('id')
            ->limit(2)
            ->get();

        $actividades = [];

        foreach ($usuarios as $usuario) {
            $actividades[] = [
                'id' => 'u_'.$usuario->email,
                'texto' => "Usuario {$usuario->nombre} {$usuario->apellido} se registró",
                'tiempo' => 'Reciente',
                'tipo' => 'blue',
            ];
        }

        foreach ($abogados as $index => $abogado) {
            $status = $abogado->verificado ? 'verificado' : 'pendiente de verificación';
            $actividades[] = [
                'id' => 'a_'.$index,
                'texto' => "Abogado {$abogado->nombre} {$status}",
                'tiempo' => 'Reciente',
                'tipo' => 'green',
            ];
        }

        return response()->json(array_values($actividades));
    }
}
