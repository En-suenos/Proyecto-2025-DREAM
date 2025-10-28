<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalController;
use App\Http\Controllers\InicioSesion\InicioSesionController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\UsuarioConCuenta\UsuarioConCuentaController;
use App\Http\Controllers\Playlist\PlaylistController;
use App\Http\Controllers\AsistenteIA\AsistenteIAController;
use App\Http\Controllers\VentanaDatos\VentanaDatosController;
use App\Http\Controllers\Sonido\SonidoController;

//use Illuminate\Http\


Route::get('/', function () {
    return view('ventana principal.index');
}); 



// Rutas corregidas (CONSISTENTES)
Route::get('/ventana principal/index', [VentanaPrincipalController::class, 'index'])->name('ventana-principal.index');

//Ruta para inicio de sesión
Route::get('/inicio sesion/index',[InicioSesionController::class, 'index'])->name('inicio_sesion.index');
Route::post('/inicio sesion/login', [InicioSesionController::class, 'login'])->name('inicio_sesion.login');


//Ruta para usuario con cuenta
Route::get('/usuarios con cuenta/index', [UsuarioConCuentaController::class, 'index'])->name('usuario_con_cuenta.index');

// Ruta para perfil 
Route::get('/perfil/index', [PerfilController::class, 'index'])->name('perfil.index');
Route::get('/mi-perfil', [PerfilController::class, 'index'])->name('mi-perfil');
Route::put('/perfil/update', [App\Http\Controllers\Perfil\PerfilController::class, 'update'])->name('perfil.update');

// Ruta para Playlists
Route::get('/ventana playlista/index', [PlaylistController::class, 'index'])->name('playlists.index');

//Ruta para Asistente IA
Route::get('/asistente ia/index', [AsistenteIAController::class, 'index'])->name('asistente-ia.index');

//Ruta para ventana de datos-para registro
Route::get('/ventana datos/index', [VentanaDatosController::class, 'index'])->name('ventana datos.index');

//Ruta para crear usuario
Route::get('/usuario/create', [App\Http\Controllers\Usuario\UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/store', [App\Http\Controllers\Usuario\UsuarioController::class, 'store'])->name('usuarios.store');
Route::post('/usuario/update/{usuario}', [App\Http\Controllers\Usuario\UsuarioController::class, 'update'])->name('usuarios.update');
//Rutas para eliminar usuario
Route::delete('/usuario/destroy/{usuario}', [App\Http\Controllers\Usuario\UsuarioController::class, 'destroy'])
    ->name('usuarios.destroy');
//Ruta para sonidos
// Route::get('/ventana sonido/index', [App\Http\Controllers\Sonido\SonidoController::class, 'index'])->name('sonidos.index');
// Route::get('/ventana sonido/create', [App\Http\Controllers\Sonido\SonidoController::class, 'create'])->name('sonidos.create');
// Route::post('/ventana sonido/store', [App\Http\Controllers\Sonido\SonidoController::class, 'store'])->name('sonidos.store');
// Route::delete('/ventana sonido/{id}', [App\Http\Controllers\Sonido\SonidoController::class, 'destroy'])->name('sonidos.destroy');

Route::get('/ventana sonido/index', [SonidoController::class, 'index'])->name('sonidos.index');
Route::post('/subir-audio', [SonidoController::class, 'subirAudio'])->name('subir.audio');

// Rutas de perfil
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/eliminar-imagen', [PerfilController::class, 'eliminarImagen'])->name('perfil.eliminar-imagen');