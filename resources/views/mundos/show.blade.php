@extends('layouts.libreta')

@section('hoja')
    <h2>🌍 {{ $mundo->titulo }}</h2>
<p>{{ $mundo->descripcion }}</p>

@can('update', $mundo)
    <div class="botones-de-creacion" style="margin-bottom: 20px; padding: 10px; background: #f9f9f9; border: 1px dashed #ccc;">
        <p style="font-size: 12px; color: #666; margin-top: 0;">Herramientas de Creador:</p>
        
        <a href="{{ route('mundos.moodboard', $mundo->id) }}" class="btn">Editar Moodboard</a>
        
        <a href="{{ route('personajes.create', ['mundo_id' => $mundo->id]) }}" class="btn">Agregar Personaje</a>
        
        <a href="{{ route('entradas.create', ['mundo_id' => $mundo->id]) }}" class="btn">Agregar Entrada</a>
        
        <a href="{{ route('mundos.edit', $mundo->id) }}" class="btn">Editar Mundo</a>
    </div>
@endcan

<h3>Personajes en este mundo</h3>
<ul>
    @forelse($mundo->personajes as $personaje)
        <li><a href="{{ route('personajes.show', $personaje->id) }}">{{ $personaje->nombre }}</a></li>
    @empty
        <p>Aún no hay personajes.</p>
    @endforelse
</ul>

    <hr>

    <div style="margin-top: 20px;">
        <h3>📜 Lore e Historias</h3>
        
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
        <a href="{{ route('dashboard.escritor') }}" style="text-decoration: none; color: blue;">← Volver a mi escritorio</a>
    </div>

    <div style="margin-bottom: 20px;">
    <strong>Generar Reporte PDF:</strong>
    <a href="{{ route('mundos.pdf', $mundo->id) }}" style="background: #e74c3c; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px;">📕 Descargar Biblia del Mundo</a>
    
    <a href="{{ route('mundos.pdf', $mundo->id) }}" style="background: #e74c3c; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px;">📕 Descargar Biblia del Mundo</a>
</div>
@endsection