@extends('layouts.libreta')

@section('hoja')
    <h2>🎨 Moodboard de: {{ $mundo->titulo }}</h2>
    <a href="{{ route('mundos.show', $mundo->id) }}" style="text-decoration: none; color: blue;">← Volver al Mundo</a>
    <hr>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <aside style="width: 200px; border-right: 1px solid #ccc; padding-right: 10px;">
            <h3>Subcarpetas API</h3>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 10px;"><a href="#">☁️ Clima</a></li>
                <li style="margin-bottom: 10px;"><a href="#">⛰️ Relieve</a></li>
            </ul>
        </aside>

        <main style="flex-grow: 1;">
            <h3>Galería Aprobada</h3>
            @if($imagenesAprobadas->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                    @foreach($imagenesAprobadas as $img)
                        <img src="{{ $img->url }}" style="width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    @endforeach
                </div>
            @else
                <p style="color: #999;">Aún no hay imágenes aprobadas para este moodboard.</p>
            @endif
        </main>
    </div>
@endsection