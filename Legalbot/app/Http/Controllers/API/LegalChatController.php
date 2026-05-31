<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ReglaLegal;
use App\Models\Abogado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LegalChatController extends Controller
{
    public function procesarConsulta(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string',
        ]);

        $mensajeUsuario = $request->input('mensaje');

        // =========================================================================
        // 0. FILTRO DE EMERGENCIAS CRÍTICAS / PENALES GRAVES
        // =========================================================================
        $mensajeEstandar = strtolower($mensajeUsuario);
        $mensajeEstandar = str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $mensajeEstandar);
        
        // Palabras disparadoras de alerta roja penal
        $alertasPenales = ['asesinato', 'homicidio', 'asesine', 'mate', 'matar', 'muerto', 'disparo', 'acuchille'];
        $esCasoCritico = false;

        foreach ($alertasPenales as $alerta) {
            if (str_contains($mensajeEstandar, $alerta)) {
                $esCasoCritico = true;
                break;
            }
        }

        // Detección de signos médicos críticos (sangrado abundante, pérdida de sangre)
        if (!$esCasoCritico) {
            if (preg_match('/perdiendo mucha sangre|mucha sangre|sangrado abundante|sangra mucho|perdiendo sangre/i', $mensajeUsuario)) {
                $esCasoCritico = true;
            }
        }

        // SI ES UN CASO CRÍTICO, RESPONDEMOS DIRECTAMENTE CON ABOGADOS PENALISTAS DE LA BD
        if ($esCasoCritico) {
            try {
                // Jalamos los abogados de la BD cuya especialidad sea Penal
                $abogadosEspecializados = Abogado::with('especialidadLegal')
                    ->whereHas('especialidadLegal', function ($query) {
                        $query->where('nombre', 'like', '%Penal%');
                    })
                    ->where('disponible', 1)
                    ->take(3)
                    ->get();

                if ($abogadosEspecializados->isEmpty()) {
                    $abogadosEspecializados = Abogado::with('especialidadLegal')
                        ->where('disponible', 1)
                        ->take(3)
                        ->get();
                }

                $abogadosEspecializados = $abogadosEspecializados->map(function ($abogado) {
                    return [
                        'id' => $abogado->id,
                        'nombre' => $abogado->nombre,
                        'especialidad' => $abogado->especialidadLegal?->nombre ?? 'Penal',
                        'telefono' => $abogado->telefono,
                        'whatsapp' => $abogado->whatsapp,
                        'correo' => $abogado->email,
                        'direccion' => $abogado->direccion,
                        'disponible' => (bool) $abogado->disponible,
                        'verificado' => (bool) $abogado->verificado,
                        'imagen' => null,
                    ];
                });
            } catch (\Throwable $e) {
                return response()->json([
                    'error' => 'No se pudieron cargar los abogados penalistas: ' . $e->getMessage(),
                ], 500);
            }

            $respuestaEmergencia = "🚨 ATENCIÓN URGENTE: Esta situación califica como un hecho penal grave. De conformidad con las leyes de El Salvador, usted requiere de manera obligatoria la asesoría y defensa de un profesional del derecho especializado.";

            return response()->json([
                'respuesta' => $respuestaEmergencia,
                'requiere_abogado' => true,
                'especialidad_requerida' => 'Derecho Penal',
                'abogados' => $abogadosEspecializados
            ]);
        }

        // =========================================================================
        // 1. BUSCADOR INTELIGENTE EN TU TABLA: regla_legal (Para casos normales)
        // =========================================================================
        $mensajeLimpio = preg_replace('/[^\w\s]/u', '', $mensajeEstandar);
        $palabras = explode(' ', $mensajeLimpio);

        $stopWords = ['un', 'una', 'el', 'la', 'los', 'las', 'que', 'en', 'de', 'para', 'por', 'con', 'tuve', 'hago', 'mis', 'tengo', 'como', 'saber', 'ayuda', 'quiero', 'sabe', 'sobre', 'cuanto', 'cuesta', 'vale', 'pasaje', 'tarifa', 'mire', 'fijese'];
        
        $palabrasClave = array_filter($palabras, function($palabra) use ($stopWords) {
            if (is_numeric($palabra)) { return true; }
            return strlen($palabra) > 3 && !in_array($palabra, $stopWords);
        });

        $query = ReglaLegal::query()->where('vigente', 1);

        if (count($palabrasClave) > 0) {
            $query->where(function($q) use ($palabrasClave) {
                foreach ($palabrasClave as $palabra) {
                    $q->orWhere('descripcion', 'LIKE', "%{$palabra}%")
                      ->orWhere('titulo', 'LIKE', "%{$palabra}%")
                      ->orWhere('articulo', 'LIKE', "%{$palabra}%");
                }
            });
        } else {
            $query->where('descripcion', 'LIKE', "%{$mensajeUsuario}%");
        }

        $documentosEncontrados = $query->take(4)->get();

        $contextoLeyes = "";
        if ($documentosEncontrados->count() > 0) {
            $contextoLeyes = "REGLAMENTOS Y TARIFAS LOCALES ENCONTRADOS EN NUESTRA BASE DE DATOS:\n";
            foreach ($documentosEncontrados as $doc) {
                $contextoLeyes .= "--- \nOr: {$doc->ley_referencia} | Sec: {$doc->titulo} | Art: {$doc->articulo} | Tx: {$doc->descripcion} \n";
            }
            $contextoLeyes .= "=========================================\n\n";
        }

        // =========================================================================
        // 2. PROMPT ENGINEERING (Para casos normales) - ahora pide clasificación
        // =========================================================================
        $systemPrompt = "Eres LegalBot, un orientador digital experto en la legislación de El Salvador. Tu propósito es guiar a los ciudadanos con un tono cercano y natural. Háblele siempre de 'usted'. Evite usar asteriscos innecesarios. Mantén el hilo de la conversación usando el historial provisto; sé empático y ayude a conservar la calma mientras das instrucciones claras paso a paso.\n\n";
        $systemPrompt .= "ANTES de la respuesta explicativa, devuelve un BLOQUE JSON VÁLIDO (solo el objeto JSON) con las siguientes claves:\n";
        $systemPrompt .= "{\n  \"categoria\": \"leve|urgente|critico\",  // clasifica el caso usando SOLO estas tres etiquetas\n  \"especialidad_requerida\": \"<nombre breve de la especialidad>\", // p.ej. Penal, Tránsito, Laboral, Propiedad\n  \"recomendar_abogado\": true|false // si recomienda mostrar abogados ahora\n}\n\n";
        $systemPrompt .= "Luego, separa el bloque JSON del texto humano con una línea de tres guiones '---' y entrega la explicación detallada, incluyendo 'Lo que está pasando', 'Lo que dice la ley', 'Pasos a seguir' y '¿A dónde ir?'.\n\n";

        $systemPrompt .= "FORMATO DE SALIDA PARA LA EXPLICACIÓN:\n¿Qué está pasando?\n(Texto)\n\nLo que dice la ley:\n(Texto)\n\nPasos a seguir:\n(Escribe los pasos en uno o dos párrafos bien ordenados.)\n\n¿A dónde ir?\n(Texto)\n\nNota importante:\n(Texto)\n\n";

        if (!empty($contextoLeyes)) {
            $systemPrompt .= "INSTRUCCIÓN DE BASE DE DATOS LOCAL:\nUtiliza estos datos reales:\n" . $contextoLeyes;
        } else {
            $systemPrompt .= "NOTA: No hay registros exactos en la base de datos local. Responde con tus conocimientos generales.\n\n";
        }

        // =========================================================================
        // 3. LLAMADA DIRECTA A GROQ API
        // =========================================================================
        try {
            $apiKey = env('GROQ_API_KEY');
            $model = env('GROQ_MODEL', 'llama-3.1-8b-instant');

            // Construir payload de mensajes incluyendo historial para mantener contexto
            $messagesPayload = [];
            $messagesPayload[] = ['role' => 'system', 'content' => $systemPrompt];

            $historialRaw = $request->input('historial');
            if (!empty($historialRaw)) {
                if (is_string($historialRaw)) {
                    $decodedHist = json_decode($historialRaw, true);
                } else {
                    $decodedHist = $historialRaw;
                }

                if (is_array($decodedHist)) {
                    foreach ($decodedHist as $h) {
                        $role = isset($h['role']) && strtolower($h['role']) === 'user' ? 'user' : 'assistant';
                        $content = $h['content'] ?? '';
                        if (!empty($content)) {
                            $messagesPayload[] = ['role' => $role, 'content' => $content];
                        }
                    }
                }
            }

            // Mensaje actual del usuario
            $messagesPayload[] = ['role' => 'user', 'content' => $mensajeUsuario];

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $model,
                'messages' => $messagesPayload,
                'temperature' => 0.3
            ]);

            if ($response->failed()) {
                $errorBody = $response->json();
                $detail = $errorBody['error']['message'] ?? $errorBody['message'] ?? 'No se pudo comunicar con Groq.';
                return response()->json(['error' => 'Error en Groq: ' . $detail], 500);
            }

            $resultado = $response->json();
            $resultadoText = $resultado['choices'][0]['message']['content'] ?? 'Lo siento, no he podido procesar la información.';

            // Intentar extraer un objeto JSON al inicio de la respuesta (metadatos de categoría/especialidad)
            $categoria = null;
            $especialidad = null;
            $recomendarAbogadoPorIA = null;

            if (preg_match('/\{.*?\}/s', $resultadoText, $m)) {
                $jsonRaw = $m[0];
                $jsonClean = trim($jsonRaw);
                $decoded = json_decode($jsonClean, true);
                if (is_array($decoded)) {
                    $categoria = $decoded['categoria'] ?? null;
                    $especialidad = $decoded['especialidad_requerida'] ?? $decoded['especialidad'] ?? null;
                    $recomendarAbogadoPorIA = $decoded['recomendar_abogado'] ?? null;
                    // Remove JSON block from the human text
                    $resultadoText = trim(str_replace($jsonRaw, '', $resultadoText));
                    $resultadoText = preg_replace('/^[-\s\n]+/','',$resultadoText);
                }
            }

            // Detección explícita de si el usuario pide asesoría en el texto
            $solicitaAbogado = preg_match('/\b(asesoria|asesoría|abogado|abogada|quiero asesor|necesito abogado|necesito asesor|contratar abogado)\b/i', $mensajeUsuario);

            // Mapas de palabras clave a especialidades como respaldo
            $mapeoEspecialidades = [
                'Penal' => ['asesinato','homicidio','matar','herido','disparo','violencia','robo','delito','pena'],
                'Tránsito' => ['choque','accidente','vehiculo','conductor','colisión','tránsito','choques','peatón'],
                'Laboral' => ['despido','salario','contrato','empleador','liquidación','horas','trabajo'],
                'Propiedad' => ['propiedad','terreno','inmueble','alquiler','hipoteca','posesion','escritura'],
                'Familiar' => ['divorcio','custodia','alimentos','paternidad','maternidad'],
                'Civil' => ['deuda','contrato','incumplimiento','reclamación']
            ];

            // Si la IA no devolvió especialidad, inferir por palabras clave
            if (empty($especialidad)) {
                foreach ($mapeoEspecialidades as $esp => $keywords) {
                    foreach ($keywords as $kw) {
                        if (str_contains($mensajeEstandar, $kw)) {
                            $especialidad = $esp;
                            break 2;
                        }
                    }
                }
            }

            // Si la IA no devolvió categoria, inferir simple (leve/urgente) por heurística
            if (empty($categoria)) {
                // Palabras que indican gravedad/urgencia
                $urgentes = ['grave','gravedad','herido','lesionado','hospital','incapacitado','sangre','fractura'];
                $encontradoUrgente = false;
                foreach ($urgentes as $u) {
                    if (str_contains($mensajeEstandar, $u)) { $encontradoUrgente = true; break; }
                }
                $categoria = $encontradoUrgente ? 'urgente' : 'leve';
            }

            // Decidir si mostramos abogados: si es crítico O el usuario pidió explícitamente asesoría O la IA lo solicitó
            $requiereAbogado = false;
            if (strtolower($categoria) === 'critico') {
                $requiereAbogado = true;
            } elseif ($solicitaAbogado) {
                $requiereAbogado = true;
            } elseif ($recomendarAbogadoPorIA === true || $recomendarAbogadoPorIA === 'true') {
                $requiereAbogado = true;
            }

            $abogadosLista = [];
            if ($requiereAbogado) {
                try {
                    if (!empty($especialidad)) {
                        $abogadosQuery = Abogado::with('especialidadLegal')
                            ->whereHas('especialidadLegal', function ($q) use ($especialidad) {
                                $q->where('nombre', 'LIKE', "%{$especialidad}%");
                            })
                            ->where('disponible', 1)
                            ->take(3)
                            ->get();

                        if ($abogadosQuery->isEmpty()) {
                            $abogadosQuery = Abogado::with('especialidadLegal')
                                ->where('disponible', 1)
                                ->take(3)
                                ->get();
                        }
                    } else {
                        $abogadosQuery = Abogado::with('especialidadLegal')
                            ->where('disponible', 1)
                            ->take(3)
                            ->get();
                    }

                    $abogadosLista = $abogadosQuery->map(function ($abogado) {
                        return [
                            'id' => $abogado->id,
                            'nombre' => $abogado->nombre,
                            'especialidad' => $abogado->especialidadLegal?->nombre ?? null,
                            'telefono' => $abogado->telefono,
                            'whatsapp' => $abogado->whatsapp,
                            'correo' => $abogado->email,
                            'direccion' => $abogado->direccion,
                            'disponible' => (bool) $abogado->disponible,
                            'verificado' => (bool) $abogado->verificado,
                            'imagen' => null,
                        ];
                    })->toArray();
                } catch (\Throwable $e) {
                    // No detener el flujo por fallo en BD; devolveremos la respuesta AI y un arreglo vacío
                    $abogadosLista = [];
                }
            }

            // Asegurar mensajes explícitos según categoría
            $notaCritico = "\n\nIMPORTANTE: Este caso es crítico — sí o sí necesita un abogado real. Por favor contacte a un profesional inmediatamente.";
            $notaUrgente = "\n\nNota: Este caso podría necesitar asesoría de un abogado real dependiendo de la evolución y de la presencia de lesionados o conductas delictivas.";

            if (strtolower($categoria) === 'critico' && !str_contains(strtolower($resultadoText), 'necesita un abogado')) {
                $resultadoText .= $notaCritico;
            } elseif (strtolower($categoria) === 'urgente' && !str_contains(strtolower($resultadoText), 'podr')) {
                $resultadoText .= $notaUrgente;
            }

            return response()->json([
                'respuesta' => $resultadoText,
                'requiere_abogado' => $requiereAbogado,
                'categoria' => $categoria,
                'especialidad_requerida' => $especialidad,
                'abogados' => $abogadosLista
            ]);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error interno: ' . $e->getMessage()], 500);
        }
    }
}