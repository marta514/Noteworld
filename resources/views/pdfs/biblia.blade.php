<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblia de {{ $mundo->titulo }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; margin-top: 50px; }
        /* Diseño del encabezado y pie de página  */
        header { position: fixed; top: -30px; left: 0px; right: 0px; border-bottom: 1px solid #ccc; padding-bottom: 10px; text-align: center; font-weight: bold; color: #555; }
        footer { position: fixed; bottom: -30px; left: 0px; right: 0px; border-top: 1px solid #ccc; padding-top: 10px; text-align: center; font-size: 12px; color: #777; }
        h1 { color: #2c3e50; }
        h2 { color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 5px; }
        .page-break { page-break-after: always; }
        .personaje, .entrada { margin-bottom: 20px; padding: 10px; background-color: #f9f9f9; border-radius: 5px; }
    </style>
</head>
<body>
    <header>Noteworld - Sistema de Creación de Mundos</header>
    
    <footer>Generado automáticamente por Noteworld el {{ date('d/m/Y') }}</footer>

    <main>
        <div style="text-align: center; margin-top: 150px;">
            <h1 style="font-size: 40px;">{{ $mundo->titulo }}</h1>
            <p><strong>Descripción:</strong></p>
            <p>{{ $mundo->descripcion }}</p>
        </div>

        <div class="page-break"></div>

        <h2>Personajes Principales</h2>
        @forelse($mundo->personajes as $personaje)
            <div class="personaje">
                <h3>{{ $personaje->nombre }}</h3>
                <p><strong>Apariencia:</strong> {{ $personaje->appearance ?? 'No especificada' }}</p>
                <p><strong>Biografía:</strong> {{ $personaje->biography ?? 'Sin biografía' }}</p>
            </div>
        @empty
            <p>Aún no hay personajes en este mundo.</p>
        @endforelse

        <div class="page-break"></div>

        <h2>Entradas y Lore</h2>
        @if($filtroCategoria)
            <p><em>Filtro aplicado: Mostrando solo la categoría "{{ $filtroCategoria }}"</em></p>
        @endif

        @forelse($mundo->entradas as $entrada)
            <div class="entrada">
                <h3>{{ $entrada->titulo }} <span style="font-size: 12px; color: #888;">({{ $entrada->categoria }})</span></h3>
                <p>{{ $entrada->contenido }}</p>
            </div>
        @empty
            <p>Aún no hay historias registradas.</p>
        @endforelse
    </main>
</body>
</html>