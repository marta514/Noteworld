@extends('layouts.libreta')

@section('hoja')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg border-2 border-turquoise/30">
    
    <div class="mb-8 border-b-2 border-turquoise pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="font-fantasy text-4xl text-cerulean flex items-center gap-3">
                Editar Entrada
            </h2>
            <p class="text-gray-600 mt-2">
                Modificando registro del mundo: <strong class="text-grapefruit">{{ $entrada->mundo->titulo ?? 'Desconocido' }}</strong>
            </p>
        </div>
    </div>

    <form action="{{ route('entradas.update', $entrada->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="mundo_id" value="{{ $entrada->mundo_id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="titulo" class="block text-lg font-bold text-cerulean mb-2">Título de la Entrada *</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $entrada->titulo) }}" required
                    class="w-full text-gray-800 px-4 py-3 border-2 border-turquoise/40 rounded-xl focus:outline-none focus:border-turquoise focus:ring-4 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all text-lg">
            </div>
            
            <div>
                <label for="categoria" class="block text-lg font-bold text-cerulean mb-2">Categoría *</label>
                <select name="categoria" id="categoria" required
                    class="w-full text-gray-800 px-4 py-3 border-2 border-turquoise/40 rounded-xl focus:outline-none focus:border-turquoise focus:ring-4 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all text-lg cursor-pointer appearance-none">
                    <option value="" disabled>-- Elige una categoría --</option>
                    <option value="Historia" {{ old('categoria', $entrada->categoria) == 'Historia' ? 'selected' : '' }}>Historia</option>
                    <option value="Religión" {{ old('categoria', $entrada->categoria) == 'Religión' ? 'selected' : '' }}>Religión</option>
                    <option value="Geografía" {{ old('categoria', $entrada->categoria) == 'Geografía' ? 'selected' : '' }}>Geografía</option>
                    <option value="Magia" {{ old('categoria', $entrada->categoria) == 'Magia' ? 'selected' : '' }}>Magia</option>
                    <option value="Capítulo" {{ old('categoria', $entrada->categoria) == 'Capítulo' ? 'selected' : '' }}>Capítulo</option>
                </select>
            </div>
        </div>

        <div class="pt-2">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-3 gap-4">
                <label for="contenido" class="block text-lg font-bold text-cerulean">Contenido del Lore *</label>
                
                <div class="flex items-center gap-3">
                    <span id="ia-loading" class="hidden text-indigo-500 font-bold text-sm animate-pulse flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Invocando musas...
                    </span>
                    
                    <button type="button" id="btn-inspirar" class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-2 px-5 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-1 flex items-center gap-2 focus:outline-none focus:ring-4 focus:ring-purple-500/30">
                        ✨ Expandir con IA
                    </button>
                </div>
            </div>
            
            <textarea name="contenido" id="contenido" rows="12" required 
                class="w-full text-gray-700 px-4 py-4 border-2 border-turquoise/30 rounded-xl focus:outline-none focus:border-turquoise focus:ring-4 focus:ring-turquoise/20 bg-old-lace/30 shadow-inner transition-all resize-y leading-relaxed text-lg">{{ old('contenido', $entrada->contenido) }}</textarea>
        </div>

        <div class="pt-6 border-t-2 border-turquoise/20 flex items-center justify-end gap-6 mt-8">
            <a href="{{ route('entradas.show', $entrada->id) }}" class="text-gray-500 hover:text-grapefruit font-bold transition duration-300">
                Cancelar
            </a>
            <button type="submit" class="bg-cerulean hover:bg-turquoise text-white font-bold text-lg py-3 px-8 rounded-xl transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 esquina-cortada">
                Actualizar Entrada
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('btn-inspirar').addEventListener('click', async function() {
        const titulo = document.getElementById('titulo').value;
        const btn = this;
        const loading = document.getElementById('ia-loading');
        const contenido = document.getElementById('contenido');

        if (!titulo) {
            alert('¡Escribe un título primero para que la IA sepa de qué trata!');
            document.getElementById('titulo').focus();
            return;
        }

        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
        loading.classList.remove('hidden');

        try {
            const response = await fetch('{{ route('ia.inspirar') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ titulo: titulo })
            });

            const data = await response.json();

            if (response.ok) {
                // Al editar, añadimos lo nuevo al final de lo que ya estaba escrito
                const textoExistente = contenido.value.trim();
                contenido.value = (textoExistente ? textoExistente + "\n\n" : "") + data.inspiracion;
                
                contenido.classList.add('ring-4', 'ring-purple-400/50');
                setTimeout(() => contenido.classList.remove('ring-4', 'ring-purple-400/50'), 1000);
            } else {
                alert(data.error || 'Ocurrió un error al contactar la IA.');
            }
        } catch (error) {
            alert('Error de conexión con el servidor. Revisa tu internet o tu archivo .env');
        } finally {
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            loading.classList.add('hidden');
        }
    });
</script>
@endsection