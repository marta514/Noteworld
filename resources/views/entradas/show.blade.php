@extends('layouts.libreta')

@section('hoja')
    <span style="background: #eee; padding: 3px 8px; font-size: 12px;">Categoría: {{ $entrada->categoria }}</span>
    <h2>📜 {{ $entrada->titulo }}</h2>
    <p><strong>Mundo:</strong> {{ $entrada->mundo->titulo ?? 'Desconocido' }}</p>

    <hr>

    <div style="margin-top: 20px; line-height: 1.6;">
        <p>{{ $entrada->contenido }}</p>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('entradas.index') }}" style="text-decoration: none; color: blue;">← Volver al Índice de Lore</a>
    </div>
@endsection