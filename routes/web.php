<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CulturaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\Auth\CustomVerifyEmailController;
use App\Http\Controllers\UserAgendaController;
use App\Http\Controllers\AgendaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí se registran las rutas web de tu aplicación.
| Se cargan automáticamente por RouteServiceProvider.
*/

// Página principal pública
Route::get('/', function () {
    return view('index');
});

// Verificación de email (pantalla de espera)
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Ruta personalizada de verificación de email
Route::get('/email/verify/{id}/{hash}', CustomVerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

// Rutas de registro (formulario)
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

// Ruta que retorna los estados de un país (ajax)
Route::get('/get-states', [CountryController::class, 'getStates'])->name('get-states');

// Ruta del dashboard solo para usuarios autenticados y verificados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas para administración del sistema (usuarios autenticados + verificados con middleware personalizado)
Route::middleware(['auth:sanctum', 'verified_custom'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('Administrador');

    // Perfil del usuario personalizado
    Route::get('/profile', [UsuarioController::class, 'profile']);

    // Módulo de clientes
    Route::resource('/client', ClienteController::class)->names('cliente');

    // Roles y permisos
    Route::resource('/roles', RoleController::class)->names('roles');
    Route::post('/roles/{id}/switch-guard', [RoleController::class, 'switchGuard'])->name('roles.switchGuard');
    Route::resource('/permisos', PermisoController::class)->names('permisos');

    // Asignación de usuarios a roles/permisos
    Route::resource('/usuarios', AsignarController::class)->names('asignar');
});

// Rutas de perfil de usuario (editar, actualizar y eliminar perfil)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas protegidas para agenda de usuario
Route::middleware('auth')->group(function () {
    Route::get('/agenda', [UserAgendaController::class, 'index'])->name('agenda.index');
    Route::post('/agenda/store', [UserAgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/eventos', [UserAgendaController::class, 'getEventos'])->name('agenda.eventos');
   
});

// Rutas de eventos
Route::resource('eventos', EventoController::class)->names('eventos');
Route::post('eventos', [EventoController::class, 'store'])->name('eventos.store');
Route::get('/agendaEventos', [AgendaController::class, 'index'])->name('agendaEventos');

// Rutas de culturas
Route::resource('culturas', CulturaController::class);
Route::delete('/culturas/{id}', [CulturaController::class, 'destroy'])->name('culturas.destroy');

// Rutas de historia
Route::resource('historias', HistoriaController::class);
Route::delete('/historias/{id}', [HistoriaController::class, 'destroy'])->name('historias.destroy');

// Rutas de vistas simples
Route::get('ultimo1', function () {
    return view('ultimo1');
});
Route::get('videos', function () {
    return view('videos');
});

// Rutas de prueba de middleware personalizado
Route::get('prueba', function () {
    return "Has accedido correctamente a esta ruta";
})->middleware('age');

Route::get('no-autorizado', function () {
    return "Usted no es mayor de edad";
});

// Rutas de autenticación (login, logout, etc.)
require __DIR__ . '/auth.php';
