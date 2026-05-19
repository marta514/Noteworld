@extends('layouts.libreta')

@section('hoja')
    <h2>🌍 {{ $mundo->titulo }}</h2>
    <p><strong>Descripción:</strong></p>
    <p>{{ $mundo->descripcion }}</p>

    <hr>
    
    <div style="margin-top: 20px;">
        <h3>🎨 Moodboard</h3>
        <a href="{{ route('mundos.moodboard', $mundo->id) }}" style="display:inline-block; padding:5px 10px; background:#4CAF50; color:#fff; text-decoration:none;">Ver / Editar Moodboard</a>
    </div>

    <hr>

    <div style="margin-top: 20px;">
        <h3>👤 Personajes en este mundo</h3>
        <a href="{{ route('personajes.create', ['mundo_id' => $mundo->id]) }}" style="text-decoration:none; color:green;">+ Añadir Personaje a este mundo</a>
        
        <ul>
            @forelse($mundo->personajes as $personaje)
                <li>
                    <a href="{{ route('personajes.show', $personaje->id) }}">{{ $personaje->nombre }}</a>
                </li>
            @empty
                <p style="color: #666;">Aún no hay personajes creados en este mundo.</p>
            @endforelse
        </ul>
    </div>

    <hr>

    <div style="margin-top: 20px;">
        <h3>📜 Lore e Historias</h3>
        <a href="{{ route('entradas.create', ['mundo_id' => $mundo->id]) }}" style="text-decoration:none; color:green;">+ Escribir nueva entrada</a>
        
        <ul>
            @forelse($mundo->entradas as $entrada)
                <li>
                    <a href="{{ route('entradas.show', $entrada->id) }}">{{ $entrada->titulo }}</a> <span style="font-size:12px; color:gray;">({{ $entrada->categoria }})</span>
                </li>
            @empty
                <p style="color: #666;">Aún no has escrito historias para este mundo.</p>
            @endforelse
        </ul>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('mundos.index') }}" style="text-decoration: none; color: blue;">← Volver al índice de mundos</a>
    </div>
@endsection