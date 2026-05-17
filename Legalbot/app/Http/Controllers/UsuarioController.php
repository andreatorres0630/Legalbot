<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsuarioController extends Controller
{
    public function index()
    {
        $query = User::select(['id', 'nombre', 'apellido', 'email', 'telefono', 'rol']);

        if (Schema::hasColumn('usuario', 'estado')) {
            $query->addSelect('estado');
        }

        $usuarios = $query->get()->map(function ($usuario) {
            $usuario = $usuario->toArray();
            if (!array_key_exists('estado', $usuario) || $usuario['estado'] === null) {
                $usuario['estado'] = 'Activo';
            }
            return $usuario;
        });

        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'nullable|string|max:100',
            'email' => 'required|string|email|max:150|unique:usuario,email',
            'telefono' => 'nullable|string|max:20',
            'rol' => 'required|string|max:50',
            'password' => 'nullable|string|min:8',
            'estado' => 'nullable|string|max:50',
        ]);

        $usuario = new User();
        $usuario->nombre = $data['nombre'];
        $usuario->apellido = $data['apellido'] ?? '';
        $usuario->email = $data['email'];
        $usuario->telefono = $data['telefono'] ?? '';
        $usuario->rol = $data['rol'];
        $usuario->password_hash = Hash::make($data['password'] ?? 'Legalbot123');

        if (Schema::hasColumn('usuario', 'estado')) {
            $usuario->estado = $data['estado'] ?? 'Activo';
        }

        $usuario->save();

        return response()->json($usuario, 201);
    }

    public function update(Request $request, User $usuario)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'nullable|string|max:100',
            'email' => 'required|string|email|max:150|unique:usuario,email,' . $usuario->id,
            'telefono' => 'nullable|string|max:20',
            'rol' => 'required|string|max:50',
            'password' => 'nullable|string|min:8',
            'estado' => 'nullable|string|max:50',
        ]);

        $usuario->nombre = $data['nombre'];
        $usuario->apellido = $data['apellido'] ?? '';
        $usuario->email = $data['email'];
        $usuario->telefono = $data['telefono'] ?? '';
        $usuario->rol = $data['rol'];

        if (!empty($data['password'])) {
            $usuario->password_hash = Hash::make($data['password']);
        }

        if (Schema::hasColumn('usuario', 'estado')) {
            $usuario->estado = $data['estado'] ?? 'Activo';
        }

        $usuario->save();

        return response()->json($usuario);
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
