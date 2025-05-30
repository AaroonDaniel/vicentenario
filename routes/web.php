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
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HistoriaController;

use App\Http\Controllers\UserAgendaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\expositorController;
use App\Http\Controllers\PatrocinadorController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\GraficoControlador;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\VistasRandomController;


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

    Route::get('/profile', [UsuarioController::class, 'profile']);
    Route::resource('/client', ClienteController::class)->names('cliente');
    Route::resource('/graficos', GraficoControlador::class)->names('graficos');
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
require __DIR__ . '/auth.php';

//Ruta de middleware
Route::get('prueba', function () {
    return "Has accedido correctamente a esta ruta";
})->middleware('age');

Route::get('no-autorizado', function () {
    return "Usted no es mayor de edad";
});

// ruta cultura
Route::resource('culturas', CulturaController::class);
Route::delete('/culturas/{id}', [CulturaController::class, 'destroy'])->name('culturas.destroy');

// Ruta para historia
Route::resource('historias', HistoriaController::class);
Route::delete('/historias/{id}', [HistoriaController::class, 'destroy'])->name('historias.destroy');

//RUTA VISTAS
Route::get('ultimo', function () {
    return view('ultimo');
});

//Route::get('videos', function () {
   // return view('videos');
//});

//RUTA AGENDA USUARIO
Route::middleware('auth')->group(function () {
    Route::get('/agenda', [UserAgendaController::class, 'index'])->name('agenda.index');
    Route::post('/agenda/store', [UserAgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/eventos', [UserAgendaController::class, 'getEventos'])->name('agenda.eventos');

    // NUEVAS rutas para actualizar y eliminar eventos
    Route::put('/agenda/update/{id}', [UserAgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/delete/{id}', [UserAgendaController::class, 'destroy'])->name('agenda.destroy');
    
});

// ruta para agregar eventos a la agenda
Route::get('/agenda/eventos/agendados', [UserAgendaController::class, 'eventosAgendados'])->name('agenda.eventosAgendados');

//RUTA DE EVENTOS
Route::get('eventos', [EventoController::class, 'index'])
    ->name('eventos.index');
Route::post('eventos', [EventoController::class, 'store'])
    ->name('eventos.store');
Route::resource('eventos', EventoController::class);

//RUTA DE AGENDA DE EVENTOS
Route::get('/agendaEventos', [AgendaController::class, 'index'])->name('agendaEventos');

//RUTA DE EXPOSITORES
Route::resource('expositores', expositorController::class);
Route::get('/expositores', [ExpositorController::class, 'index'])->name('expositores.index');
Route::post('/expositores', [ExpositorController::class, 'store'])->name('expositores.store');
Route::delete('/expositores/{id}', [ExpositorController::class, 'destroy'])->name('expositores.destroy');
Route::get('/expositores/{id}', [ExpositorController::class, 'show']);

//multimedia

//Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
//Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
Route::resource('videos', VideoController::class);

//Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');

//Route::put('/videos/{video}', [VideoController::class, 'update'])->name('videos.update');
//Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');


//RUTA DE PATROCINADORES
Route::resource('patrocinadores', PatrocinadorController::class);
Route::delete('/patrocinadores/{id}', [PatrocinadorController::class, 'destroy'])->name('patrocinadores.destroy');

// ruta asistencia
Route::get('/asistencia', [AsistenciaController::class, 'index'])->name('asistencias.escanear');
Route::post('/registrar-asistencia', [AsistenciaController::class, 'registrar'])->name('asistencias.registrar');
Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');
Route::get('/asistencias/{id}', [AsistenciaController::class, 'show']);
Route::put('/asistencias/{id}', [AsistenciaController::class, 'update'])->name('asistencias.update');


//OPCIONAL
//Route::get('/eventos/qr/{id}', [EventoController::class, 'generarQR']);

Route::get('/quienesSomos', function () {
    return view('quienesSomos');
})->name('quienes.somos');


//vista principal
Route::get('/', [InicioController::class, 'index'])->name('home');

// Mostrar formulario
Route::get('/galeria/create', [GaleriaController::class, 'create'])->name('galeria.create');

// Guardar imagen
Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
Route::get('/galeria/{id}', [GaleriaController::class, 'show'])->name('galeria.show');

Route::resource('novedades', NovedadController::class);
Route::get('/novedades/ver/{id}', [NovedadController::class, 'show1'])->name('novedades.show1');

//vistas random
Route::get('/ultimo', [VistasRandomController::class, 'index'])->name('ultimo');



