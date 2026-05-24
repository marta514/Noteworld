@extends('layouts.libreta')

@section('hoja')
<div class="max-w-5xl mx-auto bg-white p-8 md:p-12 rounded-xl shadow-lg border-2 border-turquoise/30 relative mt-6">
    
    <div class="absolute -top-4 right-8">
        <span class="bg-gradient-to-r from-cerulean to-turquoise text-white px-6 py-2 rounded-full font-bold shadow-md text-sm border-2 border-white flex items-center gap-2">
        {{ $entrada->categoria }}
        </span>
    </div>

    <div class="mb-8 border-b-2 border-turquoise/50 pb-6 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="font-fantasy text-5xl text-cerulean flex items-center gap-3 leading-tight mt-2">
                {{ $entrada->titulo }}
            </h2>
        </div>
    
    </div>

    <div class="bg-old-lace/40 p-8 md:p-12 rounded-xl border border-turquoise/20 shadow-inner min-h-[300px]">
        <p class="text-gray-800 leading-loose whitespace-pre-line text-lg font-serif">
            {{ $entrada->contenido }}
        </p>
    </div>

    <div class="pt-8 mt-8 border-t-2 border-turquoise/20 flex flex-col sm:flex-row items-center justify-between gap-4">
        
        <a href="{{ route('mundos.show', $entrada->mundo_id) }}" class="text-gray-500 hover:text-grapefruit font-bold transition duration-300 flex items-center gap-2">
            ← Volver al Mundo
        </a>

        @if(auth()->check() && $entrada->mundo->user_id == auth()->id())
    <a href="{{ route('entradas.edit', $entrada->id) }}" class="...">
        Editar Entrada
    </a>
@endif
        
    </div>
</div>
@endsection