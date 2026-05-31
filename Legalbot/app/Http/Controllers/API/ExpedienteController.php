<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expediente;
use App\Services\ExpedienteService;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function __construct(private ExpedienteService $service) {}

    // GET /api/expedientes — lista del usuario autenticado
    public function index()
    {
        $expedientes = Expediente::where('usuario_id', auth()->id())
            ->orderByDesc('apertura')
            ->get();

        return response()->json($expedientes);
    }

    // POST /api/expedientes — crear con código único
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'nullable|string|max:500',
        ]);

        $expediente = $this->service->crearExpediente(
            auth()->id(),
            $request->descripcion ?? ''
        );

        return response()->json($expediente, 201);
    }

    // GET /api/expedientes/{numero} — detalle por número alfanumérico (nunca por ID)
    public function show(string $numero)
    {
        $expediente = Expediente::where('numero', $numero)
            ->where('usuario_id', auth()->id())
            ->firstOrFail();

        return response()->json($expediente);
    }

    // PATCH /api/expedientes/{numero}/estado — cambiar estado
    public function updateEstado(Request $request, string $numero)
    {
        $request->validate([
            'estado' => 'required|in:abierto,en_proceso,resuelto,cerrado',
        ]);

        $expediente = Expediente::where('numero', $numero)
            ->where('usuario_id', auth()->id())
            ->firstOrFail();

        $expediente->estado = $request->estado;

        // El servidor pone la fecha, nunca el cliente
        $expediente->cierre = $request->estado === 'cerrado' ? now() : null;
        $expediente->save();

        return response()->json($expediente);
    }

    // GET /api/expedientes/{numero}/historial
    public function historial(string $numero)
    {
        $expediente = Expediente::where('numero', $numero)
            ->where('usuario_id', auth()->id())
            ->first();

        // Si no pertenece al usuario: 403, nunca los datos
        if (!$expediente) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        // Cadena real de tu BD: expediente → consulta → mensaje_consulta
        $consultas = $expediente->consultas()
            ->with(['mensajes' => function ($q) {
                $q->orderBy('enviado_en');
            }])
            ->orderBy('fecha')
            ->get();

        // Aplanar todos los mensajes para el frontend
        $mensajes = $consultas->flatMap(function ($consulta) {
            return $consulta->mensajes->map(function ($msg) use ($consulta) {
                return [
                    'remitente'   => $msg->remitente,
                    'mensaje'     => $msg->mensaje,
                    'enviado_en'  => $msg->enviado_en,
                    'consulta_id' => $consulta->id,
                ];
            });
        });

        return response()->json($mensajes);
    }

    // GET /api/mis-consultas — últimas consultas del usuario activo
    public function misConsultas()
    {
        $expedientes = Expediente::where('usuario_id', auth()->id())
            ->orderByDesc('apertura')
            ->take(5)
            ->get();

        return response()->json($expedientes);
    }

    
    public function destroy(string $numero)
    {
        $expediente = Expediente::where('numero', $numero)
            ->where('usuario_id', auth()->id())
            ->firstOrFail();

        $expediente->delete();

        return response()->json(['message' => 'Expediente eliminado correctamente']);
    }
}