<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Administrativo</title>
</head>
<body>
    <div id="app">
        <dashboard-admin></dashboard-admin>
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>