<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte: {{ $mundo->titulo }}</title>
    <style>
        /* Estilos compatibles con DomPDF */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
        /* Configuración del Pie de Página Fijo */
        @page {
            margin: 100px 50px 80px 50px;
        }
        header {
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            border-bottom: 3px solid #40E0D0; /* turquoise */
            padding-bottom: 10px;
        }
        footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
        .pagenum:before {
            content: counter(page);
        }
        /* Utilidades de color */
        .text-cerulean { color: #007BA7; }
        .text-grapefruit { color: #FD5956; }
        .bg-turquoise { background-color: #40E0D0; color: white; }
        
        /* Tablas y contenedores */
        .w-100 { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        
        .seccion { margin-top: 30px; }
        .caja-item {
            border: 1px solid #eee;
            border-left: 5px solid #007BA7;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fcfcfc;
            page-break-inside: avoid; /* Evita que un personaje se corte a la mitad de la hoja */
        }
        .etiqueta {
            background-color: #eee;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <header>
        <table>
            <tr>
                <td style="width: 70%;">
                    <h1 class="text-cerulean" style="margin: 0;">{{ $mundo->titulo }}</h1>
                </td>
                <td style="width: 30%; text-align: right;">
                    <img src="{{ public_path('noteworld.png') }}" alt="Noteworld Logo" style="max-height: 50px;">
                </td>
            </tr>
        </table>
    </header>

    <footer>
        Sistema Noteworld | Generado el {{ now()->format('d/m/Y H:i') }} | Página <span class="pagenum"></span>
    </footer>

    <main>
        <div class="seccion">
            <h2 class="text-cerulean" style="border-bottom: 1px solid #40E0D0;">Sinopsis del Mundo</h2>
            <p style="line-height: 1.6;">{{ $mundo->descripcion ?? 'Sin descripción registrada.' }}</p>
        </div>

        <div class="seccion" style="page-break-before: always;">
            <h2 class="text-cerulean" style="border-bottom: 1px solid #40E0D0;">Habitantes Registrados ({{ $mundo->personajes->count() }})</h2>
            
            @forelse($mundo->personajes as $personaje)
                <div class="caja-item">
                    <h3 class="text-grapefruit" style="margin: 0 0 10px 0;">{{ $personaje->nombre }}</h3>
                    
                    <span class="etiqueta">Edad: {{ $personaje->edad ?? 'N/A' }}</span>
                    <span class="etiqueta">Especie: {{ $personaje->especie ?? 'N/A' }}</span>
                    <span class="etiqueta">Género: {{ $personaje->genero ?? 'N/A' }}</span>
                    
                    <p style="margin-top: 10px; font-size: 13px;"><strong>Biografía:</strong> {{ $personaje->biografia ?? 'Desconocida.' }}</p>
                </div>
            @empty
                <p style="color: #999;">No hay personajes registrados en este mundo.</p>
            @endforelse
        </div>

        <div class="seccion" style="page-break-before: always;">
            <h2 class="text-cerulean" style="border-bottom: 1px solid #40E0D0;">Archivos de Lore ({{ $mundo->entradas->count() }})</h2>
            
            @if($filtroCategoria)
                <div style="background-color: #fff3cd; color: #856404; padding: 10px; border: 1px solid #ffeeba; margin-bottom: 15px;">
                    <strong>Filtro Aplicado:</strong> Mostrando únicamente entradas de la categoría <em>"{{ $filtroCategoria }}"</em>.
                </div>
            @endif

            @forelse($mundo->entradas as $entrada)
                <div class="caja-item" style="border-left-color: #40E0D0;">
                    <table class="w-100">
                        <tr>
                            <td><h3 style="margin: 0; color: #333;">{{ $entrada->titulo }}</h3></td>
                            <td style="text-align: right;"><span class="bg-turquoise" style="padding: 3px 8px; font-size: 11px; border-radius: 5px;">{{ $entrada->categoria }}</span></td>
                        </tr>
                    </table>
                    <p style="margin-top: 10px; font-size: 13px; line-height: 1.5; text-align: justify;">
                        {{ $entrada->contenido }}
                    </p>
                </div>
            @empty
                <p style="color: #999;">No se encontraron registros de lore con los parámetros actuales.</p>
            @endforelse
        </div>
    </main>
</body>
</html>