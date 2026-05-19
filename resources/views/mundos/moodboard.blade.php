@extends('layouts.libreta')

@section('hoja')
    <h2>🎨 Moodboard: {{ $mundo->titulo }}</h2>
    <a href="{{ route('mundos.show', $mundo->id) }}" style="text-decoration: none; color: blue;">← Volver al Mundo</a>
    <hr>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <aside style="width: 200px; border-right: 1px solid #ccc; padding-right: 10px;">
            <h3>Colecciones</h3>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 10px;"><a href="#">🌤️ Clima</a></li>
                <li style="margin-bottom: 10px;"><a href="#">⛰️ Relieve</a></li>
                <li style="margin-bottom: 10px;"><a href="#">👕 Ropa</a></li>
                <li style="margin-bottom: 10px;"><a href="#">👁️ Ojos</a></li>
            </ul>
            <button style="width: 100%; padding: 5px; margin-top:10px;">+ Subir Imagen</button>
        </aside>

        <main style="flex-grow: 1; display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px;">
            <div style="height: 150px; background: #ddd; display: flex; align-items: center; justify-content: center;">Imagen 1</div>
            <div style="height: 150px; background: #ddd; display: flex; align-items: center; justify-content: center;">Imagen 2</div>
            <div style="height: 150px; background: #ddd; display: flex; align-items: center; justify-content: center;">Imagen 3</div>
        </main>
    </div>
@endsection