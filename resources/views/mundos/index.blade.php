@extends('layouts.libreta')

@section('hoja')
    <h2>Índice de Mundos</h2>
    <a href="{{ route('mundos.create') }}" style="display:inline-block; padding:10px; background:#000; color:#fff; text-decoration:none; margin-bottom:20px;">+ Crear Nuevo Mundo</a>

    <hr>
    
    <ul>
        {{-- Aquí iteraremos los mundos cuando los envíes desde el controlador --}}
        @forelse($mundos ?? [] as $mundo)
            <li>
                <strong>{{ $mundo->titulo }}</strong> - 
                <a href="#">Ver Detalles/Moodboard</a>
            </li>
        @empty
            <p>Aún no has creado ningún mundo. ¡Empieza tu universo ahora!</p>
        @endforelse
    </ul>
@endsection