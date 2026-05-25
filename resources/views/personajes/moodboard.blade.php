@extends('layouts.libreta')
@section('hoja')

@php
    // Verificamos si el usuario logueado es el creador del MUNDO al que pertenece el personaje
    $esCreador = auth()->check() && auth()->user()->id === $personaje->mundo->user_id;
@endphp

<div class="flex flex-col md:flex-row gap-6 h-[800px]">
    
    @if($esCreador)
    <div class="w-full md:w-1/4 bg-old-lace border-2 border-turquoise p-4 rounded-lg overflow-y-auto shadow-inner">
        <h3 class="font-fantasy text-xl text-cerulean mb-4 border-b border-turquoise pb-2">Banco de Personajes</h3>
        <p class="text-sm text-gray-600 mb-4">Haz clic en una imagen para añadirla a la inspiración de {{ $personaje->nombre }}.</p>
        
        <div class="grid grid-cols-2 gap-3">
            @forelse($imagenesApi as $img)
                <form action="{{ route('personajes.moodboard.agregar', $personaje->id) }}" method="POST" class="aspect-square">
                    @csrf
                    <input type="hidden" name="image_id" value="{{ $img->id }}">
                    <button type="submit" class="w-full h-full hover:scale-105 transition transform focus:outline-none rounded-lg overflow-hidden shadow-md border-2 border-transparent hover:border-grapefruit">
                        <img src="{{ asset($img->url) }}" class="w-full h-full object-cover" alt="Imagen API">
                    </button>
                </form>
            @empty
                <p class="text-xs text-gray-500 col-span-2">No hay imágenes de personajes.</p>
            @endforelse
        </div>
    </div>
    @endif

    <div class="w-full {{ $esCreador ? 'md:w-3/4' : '' }} bg-white border-2 border-dashed border-gray-300 p-6 rounded-lg relative overflow-y-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4 border-b border-gray-100 pb-4">
            <div>
                <h2 class="font-fantasy text-3xl text-cerulean">Moodboard: {{ $personaje->nombre }}</h2>
                <p class="text-gray-500 text-sm mt-1">Inspiración visual en <strong>{{ $personaje->mundo->titulo }}</strong></p>
            </div>
            <a href="{{ route('personajes.show', $personaje->id) }}" class="text-grapefruit hover:text-apricot font-bold transition duration-300">
                ← Volver a la Ficha
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 content-start">
            @forelse($imagenesGuardadas as $guardada)
                <div class="relative group aspect-square rounded-lg overflow-hidden shadow-lg border border-gray-200 bg-gray-50 flex items-center justify-center">
                    <img src="{{ asset($guardada->url) }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" alt="Imagen en Moodboard">
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center h-64 text-gray-400 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                    <span class="text-5xl mb-2">🎨</span>
                    <p>{{ $esCreador ? 'El moodboard está vacío. Selecciona referencias visuales del panel izquierdo.' : 'Este moodboard aún no tiene referencias visuales.' }}</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection