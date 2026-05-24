<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colaborar - Noteworld API</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-old-lace min-h-screen flex items-center justify-center p-6">

    <div class="bg-white max-w-lg w-full p-8 rounded-xl shadow-2xl border-t-8 border-turquoise">
        <div class="text-center mb-8">
            <h1 class="font-fantasy text-4xl text-cerulean mb-2">Noteworld API</h1>
            <p class="text-gray-600">Sube tus ilustraciones o referencias para enriquecer nuestro banco.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('colaborar.subir') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <input type="hidden" name="ref_type" value="mundo">
            <input type="hidden" name="ref_id" value="1">
            <input type="hidden" name="collection_id" value="1">

            <div>
                <label class="block text-sm font-bold text-cerulean mb-2">Selecciona tu Imagen</label>
                <input type="file" name="image" required class="w-full text-gray-700 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-turquoise">
            </div>

            <button type="submit" class="w-full bg-grapefruit hover:bg-apricot text-white font-bold py-3 px-4 rounded-md transition duration-300 esquina-cortada">
                Subir al Banco de Imágenes
            </button>
        </form>
        
        <p class="text-xs text-center text-gray-400 mt-6">Las imágenes pasarán por revisión administrativa antes de ser públicas.</p>
    </div>

</body>
</html>