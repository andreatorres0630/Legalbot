<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Reclamo</title>

    <style>
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
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
      <span class="tag-consulta">Carta de Reclamo</span>
      <p class="doc-fecha">
        San Salvador, {{ \Carbon\Carbon::now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
      </p>
    </div>
  </div>
 
  {{-- TÍTULO --}}
  <div class="doc-title-wrap">
    <p class="doc-title">Carta de Reclamo Formal</p>
    <div class="title-line"></div>
  </div>
 
  {{-- DESTINATARIO --}}
  <div class="dest-block">
    <p><strong>Señores:</strong></p>
    <p><span class="val">{{ $empresa }}</span></p>
    <p>Presente.</p>
  </div>
 
  {{-- SALUDO --}}
  <p class="saludo">Estimados señores: {{ $empresa }}</p>
 
  {{-- I. IDENTIFICACIÓN --}}
  <p class="section-title">I. Identificación del reclamante</p>
  <p class="doc-p">
    Yo, <span class="val">{{ $nombre }}</span>,
    mayor de edad, con Documento Único de Identidad número
    <span class="val">{{ $dui }}</span>,
    ciudadano/a de la República de El Salvador; por medio del presente escrito me dirijo
    a ustedes de manera respetuosa con el fin de interponer formal
    <strong>RECLAMO</strong> en los términos que a continuación se exponen.
  </p>
 
  {{-- II. MOTIVO --}}
  <p class="section-title">II. Motivo del reclamo</p>
  <p class="doc-p">
    El presente reclamo se interpone por el siguiente motivo:
    <span class="val">{{ $motivo }}</span>.
  </p>
 
  {{-- III. DESCRIPCIÓN --}}
  <p class="section-title">III. Descripción de los hechos</p>
  <div class="desc-block">{{ $descripcion }}</div>
 
  {{-- IV. FUNDAMENTO LEGAL --}}
  <p class="section-title">IV. Fundamento legal</p>
  <p class="doc-p">
    El presente reclamo se fundamenta en la legislación vigente de la República de El Salvador:
  </p>
  <div class="legal-box">
    <p class="legal-title">Marco normativo aplicable</p>
 
    <div class="legal-item">
      <div class="legal-dot-cell"><div class="legal-dot"></div></div>
      <div class="legal-text-cell">
        <strong>Ley de Protección al Consumidor</strong> (D.L. No. 776, 2005) -
        Art. 17: derecho a reparación, reposición o devolución;
        Art. 44: plazo de respuesta de 5 días hábiles para la empresa.
      </div>
    </div>
 
    <div class="legal-item">
      <div class="legal-dot-cell"><div class="legal-dot"></div></div>
      <div class="legal-text-cell">
        <strong>Código Civil de El Salvador</strong> -
        Art. 1416: incumplimiento de obligaciones contractuales;
        Art. 1427: resolución del contrato por incumplimiento.
      </div>
    </div>
 
    <div class="legal-item">
      <div class="legal-dot-cell"><div class="legal-dot"></div></div>
      <div class="legal-text-cell">
        <strong>Ley de Defensa al Consumidor</strong> -
        Art. 11, lit. b): derecho a ser indemnizado por daños y perjuicios
        causados por productos o servicios deficientes.
      </div>
    </div>
  </div>
 
  {{-- V. SOLICITUD --}}
  <p class="section-title">V. Petición concreta</p>
  <p class="doc-p">
    En virtud de lo anteriormente expuesto, respetuosamente solicito:
  </p>
 
  <div class="pet-list">
    <div class="pet-item">
      <div class="pet-num-cell"><span class="pet-num">1</span></div>
      <div class="pet-text-cell"><span class="val">{{ $solicitud }}</span>.</div>
    </div>
    <div class="pet-item">
      <div class="pet-num-cell"><span class="pet-num">2</span></div>
      <div class="pet-text-cell">
        Respuesta escrita y formal al presente reclamo en un plazo no mayor a
        <strong>5 días hábiles</strong>, conforme al artículo 44 de la
        Ley de Protección al Consumidor.
      </div>
    </div>
  </div>
 
  {{-- AVISO LEGAL --}}
  <div class="warn-box">
    <p>
      <strong>Aviso legal:</strong>
      De no recibir respuesta satisfactoria en el plazo indicado, me reservo el derecho
      de presentar denuncia formal ante la <strong>Defensoría del Consumidor de El Salvador</strong>
      (línea gratuita 910), conforme al Art. 113 de la Ley de Protección al Consumidor,
      o ante el órgano jurisdiccional competente.
    </p>
  </div>
 
  <p class="doc-p" style="margin-top:12px;">
    Esperando una pronta y favorable respuesta, me despido con la debida consideración y respeto.
  </p>
 
  {{-- FIRMAS --}}
  <div class="sig-area">
    <div class="sig-left">
      <div class="sig-line"></div>
      <p class="sig-name">{{ $nombre }}</p>
      <p class="sig-sub">DUI: {{ $dui }}</p>
    </div>
    <div class="sig-right">
      <div class="stamp-circle">SELLO<br>RECIBIDO</div>
    </div>
  </div>
 
  {{-- PIE --}}
  <div class="doc-footer">
    <p>
      Documento generado por LegalBot El Salvador · Ley de Protección al Consumidor (D.L. No. 776/2005)
    </p>
  </div>
</body>
</html>