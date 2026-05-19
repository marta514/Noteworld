@extends('layouts.libreta')

@section('hoja')
    <h2>Crear un Nuevo Mundo</h2>
    
    <form action="{{ route('mundos.store') }}" method="POST">
        @csrf {{-- Token de seguridad obligatorio en Laravel --}}

        <div class="form-group">
            <label for="titulo">Título del Mundo *</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción / Introducción *</label>
            <textarea name="descripcion" id="descripcion" rows="5">{{ old('descripcion') }}</textarea>
        </div>

        <button type="submit" style="padding:10px 20px; cursor:pointer;">Guardar Mundo</button>
    </form>
@endsection