<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalController;
use App\Http\Controllers\InicioSesion\InicioSesionController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\UsuarioConCuenta\UsuarioConCuentaController;
use App\Http\Controllers\Playlist\PlaylistController;
use App\Http\Controllers\AsistenteIA\AsistenteIAController;

// Ruta principal
Route::get('/', function () {
    return view('usuarios con cuenta.index');
});

// Rutas corregidas (CONSISTENTES)
Route::get('/ventana-principal/index', [VentanaPrincipalController::class, 'index'])->name('ventana-principal.index');

// Ruta para inicio de sesión
Route::get('/inicio-sesion/index', [InicioSesionController::class, 'index'])->name('inicio-sesion.index');

// Ruta para usuario con cuenta
Route::get('/usuario-con-cuenta/index', [UsuarioConCuentaController::class, 'index'])->name('usuario-con-cuenta.index');

// Ruta para perfil 
Route::get('/perfil/index', [PerfilController::class, 'index'])->name('perfil.index');
Route::get('/mi-perfil', [PerfilController::class, 'index'])->name('mi-perfil');

// Ruta para Playlists
Route::get('/playlists/index', [PlaylistController::class, 'index'])->name('playlists.index');

// Ruta para Asistente IA - CORREGIDA DEFINITIVAMENTE
Route::get('/asistente-ia/index', [AsistenteIAController::class, 'index'])->name('asistente-ia.index');