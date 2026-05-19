@extends('layouts.libreta')

@section('hoja')
    <h2>Escribir Nueva Entrada (Lore)</h2>
    
    <form action="{{ route('entradas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="mundo_id">¿De qué mundo es esta historia? *</label>
            <select name="mundo_id" id="mundo_id">
                <option value="">-- Selecciona un mundo --</option>
                @foreach($mundos ?? [] as $mundo)
                    <option value="{{ $mundo->id }}" {{ old('mundo_id') == $mundo->id ? 'selected' : '' }}>
                        {{ $mundo->titulo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Título de la Entrada *</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}">
        </div>

        <div class="form-group">
            <label for="categoria">Categoría *</label>
            <select name="categoria" id="categoria">
                <option value="">-- Elige una categoría --</option>
                <option value="Historia" {{ old('categoria') == 'Historia' ? 'selected' : '' }}>Historia</option>
                <option value="Religión" {{ old('categoria') == 'Religión' ? 'selected' : '' }}>Religión</option>
                <option value="Geografía" {{ old('categoria') == 'Geografía' ? 'selected' : '' }}>Geografía</option>
                <option value="Magia" {{ old('categoria') == 'Magia' ? 'selected' : '' }}>Magia</option>
            </select>
        </div>

        <div class="form-group">
            <label for="contenido">Contenido *</label>
            <textarea name="contenido" id="contenido" rows="8">{{ old('contenido') }}</textarea>
        </div>

        <button type="submit" style="padding:10px 20px; cursor:pointer;">Guardar Entrada</button>
    </form>
@endsection