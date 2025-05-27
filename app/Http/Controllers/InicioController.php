<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Galeria;
use App\Models\Novedad;

class InicioController extends Controller
{
    public function index()
    {
        $eventos = Evento::with(['culturas', 'historias'])->get();

        $galerias = Galeria::latest()->get(); // o Galeria::all();
        $novedades = Novedad::latest()->take(5)->get(); // Puedes limitar o paginar


        return view('index', compact('eventos', 'galerias', 'novedades'));
    }
}

