<?php 

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Collection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
{
    return view('admin.panel', [
        'totalMundos' => Mundo::count(),
        'totalPersonajes' => Personaje::count(),
        'totalEntradas' => Entrada::count(),
        'nombresUsuarios' => User::limit(5)->pluck('name'),
        'cantidadMundosUsuarios' => User::limit(5)->withCount('mundos')->pluck('mundos_count'),
        'imagenesPendientes' => Image::where('estado', 'pending')->get()
    ]);
}
    // Muestra el formulario con las colecciones disponibles
    public function crearImagen()
    {
        $colecciones = Collection::all();
        return view('admin.subir_imagen', compact('colecciones'));
    }

    // Procesa la subida del formulario
    public function storeImagen(Request $request)
{
    $path = $request->file('imagen')->store('moodboard', 'public');

    \App\Models\Image::create([
        'url' => basename($path), // Solo el nombre, la vista añade 'moodboard/'
        'ref_type' => $request->ref_type,
        'ref_id' => $request->ref_id,
        'collection_id' => $request->collection_id,
        'estado' => 'approved',
        'user_id' => auth()->id() // Soluciona el error anterior
    ]);

    return redirect()->back()->with('success', 'Imagen subida');
}
// En tu MundoController.php o donde muestres el moodboard
public function moodboard(Mundo $mundo) 
{
    $colecciones = \App\Models\Collection::all();
    // Trae las imágenes directo de la BD usando el Modelo, esto NUNCA falla
    $imagenes = \App\Models\Image::where('estado', 'approved')->get();

    return view('mundos.moodboard', compact('mundo', 'colecciones', 'imagenes'));
}
}