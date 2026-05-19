<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Escritor</title>
    <style> body { font-family: sans-serif; padding: 20px; background: #f9f9f9; } .card { background: white; padding: 20px; border: 1px solid #ccc; margin-bottom: 20px; } </style>
</head>
<body>
    <h1>¡Bienvenido a tu Panel de Creación!</h1>
    <a href="{{ route('mundos.index') }}" style="padding: 10px; background: #000; color: white; text-decoration: none;">Abrir mi Libreta</a>
    
    <div style="display: flex; gap: 20px; margin-top: 30px;">
        <div class="card" style="flex: 1;">
            <h3>Lo que has creado</h3>
            <ul>
                <li>Mundos: 3</li>
                <li>Personajes: 12</li>
                <li>Entradas: 5</li>
            </ul>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Novedades en la Web</h3>
            <p>El administrador ha subido nuevas imágenes a la colección "Clima".</p>
        </div>
    </div>
</body>
</html>