@extends('layouts.libreta')

@section('hoja')
<div class="max-w-2xl">
    <h2 class="font-fantasy text-3xl text-cerulean mb-6 border-b-2 border-turquoise pb-2">
        🌍 Crear un Nuevo Mundo
    </h2>
    
    <form action="{{ route('mundos.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="titulo" class="block font-bold text-gray-700 mb-1">Título del Mundo *</label>
            <input type="text" name="titulo" id="titulo" 
                   value="{{ old('titulo') }}" 
                   class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-turquoise focus:outline-none transition"
                   required>
            @error('titulo') <p class="text-grapefruit text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="descripcion" class="block font-bold text-gray-700 mb-1">Descripción / Introducción *</label>
            <textarea name="descripcion" id="descripcion" rows="6" 
                      class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-turquoise focus:outline-none transition"
                      required>{{ old('descripcion') }}</textarea>
            @error('descripcion') <p class="text-grapefruit text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" 
                    class="bg-cerulean text-old-lace px-8 py-3 esquina-cortada font-bold hover:bg-grapefruit transition shadow-lg">
                Guardar Mundo
            </button>
            <a href="{{ route('dashboard.escritor') }}" 
               class="px-8 py-3 border-2 border-gray-300 rounded-lg font-bold hover:bg-gray-100 transition">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection