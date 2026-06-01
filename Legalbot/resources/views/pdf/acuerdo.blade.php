<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acuerdo amistoso</title>
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
            margin: 14mm 16mm 14mm 16mm;
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
 
        /* ── TABLA DE CONDUCTORES COMPATIBLE CON DOMPDF ── */
        .tabla-conductores {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0 16px;
            font-size: 10.5pt;
            border-left: 3px solid #7C3AED;
        }
 
        .tabla-conductores thead th {
            background: #7C3AED;
            color: #fff;
            padding: 8px 12px;
            text-align: left;
            font-weight: bold;
        }
 
        .tabla-conductores tbody td {
            border-top: 1px solid #E5E7EB;
            border-bottom: 1px solid #E5E7EB;
            border-right: 1px solid #E5E7EB;
            padding: 8px 12px;
            color: #2D2D4E;
            vertical-align: top;
        }
 
        .tabla-conductores tbody tr:nth-child(even) td {
            background: #FAF8FF;
        }
 
        .tabla-conductores .label {
            font-weight: bold;
            color: #1E1B4B;
            width: 30%;
        }
 
        /* ── CLÁUSULAS ── */
        .clausulas ol {
            padding-left: 20px;
        }
 
        .clausulas li {
            margin-bottom: 10px;
            font-size: 11pt;
            text-align: justify;
            color: #2D2D4E;
        }
 
        .clausulas li strong {
            color: #7C3AED;
        }
 
        /* ── MONTO DESTACADO COMPATIBLE CON TABLAS ── */
        .monto-box {
            background: #FAF8FF;
            border: 2px solid #7C3AED;
            border-radius: 6px;
            padding: 12px 20px;
            margin: 14px 0;
            display: table;
            width: 100%;
        }
 
        .monto-label {
            display: table-cell;
            font-size: 11pt;
            font-weight: bold;
            color: #7C3AED;
            vertical-align: middle;
        }
 
        .monto-valor {
            display: table-cell;
            font-size: 16pt;
            font-weight: bold;
            color: #7C3AED;
            text-align: right;
            vertical-align: middle;
        }
 
        /* ── CAJA DE TEXTO LIBRE DESCRIPCIÓN ── */
        .descripcion-box {
            border: none;             
            border-radius: 0;
            padding: 4px 0 12px 0;
            font-size: 11pt;
            text-align: left;         
            background: transparent; 
            margin-bottom: 16px;
            line-height: 1.7;
            white-space: pre-line;
        }
 
        /* ── NOTA LEGAL Y ADVERTENCIA ── */
        .nota-legal {
            background: #FFFBEB;
            border-left: 3px solid #F59E0B;
            padding: 10px 14px;
            margin: 14px 0;
            font-size: 10pt;
            color: #92400E;
            line-height: 1.6;
        }
 
        /* ── FIRMAS MAQUETADAS EN TABLA PARA EVITAR HOJAS BLANCAS ── */
        .firmas {
            margin-top: 30px;
            width: 100%;
            display: table;
        }
 
        .firmas-row {
            display: table-row;
        }
 
        .firma-bloque {
            display: table-cell;
            text-align: center;
            width: 50%;
            vertical-align: bottom;
            padding: 0 15px;
        }
 
        .firma-linea {
            border-top: 1.5px solid #7C3AED;
            margin-bottom: 5px;
        }
 
        .firma-nombre {
            font-weight: bold;
            font-size: 11pt;
            color: #1E1B4B;
        }
 
        .firma-cargo {
            font-size: 9.5pt;
            color: #6B7280;
            margin-top: 1px;
        }
 
        .testigos-titulo {
            font-size: 9.5pt;
            font-weight: bold;
            color: #7C3AED;
            text-align: center;
            margin: 24px 0 14px;
            text-transform: uppercase;
            border-top: 1px dashed #CBD5E1;
            padding-top: 14px;
        }
 
        /* ── PIE DE PÁGINA ── */
        .footer {
            border-top: 1px solid #E5E7EB;
            padding-top: 10px;
            margin-top: 24px;
            font-size: 8.5pt;
            color: #6B7280;
            text-align: center;
        }
 
        .footer .advertencia {
            color: #7C3AED;
            font-weight: bold;
            margin-bottom: 4px;
        }
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
                <span class="tag-consulta">Acuerdo Amistoso</span>
                <p class="doc-fecha">
                    San Salvador, {{ \Carbon\Carbon::now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                </p>
            </div>
        </div>
     
        {{-- TÍTULO CENTRAL --}}
        <div class="doc-title-wrap">
            <p class="doc-title">Acuerdo Amistoso Extrajudicial de Tránsito</p>
            <div class="title-line"></div>
        </div>
     
        {{-- INTRODUCCIÓN --}}
        <p class="doc-p">
            Nosotros, los suscritos, en pleno uso de nuestras facultades mentales y sin mediar coacción alguna,
            comparecemos a suscribir el presente <strong>Acuerdo Amistoso Extrajudicial</strong>, de conformidad
            con lo establecido en el <strong>Art. 75 de la Ley de Transporte Terrestre, Tránsito
            y Seguridad Vial de El Salvador</strong> y los principios generales del Código Civil en materia
            de transacciones extrajudiciales (Arts. 2176 y ss. C.C.), declarando que hemos llegado a un
            acuerdo voluntario sobre los daños materiales ocasionados en el accidente de tránsito ocurrido en 
            <span class="val">{{ $lugar }}</span>.
        </p>
     
        {{-- I. DATOS DE LAS PARTES --}}
        <p class="section-title">I. Datos de las Partes e Identificación de Bienes</p>
        <table class="tabla-conductores">
            <thead>
                <tr>
                    <th style="width:34%">Especificación</th>
                    <th style="width:33%">Conductor / Parte I</th>
                    <th style="width:33%">Conductor / Parte II</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="label">Nombre completo</td>
                    <td>{{ $conductor1 }}</td>
                    <td>{{ $conductor2 }}</td>
                </tr>
                <tr>
                    <td class="label">Placa del vehículo</td>
                    <td><span class="val">{{ $placa1 }}</span></td>
                    <td><span class="val">{{ $placa2 }}</span></td>
                </tr>
                <tr>
                    <td class="label">Firma de conformidad</td>
                    <td style="color: #9CA3AF; font-size: 9pt; font-style: italic;">Suscrita al pie</td>
                    <td style="color: #9CA3AF; font-size: 9pt; font-style: italic;">Suscrita al pie</td>
                </tr>
            </tbody>
        </table>
     
        {{-- II. DESCRIPCIÓN DEL ACCIDENTE --}}
        <p class="section-title">II. Descripción del Accidente</p>
        <div class="descripcion-box">
            {{ $descripcion }}
        </div>
     
        {{-- III. MONTO ACORDADO --}}
        <p class="section-title">III. Monto de la Indemnización Contractual</p>
        <div class="monto-box">
            <div class="monto-label">Monto total acordado para reparación de daños materiales:</div>
            <div class="monto-valor">$ {{ number_format($monto, 2) }} USD</div>
        </div>
     
        {{-- IV. CLÁUSULAS DEL ACUERDO --}}
        <div class="bloque clausulas">
            <p class="section-title">IV. Cláusulas del Convenio</p>
            <ol>
                <li>
                    <strong>Voluntariedad:</strong> Las partes declaran que el presente acuerdo se suscribe
                    de forma libre, voluntaria y sin presión alguna, reconociendo mutuamente los hechos materiales descritos.
                </td>
                <li>
                    <strong>Daños cubiertos:</strong> El monto acordado cubre exclusivamente los daños
                    <em>materiales</em> de los vehículos involucrados, declarando la ausencia de personas lesionadas en el evento.
                </td>
                <li>
                    <strong>Renuncia de acciones:</strong> Una vez efectuado el pago íntegro de la indemnización, ambas partes renuncian expresamente a interponer futuras acciones civiles o administrativas por daños materiales, de conformidad con el Art. 2176 del Código Civil.
                </td>
            </ol>
        </div>
     
        {{-- NOTA LEGAL --}}
        <div class="nota-legal">
            <strong>Aviso de Ley:</strong> Este acuerdo privado regula únicamente responsabilidades patrimoniales civiles entre particulares y presupone la inexistencia de infracciones bajo efectos de sustancias tóxicas contempladas en el Código Penal.
        </div>
     
        {{-- FIRMAS CONDUCTORES --}}
        <div class="firmas">
            <div class="firmas-row">
                <div class="firma-bloque">
                    <br><br><br>
                    <div class="firma-linea"></div>
                    <div class="firma-nombre">{{ $conductor1 }}</div>
                    <div class="firma-cargo">Conductor Parte I</div>
                    <div class="firma-sub">Placa: {{ $placa1 }}</div>
                </div>
                <div class="firma-bloque">
                    <br><br><br>
                    <div class="firma-linea"></div>
                    <div class="firma-nombre">{{ $conductor2 }}</div>
                    <div class="firma-cargo">Conductor Parte II</div>
                    <div class="firma-sub">Placa: {{ $placa2 }}</div>
                </div>
            </div>
     
            {{-- TESTIGOS --}}
            <div class="testigos-titulo">Validación de Testigos</div>
            <div class="firmas-row">
                <div class="firma-bloque">
                    <br><br><br>
                    <div class="firma-linea"></div>
                    <div class="firma-nombre">Firma Testigo 1</div>
                    <div class="firma-sub">DUI: ________________________</div>
                </div>
                <div class="firma-bloque">
                    <br><br><br>
                    <div class="firma-linea"></div>
                    <div class="firma-nombre">Firma Testigo 2</div>
                    <div class="firma-sub">DUI: ________________________</div>
                </div>
            </div>
        </div>
     
        {{-- PIE DE PÁGINA --}}
        <div class="footer">
            <div class="advertencia">
                Este convenio constituye un acuerdo transaccional privado válido bajo la legislación de tránsito de la República de El Salvador.
            </div>
            <div>
                Documento emitido de manera automatizada por LegalBot El Salvador | Sede Central San Miguel
            </div>
        </div>
</body>
</html>