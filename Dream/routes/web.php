<?php

use App\Http\Controllers\UsuarioConCuenta\VentanaUsuarioConCuentaInertiaController;
use App\Http\Controllers\Perfil\PerfilInertiaController;
use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalInertiaController;
use App\Http\Controllers\RegistroCuenta\RegistroCuentaInertiaController;
use App\Http\Controllers\Sonido\SonidoInertiaController;
use App\Http\Controllers\PlayList\PlaylistInertiaController;
use App\Https\Controller\InicioSesion\InicioSesionInertiaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Inicio/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/ConCuenta', VentanaUsuarioConCuentaInertiaController::class);
Route::resource('/perfil', PerfilInertiaController::class);
Route::resource('/inicio', VentanaPrincipalInertiaController::class);
Route::resource('/registro', RegistroCuentaInertiaController::class);
Route::resource('/sonido', SonidoInertiaController::class);
Route::resource('/playlist', PlaylistInertiaController::class);

require __DIR__.'/auth.php';
