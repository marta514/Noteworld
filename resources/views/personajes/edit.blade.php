@extends('layouts.libreta')

@section('hoja')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg border-2 border-turquoise/30">
    
    <!-- Encabezado de la Ficha -->
    <div class="mb-8 border-b-2 border-turquoise pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="font-fantasy text-4xl text-cerulean flex items-center gap-3">
                <span class="text-3xl">✏️</span> Editar Personaje: {{ $personaje->nombre }}
            </h2>
            <p class="text-gray-600 mt-2">
                Actualizando la ficha para el mundo: <strong class="text-grapefruit">{{ $personaje->mundo->titulo }}</strong>
            </p>
        </div>
        <a href="{{ route('personajes.show', $personaje->id) }}" class="text-gray-400 hover:text-grapefruit transition duration-300 font-bold mb-1">
            ← Cancelar y Volver
        </a>
    </div>

    <!-- Formulario de Edición -->
    <!-- Nota que la ruta cambia a 'personajes.update' y recibe el ID del personaje -->
    <form action="{{ route('personajes.update', $personaje->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Fila 1: Nombre Principal -->
        <div>
            <label for="nombre" class="block text-lg font-bold text-cerulean mb-2">Nombre Completo *</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $personaje->nombre) }}" required
                class="w-full text-gray-800 px-4 py-3 border-2 border-turquoise/40 rounded-xl focus:outline-none focus:border-turquoise focus:ring-4 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all text-lg">
        </div>

        <!-- Fila 2: Grid 3 columnas para datos básicos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="edad" class="block text-sm font-bold text-cerulean mb-2">Edad / Tiempo</label>
                <input type="text" name="edad" id="edad" value="{{ old('edad', $personaje->edad) }}" placeholder="Ej. 87 años"
                    class="w-full text-gray-700 px-4 py-2 border-2 border-turquoise/30 rounded-lg focus:outline-none focus:border-turquoise focus:ring-2 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all">
            </div>
            <div>
                <label for="genero" class="block text-sm font-bold text-cerulean mb-2">Género</label>
                <input type="text" name="genero" id="genero" value="{{ old('genero', $personaje->genero) }}" placeholder="Ej. Masculino"
                    class="w-full text-gray-700 px-4 py-2 border-2 border-turquoise/30 rounded-lg focus:outline-none focus:border-turquoise focus:ring-2 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all">
            </div>
            <div>
                <label for="especie" class="block text-sm font-bold text-cerulean mb-2">Especie / Raza</label>
                <input type="text" name="especie" id="especie" value="{{ old('especie', $personaje->especie) }}" placeholder="Ej. Dúnadan"
                    class="w-full text-gray-700 px-4 py-2 border-2 border-turquoise/30 rounded-lg focus:outline-none focus:border-turquoise focus:ring-2 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all">
            </div>
        </div>

        <!-- Fila 3: Biografía completa -->
        <div>
            <label for="biografia" class="block text-sm font-bold text-cerulean mb-2">Historia / Biografía</label>
            <textarea name="biografia" id="biografia" rows="4" 
                class="w-full text-gray-700 px-4 py-3 border-2 border-turquoise/30 rounded-lg focus:outline-none focus:border-turquoise focus:ring-2 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all resize-y">{{ old('biografia', $personaje->biografia) }}</textarea>
        </div>

        <!-- Fila 4: Apariencia y Personalidad (Grid 2 columnas) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="apariencia_fisica" class="block text-sm font-bold text-cerulean mb-2">Apariencia Física</label>
                <textarea name="apariencia_fisica" id="apariencia_fisica" rows="4" 
                    class="w-full text-gray-700 px-4 py-3 border-2 border-turquoise/30 rounded-lg focus:outline-none focus:border-turquoise focus:ring-2 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all resize-y">{{ old('apariencia_fisica', $personaje->apariencia_fisica) }}</textarea>
            </div>
            <div>
                <label for="personalidad" class="block text-sm font-bold text-cerulean mb-2">Personalidad y Rasgos</label>
                <textarea name="personalidad" id="personalidad" rows="4" 
                    class="w-full text-gray-700 px-4 py-3 border-2 border-turquoise/30 rounded-lg focus:outline-none focus:border-turquoise focus:ring-2 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all resize-y">{{ old('personalidad', $personaje->personalidad) }}</textarea>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="pt-6 border-t-2 border-turquoise/20 flex items-center justify-end gap-6 mt-8">
            <a href="{{ route('personajes.show', $personaje->id) }}" class="text-gray-500 hover:text-grapefruit font-bold transition duration-300">
                Cancelar
            </a>
            <button type="submit" class="bg-cerulean hover:bg-turquoise text-white font-bold text-lg py-3 px-8 rounded-xl transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 esquina-cortada">
                Actualizar Ficha
            </button>
        </div>
    </form>
</div>
@endsection