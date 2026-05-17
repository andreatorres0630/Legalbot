<?php

namespace App\Http\Controllers;

use App\Models\Abogado;
use App\Models\EspecialidadLegal;
use Illuminate\Http\Request;

class AbogadoController extends Controller
{
    public function index()
    {
        $abogados = Abogado::with('especialidadLegal')->get()->map(function ($abogado) {
            return [
                'id' => $abogado->id,
                'nombre' => $abogado->nombre,
                'especialidad' => $abogado->especialidadLegal?->nombre ?? '',
                'telefono' => $abogado->telefono,
                'whatsapp' => $abogado->whatsapp,
                'correo' => $abogado->email,
                'direccion' => $abogado->direccion,
                'disponible' => (bool) $abogado->disponible,
                'verificado' => (bool) $abogado->verificado,
                'estado' => $abogado->disponible ? 'Activo' : 'Inactivo',
                'verificado_label' => $abogado->verificado ? 'Sí' : 'No',
            ];
        });

        return response()->json($abogados);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'especialidad' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'correo' => 'nullable|string|email|max:150',
            'direccion' => 'nullable|string|max:250',
            'disponible' => 'required|boolean',
            'verificado' => 'required|boolean',
        ]);

        $especialidad = EspecialidadLegal::firstOrCreate([
            'nombre' => trim($data['especialidad']),
        ], [
            'descripcion' => '',
        ]);

        $abogado = Abogado::create([
            'nombre' => $data['nombre'],
            'especialidad_id' => $especialidad->id,
            'telefono' => $data['telefono'],
            'whatsapp' => $data['whatsapp'] ?? '',
            'email' => $data['correo'] ?? '',
            'direccion' => $data['direccion'] ?? '',
            'disponible' => $data['disponible'],
            'verificado' => $data['verificado'],
        ]);

        return response()->json([
            'id' => $abogado->id,
            'nombre' => $abogado->nombre,
            'especialidad' => $especialidad->nombre,
            'telefono' => $abogado->telefono,
            'whatsapp' => $abogado->whatsapp,
            'correo' => $abogado->email,
            'direccion' => $abogado->direccion,
            'disponible' => (bool) $abogado->disponible,
            'verificado' => (bool) $abogado->verificado,
            'estado' => $abogado->disponible ? 'Activo' : 'Inactivo',
        ], 201);
    }

    public function update(Request $request, Abogado $abogado)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'especialidad' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'correo' => 'nullable|string|email|max:150',
            'direccion' => 'nullable|string|max:250',
            'disponible' => 'required|boolean',
            'verificado' => 'required|boolean',
        ]);

        $especialidad = EspecialidadLegal::firstOrCreate([
            'nombre' => trim($data['especialidad']),
        ], [
            'descripcion' => '',
        ]);

        $abogado->update([
            'nombre' => $data['nombre'],
            'especialidad_id' => $especialidad->id,
            'telefono' => $data['telefono'],
            'whatsapp' => $data['whatsapp'] ?? '',
            'email' => $data['correo'] ?? '',
            'direccion' => $data['direccion'] ?? '',
            'disponible' => $data['disponible'],
            'verificado' => $data['verificado'],
        ]);

        return response()->json([
            'id' => $abogado->id,
            'nombre' => $abogado->nombre,
            'especialidad' => $especialidad->nombre,
            'telefono' => $abogado->telefono,
            'whatsapp' => $abogado->whatsapp,
            'correo' => $abogado->email,
            'direccion' => $abogado->direccion,
            'disponible' => (bool) $abogado->disponible,
            'verificado' => (bool) $abogado->verificado,
            'estado' => $abogado->disponible ? 'Activo' : 'Inactivo',
        ]);
    }

    public function destroy(Abogado $abogado)
    {
        $abogado->delete();

        return response()->json(['message' => 'Abogado eliminado correctamente']);
    }
}
