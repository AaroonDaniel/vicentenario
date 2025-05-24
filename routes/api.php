<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\EventoApiController;
use App\Http\Controllers\Api\AgendaApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Ruta para login
Route::post('/login', [LoginApiController::class, 'login']);

// Ruta para obtener todos los eventos
Route::get('/eventos', [EventoApiController::class, 'index']);

// Devuelve todos los eventos de la agenda
Route::get('/agenda/usuario/{user_id}', [AgendaApiController::class, 'misEventos']);