@extends('layouts.libreta')
@section('hoja')
    
<div class="flex flex-col md:flex-row gap-6 h-[800px]">
    
    <div class="w-full md:w-1/4 bg-old-lace border-2 border-turquoise p-4 rounded-lg overflow-y-auto shadow-inner">
        <h3 class="font-fantasy text-xl text-cerulean mb-4 border-b border-turquoise pb-2">Banco de la API</h3>
        <p class="text-sm text-gray-600 mb-4">Haz clic en una imagen para enviarla a tu cuadrícula.</p>
        
        <div class="grid grid-cols-2 gap-3">
    @forelse($imagenesApi as $img)
        <form action="{{ route('mundos.moodboard.agregar', $mundo->id) }}" method="POST" class="aspect-square">
            @csrf
            <input type="hidden" name="image_id" value="{{ $img->id }}">
            <button type="submit" class="w-full h-full hover:scale-105 transition transform focus:outline-none rounded-lg overflow-hidden shadow-md border-2 border-transparent hover:border-grapefruit">
                <img src="{{ asset('storage/' . $img->url) }}" class="w-full h-full object-cover" alt="Imagen API">
            </button>
        </form>
    @empty
        <p class="text-xs text-gray-500 col-span-2">No hay imágenes aprobadas en la API.</p>
    @endforelse
</div>
    </div>

    <div class="w-full md:w-3/4 bg-white border-2 border-dashed border-gray-300 p-6 rounded-lg relative">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-fantasy text-3xl text-cerulean">Moodboard: {{ $mundo->titulo }}</h2>
            <a href="{{ route('mundos.show', $mundo->id) }}" class="text-grapefruit hover:text-apricot font-bold">← Volver al Mundo</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 content-start">
    @forelse($imagenesGuardadas as $guardada)
        <div class="relative group aspect-square rounded-lg overflow-hidden shadow-lg border border-gray-200">
            <img src="{{ asset('storage/' . $guardada->url) }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" alt="Imagen en Moodboard">
        </div>
    @empty
        <div class="col-span-full flex flex-col items-center justify-center h-64 text-gray-400">
            <span class="text-5xl mb-2">🖼️</span>
            <p>Tu cuadrícula está vacía. Selecciona imágenes del banco de la API.</p>
        </div>
    @endforelse
</div>
    </div>
</div>

@endsection