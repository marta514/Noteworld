<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noteworld - Libreta</title>
    <style>
        /* Estilos básicos */
        body { font-family: sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        
        /* BARRA SUPERIOR */
        .navbar { background-color: #1a1a1a; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: bold; font-size: 18px; letter-spacing: 1px; }
        .navbar-menu { display: flex; gap: 20px; align-items: center; }
        .navbar-menu a { color: #ddd; text-decoration: none; font-size: 14px; transition: color 0.2s; }
        .navbar-menu a:hover { color: white; }
        .btn-logout { background: #d9534f; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px; }
        .btn-logout:hover { background: #c9302c; }

        /* Contenedor de la libreta  */
        .contenedor-principal { padding: 40px 20px; }
        .libreta { display: flex; max-width: 900px; margin: 0 auto; background: white; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .hoja { flex-grow: 1; padding: 30px; }
        .alerta-exito { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 8px; border: 1px solid #ccc; box-sizing: border-box; }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="navbar-brand">📖 Noteworld</div>
        
        <nav class="navbar-menu">
            <a href="{{ route('home') }}">🏠 Mi Panel</a>
            
            <a href="{{ route('profile.edit') }}">⚙️ Mi Perfil</a>
            
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </nav>
    </header>

    <div class="contenedor-principal">
        <div class="libreta">
            <main class="hoja">
                @if(session('success'))
                    <div class="alerta-exito">{{ session('success') }}</div>
                @endif

                @yield('hoja')
            </main>
        </div>
    </div>

</body>
</html>