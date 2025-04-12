<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth', 'age'])->group(function () {
    Route::get('/admin', [HomeController::class, 'index'])->name('admin.index');
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

// Ruta para historia
Route::get('/historia', [UsuarioController::class, 'index'])->name('historia');