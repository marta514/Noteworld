<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noteworld - Libreta</title>
    <style>
        /* Estilos súper básicos de boceto */
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .libreta { display: flex; max-width: 900px; margin: 0 auto; background: white; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .pestanas { width: 200px; border-right: 2px solid #ddd; padding: 20px; background: #fafafa; }
        .pestanas a { display: block; padding: 10px; margin-bottom: 10px; text-decoration: none; color: #333; border: 1px solid #ccc; background: #eee; }
        .pestanas a:hover { background: #ddd; }
        .hoja { flex-grow: 1; padding: 30px; }
        .alerta-exito { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
        .alerta-error { padding: 10px; background: #f8d7da; color: #721c24; border-radius: 4px; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 8px; border: 1px solid #ccc; }
    </style>
</head>
<body>

    <div class="libreta">
        <nav class="pestanas">
            <a href="{{ route('mundos.index') }}">🌍 Mis Mundos</a>
        </nav>

        <main class="hoja">
            @if(session('success'))
                <div class="alerta-exito">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alerta-error">
                    <strong>¡Uy! Revisa los siguientes errores:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('hoja')
        </main>
    </div>

</body>
</html>