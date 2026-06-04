<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Directorio Legal</title>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
    <div id="app" class="min-h-screen">
        <directorio-page></directorio-page>
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
