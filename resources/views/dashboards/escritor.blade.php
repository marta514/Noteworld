@extends('layouts.libreta')

@section('hoja')
<div style="display: flex; gap: 40px;">
    
    <div style="flex: 1;">
       <div class="flex items-center justify-between mb-6">
    <h1 class="font-fantasy text-3xl">Hola, {{ auth()->user()->name ?? 'Escritor' }}</h1>
    
    <a href="{{ route('mundos.create') }}" class="bg-cerulean text-old-lace px-4 py-2 esquina-cortada font-bold hover:bg-grapefruit transition">
        + Crear Nuevo Mundo
    </a>
</div>

        <div class="seccion">
            <h2 class="font-fantasy text-xl border-b-2 border-turquoise mb-4">Tus Universos</h2>
            @if($misMundos->count() > 0)
                <div class="grid grid-cols-1 gap-4">
                    @foreach($misMundos as $mundo)
                        <a href="{{ route('mundos.show', $mundo->id) }}" class="bg-old-lace p-4 border-l-4 border-turquoise shadow-sm hover:shadow-md transition">
                            <h3 class="font-bold text-lg">{{ $mundo->titulo }}</h3>
                            <p class="text-sm text-gray-600">{{ Str::limit($mundo->descripcion, 60) }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Aún no has creado mundos.</p>
            @endif
        </div>

        <div style="flex: 1;">
    <div class="seccion">
        <h2 class="font-fantasy text-xl border-b-2 border-turquoise mb-4 py-2">Explorar la Comunidad</h2>
        <p class="text-sm text-gray-500 mb-4">Descubre lo que otros escritores están creando:</p>
        
        @if($comunidad->count() > 0)
            <div class="grid grid-cols-1 gap-4">
                @foreach($comunidad as $mundoAjeno)
                    <a href="{{ route('mundos.show', $mundoAjeno->id) }}" 
                       class="bg-white p-4 border border-turquoise rounded-lg hover:bg-old-lace transition block">
                        <h3 class="font-bold text-cerulean">{{ $mundoAjeno->titulo }}</h3>
                        <p class="text-xs text-gray-600">Creado por: {{ $mundoAjeno->user->name }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 italic">La comunidad aún no ha compartido mundos.</p>
        @endif
    </div>
</div>
    </div>

    <div style="flex: 1; border-left: 2px dashed #ccc; padding-left: 40px;">
        <h2 class="font-fantasy text-xl mb-6">Tus Métricas</h2>
        
        <div style="margin-bottom: 30px;">
            <h3 class="text-center font-bold text-cerulean">Personajes por Mundo</h3>
            <canvas id="graficoPersonajes"></canvas>
        </div>

        <div>
            <h3 class="text-center font-bold text-cerulean">Distribución de Lore</h3>
            <canvas id="graficoCategorias"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico 1: Barras
    const ctxPersonajes = document.getElementById('graficoPersonajes').getContext('2d');
    new Chart(ctxPersonajes, {
        type: 'bar',
        data: {
            labels: {!! json_encode($nombresMundos) !!},
            datasets: [{
                label: 'Personajes',
                data: {!! json_encode($cantidadPersonajes) !!},
                backgroundColor: '#24E5D2', // Turquoise
            }]
        }
    });

    // Gráfico 2: Dona
    const ctxCategorias = document.getElementById('graficoCategorias').getContext('2d');
    new Chart(ctxCategorias, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($nombresCategorias) !!},
            datasets: [{
                data: {!! json_encode($cantidadCategorias) !!},
                backgroundColor: ['#FE6D73', '#FFCB77', '#2584A7', '#24E5D2']
            }]
        }
    });
</script>
@endsection