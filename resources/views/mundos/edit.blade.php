@extends('layouts.libreta')

@section('hoja')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg border-2 border-turquoise/30">
    
    <div class="mb-8 border-b-2 border-turquoise pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="font-fantasy text-4xl text-cerulean flex items-center gap-3">
                Editar Mundo: {{ $mundo->titulo }}
            </h2>
        </div>
    </div>

    <form action="{{ route('mundos.update', $mundo->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="titulo" class="block text-lg font-bold text-cerulean mb-2">Nombre del Mundo *</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $mundo->titulo) }}" required placeholder="Ej. Tierra Media"
                class="w-full text-gray-800 px-4 py-3 border-2 border-turquoise/40 rounded-xl focus:outline-none focus:border-turquoise focus:ring-4 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all text-lg">
        </div>

        <div>
            <label for="descripcion" class="block text-lg font-bold text-cerulean mb-2">Descripción General</label>
            <textarea name="descripcion" id="descripcion" rows="6" placeholder="Describe la geografía, el tono o la historia principal de este universo..."
                class="w-full text-gray-700 px-4 py-4 border-2 border-turquoise/30 rounded-xl focus:outline-none focus:border-turquoise focus:ring-4 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all resize-y leading-relaxed text-lg">{{ old('descripcion', $mundo->descripcion) }}</textarea>
        </div>

        <div class="pt-6 border-t-2 border-turquoise/20 flex items-center justify-end gap-6 mt-8">
            <a href="{{ route('mundos.show', $mundo->id) }}" class="text-gray-500 hover:text-grapefruit font-bold transition duration-300">
                Cancelar
            </a>
            <button type="submit" class="bg-cerulean hover:bg-turquoise text-white font-bold text-lg py-3 px-8 rounded-xl transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 esquina-cortada">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection