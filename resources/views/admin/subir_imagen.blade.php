@extends('layouts.libreta')

@section('hoja')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-lg border border-gray-200">
    <h2 class="font-fantasy text-3xl text-cerulean mb-6">Cargar Imagen a la API</h2>

    <form id="apiUploadForm" class="space-y-6">
        @csrf
        <select name="ref_type" id="ref_type" class="w-full border-2 border-gray-200 rounded-lg p-3">
    <option value="mundo">Mundo</option>
    <option value="personaje">Personaje</option>
</select>

<select name="collection_id" id="collectionSelect" class="w-full border-2 border-gray-200 rounded-lg p-3">
    </select>

        <div>
            <label class="block font-bold text-gray-700">Seleccionar Imagen</label>
            <input type="file" name="imagen" id="imagenInput" accept="image/*" class="w-full p-3 border-2 border-dashed border-gray-300 rounded-lg" required>
        </div>

        <button type="button" onclick="subirAAPI()" class="w-full bg-cerulean text-white font-bold py-3 rounded-lg hover:bg-turquoise transition">
            Subir a la API
        </button>
    </form>
</div>

<script>
// 1. Cargar colecciones al abrir la página
document.addEventListener('DOMContentLoaded', async () => {
    const select = document.getElementById('collectionSelect');
    
    try {
        const response = await fetch('/api/colecciones', {
            method: 'GET',
            headers: { 
                'Authorization': 'Bearer 1|JLPoAzor8eKlwDiDHbHonQ3N4XN3jMp3ZR5XE8Ob6edb4da6',
                'Accept': 'application/json' 
            }
        });

        if (!response.ok) throw new Error('Error al conectar con la API');

        const colecciones = await response.json();
        select.innerHTML = ''; 
        
        colecciones.forEach(col => {
            select.innerHTML += `<option value="${col.id}">${col.nombre}</option>`;
        });
    } catch (error) {
        console.error(error);
        select.innerHTML = '<option>Error al cargar colecciones</option>';
    }
});

// 2. Función de subida
async function subirAAPI() {
    const fileInput = document.getElementById('imagenInput');
    const refTypeEl = document.getElementById('ref_type'); // Usamos ID
    const colSelect = document.getElementById('collectionSelect'); // Usamos ID

    // Validación para evitar el error de "null"
    if (!refTypeEl || !colSelect) {
        alert("Error: No se encontraron los campos del formulario");
        return;
    }

    const formData = new FormData();
    formData.append('imagen', fileInput.files[0]);
    formData.append('ref_type', refTypeEl.value);
    formData.append('collection_id', colSelect.value);


    try {
        const response = await fetch('/api/imagenes', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer 1|JLPoAzor8eKlwDiDHbHonQ3N4XN3jMp3ZR5XE8Ob6edb4da6',
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await response.json();
        
        if (response.ok) {
            alert("¡Éxito! Subido a la API");
        } else {
            console.log(data);
            alert("Error al subir: " + JSON.stringify(data.errors || data.message));
        }
    } catch (error) {
        alert("Error de red: " + error.message);
    }
}
</script>
@endsection