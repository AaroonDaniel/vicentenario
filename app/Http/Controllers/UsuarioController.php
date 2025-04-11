<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;

class UsuarioController extends Controller
{
    public function index(){
        $historias = Historia::all();
        return view('historia.historia', compact('historias'));
        
    }
}
