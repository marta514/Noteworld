<?php

namespace App\Http\Controllers;

use App\Models\Mundo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generarBiblia(Request $request, Mundo $mundo)
    {
        // Atrapamos un filtro opcional desde la URL (ej. ?categoria=Historia)
        $filtroCategoria = $request->query('categoria');

        // Cargamos los datos reales de la base de datos 
        $mundo->load(['personajes', 'entradas' => function($query) use ($filtroCategoria) {
            // Si el usuario aplicó un filtro, lo agregamos a la consulta
            if ($filtroCategoria) {
                $query->where('categoria', $filtroCategoria);
            }
        }]);

        // Generamos el PDF apuntando a una vista que crearemos en el siguiente paso
        $pdf = Pdf::loadView('pdfs.biblia', compact('mundo', 'filtroCategoria'));

        
        // stream() abre el PDF directamente en el navegador 
        // Si prefieres que se descargue automáticamente, usa download() en lugar de stream()
        return $pdf->download('Biblia_de_' . $mundo->titulo . '.pdf');
    }
}