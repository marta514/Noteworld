<!DOCTYPE html>
<html lang="es">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    </head>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noteworld - Libreta</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Mantenemos los estilos de los formularios adaptados a tus nuevos colores */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #2584A7; /* Cerulean */ }
        .form-group input, .form-group textarea, .form-group select { 
            width: 100%; 
            padding: 10px; 
            border: 2px solid #24E5D2; /* Turquoise */
            border-radius: 6px;
            background-color: #FFF8E9; /* Old Lace */
            color: #2584A7;
            box-sizing: border-box; 
            transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #FE6D73; /* Grapefruit al enfocar */
        }
    
    </style>
</head>
<body class="bg-apricot font-sans text-cerulean antialiased">

    <header class="bg-old-lace  shadow-md py-2 px-6 flex justify-between items-center ">
        <div class="flex items-center gap-3">
            <img src="{{ asset('noteworld.png') }}" alt="Logo Noteworld" class="h-20 w-20">
        </div>
        
        <nav class="flex gap-6 items-center">
            <a href="{{ route('home') }}" class="text-grapefruit hover:text-apricot transition font-fantasy text-lg">Dashboard</a>
            
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="bg-grapefruit hover:bg-apricot text-old-lace font-fantasy py-2 px-5 esquina-cortada transition shadow-sm">
    Cerrar Sesión
</button>
            </form>
        </nav>
    </header>

    <div class="py-12 px-4 a">
        <div class="max-w-7xl mx-auto libreta-abierta esquina-cortad border-gray-200 min-h-[80vh] flex">
    <main class="flex-grow p-12">
                @if(session('success'))
                    <div class="bg-turquoise bg-opacity-30 text-cerulean border-l-4 border-cerulean p-4 rounded mb-6 font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('hoja')
                
            </main>
        </div>
    </div>

</body>
</html>