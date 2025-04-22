<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\CulturaController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HistoriaController;

use App\Http\Controllers\UserAgendaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta de la página principal
Route::get('/', function () {
    return view('index');
});

// Ruta del panel de administración
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('Administrador');

    Route::get('/profile', [UsuarioController::class,'profile']);
    Route::resource('/client', ClienteController::class)->names('cliente');
    Route::resource('/roles', RoleController::class)->names('roles');
    Route::resource('/permisos', PermisoController::class)->names('permisos');
    Route::post('/roles/{id}/switch-guard', [RoleController::class, 'switchGuard'])->name('roles.switchGuard');
    Route::resource('/usuarios', AsignarController::class)->names('asignar');
    

});

// Ruta de registro
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

// Ruta de ciudades
Route::get('/get-states', [CountryController::class, 'getStates'])->name('get-states');

// Ruta del dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // Vista del dashboard para usuarios normales
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';

//Ruta de middleware
Route::get('prueba', function(){
    return "Has accedido correctamente a esta ruta";
})->middleware('age');

Route::get('no-autorizado', function(){
    return "Usted no es mayor de edad";
});

// ruta cultura
Route::resource('culturas', CulturaController::class);
Route::delete('/culturas/{id}', [CulturaController::class, 'destroy'])->name('culturas.destroy');

// Ruta para historia
Route::resource('historias', HistoriaController::class);
Route::delete('/historias/{id}', [HistoriaController::class, 'destroy'])->name('historias.destroy');

//RUTA VISTAS
Route::get('ultimo1', function () {
    return view('ultimo1');
});

Route::get('videos', function () {
    return view('videos');
});

//RUTA AGENDA USUARIO
Route::middleware('auth')->group(function () {
    Route::get('/agenda', [UserAgendaController::class, 'index'])->name('agenda.index');
    Route::post('/agenda/store', [UserAgendaController::class, 'store'])->name('agenda.store');

    Route::get('/agenda/eventos', [UserAgendaController::class, 'getEventos'])->name('agenda.eventos');

});



