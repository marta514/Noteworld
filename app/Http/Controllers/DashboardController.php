<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mundo;
use App\Models\Personaje;
use App\Models\Entrada;
use App\Models\Image; // Agregamos el modelo Image para el Admin
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function escritor()
    {
        $userId = auth()->id();

        // 1. Lógica original: Cargar mundos y comunidad
        $misMundos = Mundo::withCount('personajes')
                          ->where('user_id', $userId)
                          ->get();
                          
        $comunidad = Mundo::where('user_id', '!=', $userId)
                          ->latest()
                          ->take(6)
                          ->get();

        // 2. Datos para Gráfico de Barras
        $nombresMundos = $misMundos->pluck('titulo');
        $cantidadPersonajes = $misMundos->pluck('personajes_count');

        // 3. Datos para Gráfico de Dona
        $categorias = DB::table('entradas')
            ->join('mundos', 'entradas.mundo_id', '=', 'mundos.id')
            ->where('mundos.user_id', $userId)
            ->select('entradas.categoria', DB::raw('count(*) as total'))
            ->groupBy('entradas.categoria')
            ->get();

        $nombresCategorias = $categorias->pluck('categoria');
        $cantidadCategorias = $categorias->pluck('total');

        return view('dashboards.escritor', compact(
            'misMundos', 'comunidad', 
            'nombresMundos', 'cantidadPersonajes', 
            'nombresCategorias', 'cantidadCategorias'
        ));
    }

    public function admin()
    {
        // 1. Lógica original: Imágenes pendientes
        $imagenesPendientes = Image::where('estado', 'pending')->get();

        // 2. Lógica de gráficos
        $totalMundos = Mundo::count();
        $totalPersonajes = Personaje::count();
        $totalEntradas = Entrada::count();

        $topUsuarios = User::withCount('mundos')
                           ->orderBy('mundos_count', 'desc')
                           ->take(5)
                           ->get();
                           
        $nombresUsuarios = $topUsuarios->pluck('name');
        $cantidadMundosUsuarios = $topUsuarios->pluck('mundos_count');

        return view('dashboards.admin', compact(
            'imagenesPendientes',
            'totalMundos', 'totalPersonajes', 'totalEntradas',
            'nombresUsuarios', 'cantidadMundosUsuarios'
        ));
    }
}