@extends('layouts.libreta')

@section('hoja')
    <h2>Crear Nuevo Personaje</h2>
    
    <form action="{{ route('personajes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="mundo_id">¿A qué mundo pertenece? *</label>
            <select name="mundo_id" id="mundo_id">
                <option value="">-- Selecciona un mundo --</option>
                {{-- Esto requiere que pases $mundos desde el PersonajeController --}}
                @foreach($mundos ?? [] as $mundo)
                    <option value="{{ $mundo->id }}" {{ old('mundo_id') == $mundo->id ? 'selected' : '' }}>
                        {{ $mundo->titulo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre del Personaje *</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
        </div>

        <div class="form-group">
            <label for="biografia">Biografía (Opcional)</label>
            <textarea name="biografia" id="biografia" rows="4">{{ old('biografia') }}</textarea>
        </div>

        <button type="submit" style="padding:10px 20px; cursor:pointer;">Guardar Personaje</button>
    </form>
@endsection