@extends('layouts.libreta')

@section('hoja')
    <h2>👤 Crear Nuevo Personaje</h2>
    <p style="color: #666;">Llenando la ficha para el mundo: <strong>{{ \App\Models\Mundo::find($mundoSeleccionadoId)->titulo }}</strong></p>
    
    <form action="{{ route('personajes.store') }}" method="POST">
        @csrf

        <input type="hidden" name="mundo_id" value="{{ $mundoSeleccionadoId }}">

        <div class="form-group">
            <label for="nombre">Nombre Completo *</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ej. Aragorn, hijo de Arathorn">
        </div>

        <div style="display: flex; gap: 15px;">
            <div class="form-group" style="flex: 1;">
                <label for="edad">Edad / Tiempo</label>
                <input type="text" name="edad" id="edad" value="{{ old('edad') }}" placeholder="Ej. 87 años">
            </div>
            <div class="form-group" style="flex: 1;">
                <label for="genero">Género</label>
                <input type="text" name="genero" id="genero" value="{{ old('genero') }}" placeholder="Ej. Masculino">
            </div>
            <div class="form-group" style="flex: 1;">
                <label for="especie">Especie / Raza</label>
                <input type="text" name="especie" id="especie" value="{{ old('especie') }}" placeholder="Ej. Dúnadan">
            </div>
        </div>

        <div class="form-group">
            <label for="biografia">Historia / Biografía</label>
            <textarea name="biografia" id="biografia" rows="4">{{ old('biografia') }}</textarea>
        </div>

        <div class="form-group">
            <label for="apariencia_fisica">Apariencia Física</label>
            <textarea name="apariencia_fisica" id="apariencia_fisica" rows="3" placeholder="Color de ojos, cicatrices, vestimenta..."></textarea>
        </div>

        <div class="form-group">
            <label for="personalidad">Personalidad y Rasgos</label>
            <textarea name="personalidad" id="personalidad" rows="3" placeholder="Miedos, virtudes, vicios..."></textarea>
        </div>

        <button type="submit" style="padding:10px 20px; background: #000; color: #fff; border: none; cursor:pointer;">Guardar Ficha de Personaje</button>
        <a href="{{ route('mundos.show', $mundoSeleccionadoId) }}" style="margin-left: 10px; color: #666;">Cancelar</a>
    </form>
@endsection