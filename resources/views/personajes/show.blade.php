@extends('layouts.libreta')

@section('hoja')
    <h2>👤 {{ $personaje->nombre }}</h2>
    <p><strong>Mundo:</strong> {{ $personaje->mundo->titulo ?? 'Desconocido' }}</p>

    <div style="background: #fafafa; padding: 15px; border: 1px solid #ddd; margin-bottom: 20px;">
        <p><strong>Biografía:</strong></p>
        <p>{{ $personaje->biografia ?? 'Aún no hay biografía escrita.' }}</p>
        
        <p><strong>Apariencia Física:</strong></p>
        <p>{{ $personaje->apariencia_fisica ?? 'Sin detalles.' }}</p>
        
        <p><strong>Personalidad:</strong></p>
        <p>{{ $personaje->personalidad ?? 'Sin detalles.' }}</p>
    </div>

    <div style="margin-bottom: 20px;">
        <a href="#" style="display:inline-block; padding:10px; background:#4CAF50; color:#fff; text-decoration:none;">Ver / Editar Moodboard del Personaje</a>
    </div>

    <a href="{{ route('personajes.index') }}" style="text-decoration: none; color: blue;">← Volver a Personajes</a>
@endsection