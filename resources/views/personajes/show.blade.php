@extends('layouts.libreta')

@section('hoja')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg border-2 border-turquoise/30">
    
    <div class="mb-8 border-b-2 border-turquoise pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="font-fantasy text-5xl text-cerulean flex items-center gap-3">
                 {{ $personaje->nombre }}
            </h2>
            <p class="text-gray-500 mt-3 text-lg">
                Habitante de: 
                <a href="{{ route('mundos.show', $personaje->mundo_id) }}" class="text-grapefruit font-bold hover:text-apricot transition">
                    {{ $personaje->mundo->titulo ?? 'Desconocido' }}
                </a>
            </p>
        </div>
        <a href="{{ route('mundos.show', $personaje->mundo_id) }}" class="text-gray-400 hover:text-grapefruit transition duration-300 font-bold mb-2">
            ← Volver al Mundo
        </a>
    </div>

    <div class="flex flex-wrap gap-4 mb-8">
        @if($personaje->edad)
            <div class="bg-old-lace px-4 py-2 rounded-full border border-turquoise/40 text-cerulean font-bold shadow-sm">
                Edad: <span class="text-gray-700 font-normal">{{ $personaje->edad }}</span>
            </div>
        @endif
        @if($personaje->genero)
            <div class="bg-old-lace px-4 py-2 rounded-full border border-turquoise/40 text-cerulean font-bold shadow-sm">
                Género: <span class="text-gray-700 font-normal">{{ $personaje->genero }}</span>
            </div>
        @endif
        @if($personaje->especie)
            <div class="bg-old-lace px-4 py-2 rounded-full border border-turquoise/40 text-cerulean font-bold shadow-sm">
                Especie: <span class="text-gray-700 font-normal">{{ $personaje->especie }}</span>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        
        <div class="md:col-span-2 bg-old-lace/40 p-6 rounded-xl border border-turquoise/20 shadow-inner">
            <h3 class="font-bold text-cerulean text-2xl mb-3 border-b border-turquoise/30 pb-2 font-fantasy">Historia y Biografía</h3>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $personaje->biografia ?? 'Aún no hay biografía escrita.' }}</p>
        </div>

        <div class="bg-old-lace/40 p-6 rounded-xl border border-turquoise/20 shadow-inner">
            <h3 class="font-bold text-cerulean text-xl mb-3 border-b border-turquoise/30 pb-2">Apariencia Física</h3>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $personaje->apariencia_fisica ?? 'Sin detalles.' }}</p>
        </div>

        <div class="bg-old-lace/40 p-6 rounded-xl border border-turquoise/20 shadow-inner">
            <h3 class="font-bold text-cerulean text-xl mb-3 border-b border-turquoise/30 pb-2">Personalidad y Rasgos</h3>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $personaje->personalidad ?? 'Sin detalles.' }}</p>
        </div>

    </div>

    <div class="pt-6 border-t-2 border-turquoise/20 flex flex-col sm:flex-row items-center justify-between gap-4">
        
        <a href="{{ route('personajes.moodboard', $personaje->id) }}" class="w-full sm:w-auto bg-cerulean hover:bg-turquoise text-white font-bold text-lg py-3 px-8 rounded-xl transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center justify-center gap-3">
            <span class="text-2xl"></span> Abrir Moodboard
        </a>

        @if(auth()->check() && $personaje->mundo->user_id == auth()->id())
        <a href="{{ route('personajes.edit', $personaje->id) }}" class="w-full sm:w-auto bg-white border-2 border-cerulean text-cerulean hover:bg-cerulean hover:text-white font-bold text-lg py-3 px-8 rounded-xl transition duration-300 shadow-sm flex items-center justify-center gap-3">
            Editar Ficha
        </a>
    @endif


    </div>


</div>
@endsection