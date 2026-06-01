<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento;


class DocumentoController extends Controller
{
    public function index()
    {
        return Documento::where('usuario_id', auth()->id())->get()->map(function ($doc) {
            $contenido = $doc->contenido ? json_decode($doc->contenido, true) : null;

            return [
                'id' => $doc->id,
                'name' => $doc->titulo,
                'status' => $doc->estado,
                'category' => 'Documento Legal',
                'downloadUrl' => $doc->archivo_url ? Storage::disk('public')->url($doc->archivo_url) : null,
                'date' => $doc->generado_en,
                'size' => '-',
                'consulta' => $doc->consulta_id,
                'bg' => '#EDE9FE',
                'color' => '#7C3AED',
                'contenido' => $contenido,
                'template' => $contenido['template'] ?? null,
            ];
        });
    }

    public function show($id)
    {
        $doc = Documento::where('usuario_id', auth()->id())->findOrFail($id);
        $contenido = $doc->contenido ? json_decode($doc->contenido, true) : null;

        return [
            'id' => $doc->id,
            'name' => $doc->titulo,
            'status' => $doc->estado,
            'category' => 'Documento Legal',
            'downloadUrl' => $doc->archivo_url ? Storage::disk('public')->url($doc->archivo_url) : null,
            'date' => $doc->generado_en,
            'size' => '-',
            'consulta' => $doc->consulta_id,
            'bg' => '#EDE9FE',
            'color' => '#7C3AED',
            'contenido' => $contenido,
            'template' => $contenido['template'] ?? null,
        ];
    }

    public function marcarDescargado($id)
    {
        $doc = Documento::where('usuario_id', auth()->id())->findOrFail($id);
        if ($doc->estado !== 'descargado') {
            $doc->estado = 'descargado';
            $doc->save();
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $doc = Documento::where('usuario_id', auth()->id())->findOrFail($id);

        // delete stored file if exists
        if ($doc->archivo_url && Storage::disk('public')->exists($doc->archivo_url)) {
            Storage::disk('public')->delete($doc->archivo_url);
        }

        $doc->delete();

        return response()->json(['success' => true]);
    }

    public function generarReclamo(Request $request)
    {

    if (!auth()->check()) {
        return response()->json(['message' => 'No autenticado.'], 401);
    }

    $pdf = Pdf::loadView('pdf.reclamo', [
        'nombre' => $request->nombre,
        'dui' => $request->dui,
        'empresa' => $request->empresa,
        'motivo' => $request->motivo,
        'descripcion' => $request->descripcion,
        'solicitud' => $request->solicitud,
    ]);
    $nombreArchivo = 'reclamo_' . time() . '.pdf';

    Storage::disk('public')->put(
        'documentos/' . $nombreArchivo,
        $pdf->output()
    );

    Documento::create([
        'usuario_id' => auth()->id(),
        'titulo' => 'Carta de Reclamo',
        'contenido' => json_encode([
            'template' => 'reclamo',
            'datos' => [
                'nombre' => $request->nombre,
                'dui' => $request->dui,
                'empresa' => $request->empresa,
                'motivo' => $request->motivo,
                'descripcion' => $request->descripcion,
                'solicitud' => $request->solicitud,
            ],
        ]),
        'estado' => 'generado',
        'archivo_url' => 'documentos/' . $nombreArchivo,
    ]);

    return $pdf->download($nombreArchivo);
    }


    public function generarAcuerdo(Request $request)
    {

    if (!auth()->check()) {
        return response()->json(['message' => 'No autenticado.'], 401);
    }

    $pdf = Pdf::loadView('pdf.acuerdo', [
        'conductor1' => $request->conductor1,
        'conductor2' => $request->conductor2,
        'placa1' => $request->placa1,
        'placa2' => $request->placa2,
        'lugar' => $request->lugar,
        'descripcion' => $request->descripcion,
        'monto' => $request->monto
    ]);

    $nombreArchivo = 'acuerdo_' . time() . '.pdf';

    Storage::disk('public')->put(
        'documentos/' . $nombreArchivo,
        $pdf->output()
    );

    Documento::create([
        'usuario_id' => auth()->id(),
        'titulo' => 'Acuerdo Amistoso',
        'contenido' => json_encode([
            'template' => 'acuerdo',
            'datos' => [
                'fecha' => $request->fecha,
                'conductor1' => $request->conductor1,
                'conductor2' => $request->conductor2,
                'placa1' => $request->placa1,
                'placa2' => $request->placa2,
                'lugar' => $request->lugar,
                'descripcion' => $request->descripcion,
                'monto' => $request->monto,
            ],
        ]),
        'estado' => 'generado',
        'archivo_url' => 'documentos/' . $nombreArchivo,
    ]);

    return $pdf->download($nombreArchivo);
    }


    public function generarDenuncia(Request $request)
    {

    if (!auth()->check()) {
        return response()->json(['message' => 'No autenticado.'], 401);
    }

    $pdf = Pdf::loadView('pdf.denuncia', [
        'institucion' => $request->institucion,
        'hechos' => $request->hechos,
        'testigos' => $request->testigos,
        'fecha' => $request->fecha
    ]);

    $nombreArchivo = 'denuncia_' . time() . '.pdf';

    Storage::disk('public')->put(
        'documentos/' . $nombreArchivo,
        $pdf->output()
    );

    Documento::create([
        'usuario_id' => auth()->id(),
        'titulo' => 'Denuncia Formal',
        'contenido' => json_encode([
            'template' => 'denuncia',
            'datos' => [
                'institucion' => $request->institucion,
                'hechos' => $request->hechos,
                'testigos' => $request->testigos,
                'fecha' => $request->fecha,
            ],
        ]),
        'estado' => 'generado',
        'archivo_url' => 'documentos/' . $nombreArchivo,
    ]);

    return $pdf->download($nombreArchivo);
    }


    public function guardarBorrador(Request $request)
    {
        Documento::create([
            'usuario_id' => 1,
            'titulo' => 'Borrador - '.$request->plantilla,
            'contenido' => json_encode($request->datos),
            'estado' => 'borrador'
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Borrador guardado correctamente'
        ]);
    }
}
