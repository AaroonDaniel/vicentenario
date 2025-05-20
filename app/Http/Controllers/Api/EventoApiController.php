<?php
// app/Http/Controllers/Api/EventoApiController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Evento;

class EventoApiController extends Controller
{
    public function index(): JsonResponse
    {
        $eventos = Evento::all();

        return response()->json([
            'success' => true,
            'eventos' => $eventos
        ]);
    }
}
