@extends('layouts.libreta')

@section('hoja')
<div class="max-w-6xl mx-auto bg-white p-8 md:p-10 rounded-xl shadow-lg border-2 border-turquoise/30">
    
    <div class="mb-8 border-b-2 border-turquoise pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="font-fantasy text-4xl text-cerulean flex items-center gap-3">
                Panel de Administración
            </h2>
            <p class="text-gray-600 mt-2 text-lg">
                Revisa y aprueba el contenido subido por la comunidad.
            </p>
        </div>
    </div>

    <div class="bg-old-lace/50 p-6 rounded-xl border border-turquoise/30 mb-10 shadow-inner">
        <h3 class="font-bold text-cerulean text-xl mb-2 flex items-center gap-2">
            Invitar a Colaboradores
        </h3>
        <p class="text-gray-600 mb-4 text-sm">Envía una invitación formal con enlace seguro para colaborar en la API.</p>
        
        <form action="{{ route('admin.invitar') }}" method="POST" class="flex flex-col sm:flex-row gap-4 items-center">
            @csrf
            <div class="w-full sm:w-2/3">
                <input type="email" name="email" placeholder="correo@ejemplo.com" required 
                    class="w-full text-gray-700 px-4 py-3 border-2 border-turquoise/30 rounded-lg focus:outline-none focus:border-turquoise focus:ring-2 focus:ring-turquoise/20 bg-white shadow-sm transition-all">
            </div>
            <button type="submit" class="w-full sm:w-1/3 bg-cerulean hover:bg-turquoise text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                Enviar Invitación
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        
        <div class="bg-white p-6 rounded-xl border-2 border-gray-100 shadow-md hover:shadow-lg transition">
            <h3 class="text-center font-bold text-cerulean text-lg mb-4 border-b border-gray-100 pb-2">Volumen de Contenido Global</h3>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="graficoVolumen"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border-2 border-gray-100 shadow-md hover:shadow-lg transition">
            <h3 class="text-center font-bold text-cerulean text-lg mb-4 border-b border-gray-100 pb-2">Top 5 Creadores Activos</h3>
            <div class="relative h-64 w-full">
                <canvas id="graficoUsuarios"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Paleta Noteworld para JS
        const colorCerulean = '#007BA7';
        const colorTurquoise = '#40E0D0';
        const colorGrapefruit = '#FD5956';

        // Gráfico 1: Dona
        const ctxVolumen = document.getElementById('graficoVolumen').getContext('2d');
        new Chart(ctxVolumen, {
            type: 'doughnut', // 'doughnut' suele verse más moderno que 'pie'
            data: {
                labels: ['Mundos', 'Personajes', 'Lore'],
                datasets: [{
                    data: [{{ $totalMundos }}, {{ $totalPersonajes }}, {{ $totalEntradas }}],
                    backgroundColor: [
                        colorCerulean,
                        colorTurquoise,
                        colorGrapefruit
                    ],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Gráfico 2: Barras
        const ctxUsuarios = document.getElementById('graficoUsuarios').getContext('2d');
        new Chart(ctxUsuarios, {
            type: 'bar',
            data: {
                labels: @json($nombresUsuarios),
                datasets: [{
                    label: 'Mundos Creados',
                    data: @json($cantidadMundosUsuarios),
                    backgroundColor: colorTurquoise + '80', // Color con opacidad
                    borderColor: colorTurquoise,
                    borderWidth: 2,
                    borderRadius: 4 // Bordes redondeados en las barras
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>

    <div>
        <h3 class="font-fantasy text-3xl text-cerulean mb-6 border-b-2 border-turquoise pb-2">
            Imágenes Pendientes de Revisión
        </h3>
        
        @if($imagenesPendientes->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($imagenesPendientes as $imagen)
                    <div class="bg-gray-50 border border-gray-200 p-3 rounded-xl shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        
                        <div class="aspect-square w-full mb-3 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset('storage/' . $imagen->url) }}" alt="Pendiente" class="w-full h-full object-cover">
                        </div>
                        
                        <p class="text-xs text-gray-500 mb-3 text-center font-bold">
                            Ref: <span class="uppercase text-cerulean">{{ $imagen->ref_type }} #{{ $imagen->ref_id }}</span>
                        </p>
                        
                        <div class="flex gap-2 justify-center">
                            <form action="{{ route('admin.imagenes.aprobar', $imagen->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white text-sm font-bold py-2 px-2 rounded transition shadow-sm">
                                    ✓ Aprobar
                                </button>
                            </form>

                            <form action="{{ route('admin.imagenes.rechazar', $imagen->id) ?? '#' }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-grapefruit hover:bg-red-600 text-white text-sm font-bold py-2 px-2 rounded transition shadow-sm">
                                    ✗ Rechazar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-green-50 text-green-700 p-6 rounded-xl border border-green-200 text-center flex flex-col items-center">
                
                <p class="font-bold text-lg">Todo está al día.</p>
                <p class="text-sm">No hay imágenes pendientes de moderación en este momento.</p>
            </div>
        @endif
    </div>

</div>
@endsection