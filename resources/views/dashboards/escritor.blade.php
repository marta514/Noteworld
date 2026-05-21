<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noteworld - Mi Escritorio</title>
    <style> 
        body { font-family: sans-serif; padding: 20px; background: #f4f6f8; color: #333; } 
        h1 { font-size: 24px; margin-bottom: 20px; }
        .seccion { margin-top: 40px; }
        
        /* Sistema de cuadrícula para las cards */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 15px; }
        
        /* Estilos de la tarjeta */
        .card { 
            background: white; padding: 20px; border: 1px solid #e0e0e0; 
            border-radius: 8px; text-decoration: none; color: black; 
            display: block; transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
        .card h3 { margin-top: 0; color: #111; }
        .card p { color: #666; font-size: 14px; line-height: 1.4; }
        
        .btn-nuevo { display: inline-block; padding: 10px 15px; background: #000; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Hola, {{ auth()->user()->name ?? 'Escritor' }} 👋</h1>
    
    <a href="{{ route('mundos.create') }}" class="btn-nuevo">+ Crear Nuevo Mundo</a>

    <div class="seccion">
        <h2>Tus Universos</h2>
        
        @if($misMundos->count() > 0)
            <div class="grid">
                @foreach($misMundos as $mundo)
                    <a href="{{ route('mundos.show', $mundo->id) }}" class="card">
                        <h3>🌍 {{ $mundo->titulo }}</h3>
                        <p>{{ Str::limit($mundo->descripcion, 100) }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p style="color: #777;">Aún no has creado ningún mundo. ¡Empieza a escribir tu historia!</p>
        @endif
    </div>

    <hr style="margin-top: 40px; border: 0; border-top: 1px solid #ddd;">

    <div class="seccion">
        <h2>Explorar la Comunidad</h2>
        <p style="color: #777; margin-top: -15px; margin-bottom: 20px;">Descubre lo que otros escritores están creando.</p>

        @if($comunidad->count() > 0)
            <div class="grid">
                @foreach($comunidad as $mundoAjeno)
                    <a href="{{ route('mundos.show', $mundoAjeno->id) }}" class="card" style="border-left: 4px solid #4CAF50;">
                        <h3>📖 {{ $mundoAjeno->titulo }}</h3>
                        <p>{{ Str::limit($mundoAjeno->descripcion, 80) }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p style="color: #777;">Aún no hay publicaciones de otros usuarios en la plataforma.</p>
        @endif
    </div>

</body>
</html>