@extends('layouts.libreta')

@section('hoja')
    <h2>Escribir Nueva Entrada (Lore)</h2>
    
    <form action="{{ route('entradas.store') }}" method="POST">
        @csrf

        <input type="hidden" name="mundo_id" value="{{ $mundoSeleccionadoId }}">

        <div class="form-group">
            <label for="titulo">Título de la Entrada *</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
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

        <!-- El botón mágico colocado estratégicamente antes del contenido -->
        <div style="margin: 15px 0;">
            <button type="button" id="btn-inspirar" style="background: #8e44ad; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                ✨ Inspirar con IA
            </button>
            <span id="ia-loading" style="display: none; color: #888; font-size: 12px; margin-left: 10px;">La IA está pensando... 🧠</span>
        </div>

        <div class="form-group">
            <label for="contenido">Contenido *</label>
            <textarea name="contenido" id="contenido" rows="10">{{ old('contenido') }}</textarea>
        </div>

        <button type="submit" style="padding:10px 20px; cursor:pointer; background: #2c3e50; color: white; border: none; border-radius: 5px;">Guardar Entrada</button>
    </form>

    <!-- El Script que hace la magia sin recargar la página -->
    <script>
        document.getElementById('btn-inspirar').addEventListener('click', async function() {
            const titulo = document.getElementById('titulo').value;
            const btn = this;
            const loading = document.getElementById('ia-loading');
            const contenido = document.getElementById('contenido');

            if (!titulo) {
                alert('¡Escribe un título primero para que la IA sepa de qué trata!');
                return;
            }

            // Cambiamos el estado visual
            btn.disabled = true;
            loading.style.display = 'inline';

            try {
                // Hacemos la petición a nuestra ruta de Laravel
                const response = await fetch('{{ route('ia.inspirar') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Súper importante por seguridad
                    },
                    body: JSON.stringify({ titulo: titulo })
                });

                const data = await response.json();

                if (response.ok) {
                    // Insertamos el texto de la IA en el textarea conservando lo que ya estuviera escrito
                    contenido.value = data.inspiracion + "\n\n" + contenido.value;
                } else {
                    alert(data.error || 'Ocurrió un error.');
                }
            } catch (error) {
                alert('Error de conexión con el servidor.');
            } finally {
                // Restauramos el botón
                btn.disabled = false;
                loading.style.display = 'none';
            }
        });
    </script>
@endsection