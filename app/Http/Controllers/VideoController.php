<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all(); // puedes paginar si deseas
        return view('Multimedia.index', compact('videos'));
    }

    /* public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'url' => 'required|url',
            'descripcion' => 'nullable|string',
        ]);

        Video::create($request->all());

        return redirect()->route('videos.index')->with('success', 'Video creado correctamente.');
    }*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'url' => 'required|url',
            'descripcion' => 'required|string',
        ]);

        Video::create($validated);

        return redirect()->back()->with('success', 'Video agregado exitosamente.');
    }
}
