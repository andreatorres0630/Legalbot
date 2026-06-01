<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncia Formal</title>
    <style>
        /* ── RESET ── */
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
 
    /* ── PÁGINA ── */
    body {
      font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #1a1a1a;
            background: #fff;
            padding: 30px 50px;
            line-height: 1.7;
    }
 
    /* DomPDF page margins */
    @page {
      margin: 18mm 20mm 18mm 20mm;
    }
 
    /* ── BARRA SUPERIOR DE COLOR ── */
    .stripe {
      height: 6px;
      background: #7C3AED;
      margin-bottom: 22px;
    }
 
    /* ── CABECERA DEL DOCUMENTO ── */
    .doc-header {
      display: table;
      width: 100%;
      margin-bottom: 22px;
      padding-bottom: 14px;
      border-bottom: 1px solid #E5E7EB;
    }
    .doc-header-left  { display: table-cell; vertical-align: top; }
    .doc-header-right { display: table-cell; vertical-align: top; text-align: right; }
 
    .brand-name { font-size: 12pt; font-weight: bold; color: #7C3AED; }
    .brand-sub  { font-size: 8.5pt; color: #6B7280; margin-top: 2px; }
 
    .tag-consulta {
      display: inline-block;
      background: #EDE9FE;
      color: #5B21B6;
      font-size: 8.5pt;
      font-weight: bold;
      padding: 3px 10px;
      border-radius: 12px;
    }
    .doc-fecha { font-size: 9pt; color: #6B7280; margin-top: 5px; }
 
    /* ── TÍTULO CENTRAL ── */
    .doc-title-wrap { text-align: center; margin-bottom: 22px; }
    .doc-title {
      font-size: 14pt;
      font-weight: bold;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #1E1B4B;
    }
    .title-line {
      width: 52px;
      height: 3px;
      background: #7C3AED;
      margin: 6px auto 0;
    }
 
    /* ── DESTINATARIO ── */
    .dest-label {
      font-size: 8pt;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #6B7280;
      margin-bottom: 5px;
    }
    .dest-block { margin-bottom: 18px; }
    .dest-block p { font-size: 11pt; line-height: 1.6; }
 
    /* ── SALUDO ── */
    .saludo {
      font-style: italic;
      font-size: 11pt;
      margin-bottom: 14px;
    }
 
    /* ── SECCIONES ── */
    .section-title {
      font-size: 8.5pt;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #7C3AED;
      margin-top: 16px;
      margin-bottom: 6px;
    }
 
    .doc-p {
      font-size: 11pt;
      line-height: 1.7;
      text-align: justify;
      color: #2D2D4E;
      margin-bottom: 6px;
    }
 
    /* Valor del campo destacado */
    .val {
      font-weight: bold;
      color: #1E1B4B;
    }
 
    /* ── CAJA LEGAL ── */
    .legal-box {
      background: #FAF8FF;
      border-left: 3px solid #7C3AED;
      padding: 11px 14px;
      margin: 12px 0;
    }
    .legal-title {
      font-size: 8pt;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #7C3AED;
      margin-bottom: 7px;
    }
    .legal-item {
      display: table;
      width: 100%;
      margin-bottom: 8px;
    }
    .legal-dot-cell {
      display: table-cell;
      width: 12px;
      vertical-align: top;
      padding-top: 5px;
    }
    .legal-dot {
      width: 5px;
      height: 5px;
      background: #7C3AED;
      border-radius: 50%;
    }
    .legal-text-cell {
      display: table-cell;
      font-size: 9.5pt;
      line-height: 1.5;
      color: #4B5563;
      vertical-align: top;
    }
 
    /* ── LISTA DE PETICIONES ── */
    .pet-list { margin: 10px 0 14px; }
    .pet-item {
      display: table;
      width: 100%;
      margin-bottom: 9px;
    }
    .pet-num-cell { display: table-cell; width: 28px; vertical-align: top; }
    .pet-num {
      display: inline-block;
      background: #7C3AED;
      color: #fff;
      font-size: 8.5pt;
      font-weight: bold;
      width: 19px;
      height: 19px;
      border-radius: 50%;
      text-align: center;
      line-height: 19px;
      margin-top: 2px;
    }
    .pet-text-cell {
      display: table-cell;
      font-size: 11pt;
      line-height: 1.7;
      color: #2D2D4E;
      vertical-align: top;
    }
 
    /* ── AVISO LEGAL ── */
    .warn-box {
      background: #FFFBEB;
      border: 1px solid #FDE68A;
      border-left: 3px solid #F59E0B;
      padding: 10px 14px;
      margin: 12px 0;
    }
    .warn-box p {
      font-size: 9.5pt;
      line-height: 1.5;
      color: #92400E;
    }
 
    /* ── DESCRIPCIÓN (campo libre, respeta saltos de línea) ── */
    .desc-block {
      font-size: 11pt;
      line-height: 1.7;
      text-align: justify;
      color: #2D2D4E;
      white-space: pre-line;
    }

    /* ── TABLA TESTIGOS ADAPTADA A ESTILO LIMPIO ── */
    .tabla-testigos {
        width: 100%;
        border-collapse: collapse;
        font-size: 10.5pt;
        margin: 12px 0;
    }
    .tabla-testigos thead th {
        background: #7C3AED;
        color: #fff;
        padding: 8px 12px;
        text-align: left;
        font-weight: bold;
    }
    .tabla-testigos tbody td {
        border: 1px solid #E5E7EB;
        padding: 8px 12px;
        color: #2D2D4E;
    }
    .tabla-testigos tbody tr:nth-child(even) td {
        background: #FAF8FF;
    }
 
    /* ── FIRMAS ── */
    .sig-area {
      display: table;
      width: 100%;
      margin-top: 38px;
      padding-top: 16px;
      border-top: 1px solid #E5E7EB;
    }
    .sig-left  { display: table-cell; width: 55%; vertical-align: bottom; }
    .sig-right { display: table-cell; width: 45%; vertical-align: bottom; text-align: right; }
 
    .sig-line  { border-top: 1px solid #9CA3AF; width: 180px; margin-bottom: 5px; }
    .sig-name  { font-size: 11pt; font-weight: bold; color: #1E1B4B; }
    .sig-sub   { font-size: 9pt; color: #6B7280; margin-top: 2px; }
 
    .stamp-circle {
      display: inline-block;
      width: 74px;
      height: 74px;
      border-radius: 50%;
      border: 2px dashed #C4B5FD;
      text-align: center;
      line-height: 1.3;
      padding-top: 22px;
      font-size: 8pt;
      font-weight: bold;
      color: #C4B5FD;
    }
 
    /* ── PIE DE PÁGINA ── */
    .doc-footer {
      margin-top: 28px;
      padding-top: 12px;
      border-top: 1px solid #F3F4F6;
      text-align: center;
    }
    .doc-footer p { font-size: 8pt; color: #9CA3AF; }
    </style>
</head>
<body>
    {{-- BARRA SUPERIOR --}}
  <div class="stripe"></div>
 
  {{-- CABECERA --}}
  <div class="doc-header">
    <div class="doc-header-left">
      <p class="brand-name">LegalBot El Salvador</p>
      <p class="brand-sub">Asistente Legal Comunitario Digital</p>
    </div>
    <div class="doc-header-right">
      <span class="tag-consulta">Denuncia Formal</span>
      <p class="doc-fecha">
        @if($fecha)
          {{ \Carbon\Carbon::parse($fecha)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
        @else
          {{ \Carbon\Carbon::now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
        @endif
      </p>
    </div>
  </div>
 
  {{-- TÍTULO --}}
  <div class="doc-title-wrap">
    <p class="doc-title">Escrito de Denuncia Formal</p>
    <div class="title-line"></div>
  </div>
 
  {{-- DESTINATARIO --}}
  <div class="dest-block">
    <p class="dest-label">Dirigida a:</p>
    <p><strong>Señor(a) Titular / Jefe de Unidad de:</strong></p>
    <p><span class="val">{{ strtoupper($institucion) }}</span></p>
    <p>Presente.</p>
  </div>
 
  {{-- SALUDO --}}
  <p class="saludo">Estimados señores:</p>
 
  {{-- I. NARRACIÓN DE LOS HECHOS --}}
  <p class="section-title">I. Narración de los Hechos</p>
  <div class="desc-block">{{ $hechos }}</div>
 
  {{-- II. TESTIGOS PRESENCIALES --}}
  <p class="section-title">II. Testigos Presenciales</p>
  @if(!empty($testigos))
    <table class="tabla-testigos">
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">#</th>
                <th style="width: 90%;">Nombre del Testigo</th>
            </tr>
        </thead>
        <tbody>
            @if(is_array($testigos))
                @foreach($testigos as $index => $testigo)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $testigo['nombre'] ?? (is_string($testigo) ? $testigo : '________________________________') }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>{{ $testigos }}</td>
                </tr>
            @endif
        </tbody>
    </table>
  @else
    <table class="tabla-testigos">
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">#</th>
                <th style="width: 90%;">Nombre del Testigo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">1</td>
                <td>No se consignan testigos presenciales en el formulario de origen.</td>
            </tr>
        </tbody>
    </table>
  @endif
 
  {{-- III. PETICIÓN FORMAL --}}
  <p class="section-title">III. Petición Formal</p>
  <p class="doc-p">
    Con base en los hechos expuestos y los elementos aportados, respetuosamente solicito a la institución receptora que:
  </p>
  <div class="pet-list">
    <div class="pet-item">
      <div class="pet-num-cell"><span class="pet-num">1</span></div>
      <div class="pet-text-cell">Se tenga por recibida y admitida la presente denuncia formal, asignándole el número de expediente respectivo.</div>
    </div>
    <div class="pet-item">
      <div class="pet-num-cell"><span class="pet-num">2</span></div>
      <div class="pet-text-cell">Se inicien las diligencias de investigación correspondientes para el esclarecimiento cronológico de las circunstancias alegadas.</div>
    </div>
  </div>
 
  {{-- IV. FUNDAMENTO LEGAL --}}
  <p class="section-title">IV. Base Legal de Referencia</p>
  <div class="legal-box">
    <p class="legal-title">Marco normativo aplicable en El Salvador</p>
    <div class="legal-item">
      <div class="legal-dot-cell"><div class="legal-dot"></div></div>
      <div class="legal-text-cell">
        <strong>Código Procesal Penal</strong> (Arts. 229 al 234) - Relativos a la facultad, obligatoriedad y requisitos formales para la interposición de denuncias ciudadanas ante autoridades públicas.
      </div>
    </div>
    <div class="legal-item">
      <div class="legal-dot-cell"><div class="legal-dot"></div></div>
      <div class="legal-text-cell">
        <strong>Constitución de la República</strong> (Arts. 1, 2 y 11) - Garantía del derecho a la seguridad material, la protección jurídica integral y el debido proceso de los ciudadanos.
      </div>
    </div>
  </div>
 
  {{-- DECLARACIÓN JURADA --}}
  <div class="declaracion">
    <strong>Declaración de Veracidad:</strong> El firmante declara bajo fe de juramento y bajo entera responsabilidad personal que los hechos descritos en este reporte automatizado son verídicos y que no se ha incurrido en simulaciones delictivas sancionadas por el Art. 310 del Código Penal.
  </div>
 
  {{-- AVISO LEGAL --}}
  <div class="warn-box">
    <p>
      <strong>Aviso de seguimiento institucional:</strong> 
      Esta solicitud requiere el correspondiente sello físico e identificación del funcionario público receptor en ventanilla o delegación asignada para dar por iniciado formalmente el conteo de los plazos legales de respuesta.
    </p>
  </div>
 
  {{-- FIRMAS --}}
  <div class="sig-area">
    <div class="sig-left">
      <div class="sig-line"></div>
      <p class="sig-name">Firma del Denunciante</p>
      <p class="sig-sub">Huella dactilar (en caso de imposibilidad)</p>
    </div>
    <div class="sig-right">
      <div class="stamp-circle">SELLO<br>OFICIAL</div>
    </div>
  </div>
 
  {{-- PIE --}}
  <div class="doc-footer">
    <p>
      Documento generado por LegalBot El Salvador | Código Procesal Penal de la República de El Salvador
    </p>
  </div>
</body>
</html>