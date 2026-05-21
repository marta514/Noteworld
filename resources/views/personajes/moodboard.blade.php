@extends('layouts.libreta')

@section('hoja')
    <h2>🎨 Moodboard de Personaje: {{ $personaje->nombre }}</h2>
    <p>Inspiración visual para el personaje en <strong>{{ $personaje->mundo->titulo }}</strong></p>
    
    <a href="{{ route('personajes.show', $personaje->id) }}" style="text-decoration: none; color: blue;">← Volver a la Ficha</a>
    <hr>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <aside style="width: 200px; border-right: 1px solid #ccc; padding-right: 10px;">
            <h3>Subcarpetas API</h3>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 10px;"><a href="#">👤 Rostros</a></li>
                <li style="margin-bottom: 10px;"><a href="#">⚔️ Armas</a></li>
                <li style="margin-bottom: 10px;"><a href="#">🛡️ Armaduras</a></li>
                <li style="margin-bottom: 10px;"><a href="#">🐎 Monturas</a></li>
            </ul>
        </aside>

        <main style="flex-grow: 1;">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                <div style="aspect-ratio: 1/1; background: #eee; border: 2px dashed #ccc; display: flex; align-items: center; justify-content: center; color: #999;">Imagen Personaje</div>
                <div style="aspect-ratio: 1/1; background: #eee; border: 2px dashed #ccc; display: flex; align-items: center; justify-content: center; color: #999;">Inspiración 1</div>
                <div style="aspect-ratio: 1/1; background: #eee; border: 2px dashed #ccc; display: flex; align-items: center; justify-content: center; color: #999;">Inspiración 2</div>
            </div>
        </main>
    </div>
@endsection