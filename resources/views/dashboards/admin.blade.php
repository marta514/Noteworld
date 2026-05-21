@extends('layouts.libreta')

@section('hoja')
    <h2>🛡️ Panel de Administración</h2>
    <p>Revisa y aprueba el contenido subido por la comunidad.</p>
    <hr>

    <h3>🖼️ Imágenes Pendientes de Revisión</h3>
    
    @if($imagenesPendientes->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-top: 20px;">
            @foreach($imagenesPendientes as $imagen)
                <div style="border: 1px solid #ccc; padding: 10px; border-radius: 8px; text-align: center; background: white;">
                    <img src="{{ $imagen->url }}" alt="Pendiente" style="width: 100%; height: 150px; object-fit: cover; border-radius: 4px;">
                    
                    <p style="font-size: 12px; color: #666; margin: 10px 0;">Referencia: {{ $imagen->ref_type }} #{{ $imagen->ref_id }}</p>
                    
                    <form action="{{ route('admin.imagenes.aprobar', $imagen->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('PATCH')
    <button type="submit" style="background: #4CAF50; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">
        Aprobar
    </button>
</form>
                    <button style="background: #f44336; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">Rechazar</button>
                </div>
            @endforeach
        </div>
    @else
        <p style="color: #777;">Todo está al día. No hay imágenes pendientes.</p>
    @endif
@endsection