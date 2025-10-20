<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;    
use App\Models\Usuario;

// Controllers
use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalController;
use App\Http\Controllers\InicioSesion\InicioSesionController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\UsuarioConCuenta\UsuarioConCuentaController;
use App\Http\Controllers\Playlist\PlaylistController;
use App\Http\Controllers\AsistenteIA\AsistenteIAController;
use App\Http\Controllers\VentanaDatos\VentanaDatosController;
use App\Http\Controllers\Usuario\UsuarioController; // Agregar este

Route::get('/', function () {
    return view('ventana principal.index');
}); 

// Se comunican con Controllers
// Ruta para la ventana principal
Route::get('/ventana principal/index', [VentanaPrincipalController::class, 'index'])->name('ventana principal.index');
Route::get('/ventana principal/find', [VentanaPrincipalController::class, 'find'])->name('ventana principal.find');

// Ruta para inicio de sesión
Route::get('/inicio sesion/index',[InicioSesionController::class, 'index'])->name('inicio_sesion.index');
Route::post('/inicio sesion/login', [InicioSesionController::class, 'login'])->name('inicio_sesion.login');

// Ruta para usuario con cuenta
Route::get('/usuario-con-cuenta/index', [UsuarioConCuentaController::class, 'index'])->name('usuario_con_cuenta.index');

// Ruta para perfil de usuario con cuenta
Route::get('/perfil/index', [PerfilController::class, 'index'])->name('perfil.index');

// Ruta para Playlists
Route::get('/playlists/index', [PlaylistController::class, 'index'])->name('playlists.index');

// Ruta para Asistente IA
Route::get('/asistente ia/index', [AsistenteIAController::class, 'index'])->name('asistente ia.index');

// Ruta para ventana de datos-para registro
Route::get('/ventana datos/index', [VentanaDatosController::class, 'index'])->name('ventana datos.index');

// RUTAS CORREGIDAS PARA USUARIO --------------------------------------------------
// Ruta para listar usuarios
Route::get('/usuario/index', [UsuarioController::class, 'index'])->name('usuario.index');

// Ruta para crear usuario (FORMULARIO)
Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');

// Ruta para guardar usuario (PROCESAR FORMULARIO) - CORREGIDO
Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store'); // Cambiado a 'usuario.store'

// Ruta para actualizar usuario - CORREGIDO
Route::put('/usuario/update/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update'); // Cambiado a PUT