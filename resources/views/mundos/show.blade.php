@extends('layouts.libreta')

@section('hoja')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-8 border-b-4 border-turquoise pb-4">
        <h2 class="font-fantasy text-4xl text-cerulean mb-2">{{ $mundo->titulo }}</h2>
        <p class="text-gray-700 italic text-lg leading-relaxed">{{ $mundo->descripcion }}</p>
    </div>

    @can('update', $mundo)
        <div class="bg-old-lace p-6 rounded-xl border border-turquoise mb-8 shadow-sm">
            <h4 class="font-bold text-sm text-gray-500 uppercase tracking-widest mb-4">Herramientas de Creador</h4>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('mundos.moodboard', $mundo->id) }}" class="bg-white border border-cerulean px-4 py-2 rounded-lg hover:bg-cerulean hover:text-white transition">Editar Moodboard</a>
                <a href="{{ route('personajes.create', ['mundo_id' => $mundo->id]) }}" class="bg-white border border-cerulean px-4 py-2 rounded-lg hover:bg-cerulean hover:text-white transition">+ Agregar Personaje</a>
                <a href="{{ route('entradas.create', ['mundo_id' => $mundo->id]) }}" class="bg-white border border-cerulean px-4 py-2 rounded-lg hover:bg-cerulean hover:text-white transition">+ Agregar Entrada</a>
                <a href="{{ route('mundos.edit', $mundo->id) }}" class="bg-white border border-gray-400 px-4 py-2 rounded-lg hover:bg-gray-200 transition">Editar Mundo</a>
            </div>
        </div>
    @endcan

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <div>
            <h3 class="font-fantasy text-2xl text-cerulean mb-4">Personajes</h3>
            <ul class="space-y-2">
                @forelse($mundo->personajes as $personaje)
                    <li class="bg-gray-50 p-3 rounded-lg border border-gray-100 hover:border-turquoise transition">
                        <a href="{{ route('personajes.show', $personaje->id) }}" class="font-bold text-gray-800">{{ $personaje->nombre }}</a>
                    </li>
                @empty
                    <p class="text-gray-500 italic">Aún no hay personajes en este mundo.</p>
                @endforelse
            </ul>
        </div>

        <div>
            <h3 class="font-fantasy text-2xl text-cerulean mb-4">Lore e Historias</h3>
            <ul class="space-y-3">
                @forelse($mundo->entradas as $entrada)
                    <li>
                        <a href="{{ route('entradas.show', $entrada->id) }}" class="block p-3 rounded-lg bg-white border border-gray-200 hover:shadow-md transition">
                            <span class="font-bold text-gray-800">{{ $entrada->titulo }}</span> 
                            <span class="block text-xs text-gray-500 uppercase">{{ $entrada->categoria }}</span>
                        </a>
                    </li>
                @empty
                    <p class="text-gray-500 italic">Aún no has escrito historias para este mundo.</p>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="mt-12 pt-6 border-t border-gray-200 flex justify-between items-center">
        <a href="{{ route('dashboard.escritor') }}" class="text-cerulean font-bold hover:underline">← Volver a mi escritorio</a>
        
        <div class="bg-old-lace/40 p-4 rounded-lg border border-turquoise/30 mt-6 shadow-sm max-w-xl">
    <h3 class="font-bold text-cerulean mb-2 flex items-center gap-2">
        📄 Descargar Biblia del Mundo
    </h3>
    <form action="{{ route('pdf.biblia', $mundo->id) }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
        
        <div class="flex-grow">
            <label for="categoria" class="block text-sm font-bold text-gray-600 mb-1">Filtrar Lore por Categoría (Opcional):</label>
            <select name="categoria" id="categoria" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-turquoise">
                <option value="">Todas las categorías</option>
                <option value="Historia">Historia</option>
                <option value="Religión">Religión</option>
                <option value="Geografía">Geografía</option>
                <option value="Magia">Magia</option>
            </select>
        </div>

        <button type="submit" class="bg-grapefruit hover:bg-apricot text-white font-bold py-2 px-6 rounded-md transition duration-300 shadow flex items-center gap-2">
            Descargar PDF
        </button>
    </form>
</div>
    </div>
</div>
@endsection