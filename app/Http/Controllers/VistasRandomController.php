<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novedad;

class VistasRandomController extends Controller
{
    
    public function index()
    {
        // Obtener una novedad destacada (por ejemplo, la más reciente)
        $novedad = Novedad::latest()->first();

        // Otras novedades, excluyendo la destacada
        $novedades = Novedad::where('id', '!=', $novedad->id)->latest()->take(3)->get();

        return view('ultimo', compact('novedad', 'novedades'));
    }

}
