<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;    
use App\Models\Usuario;
//Controllers
use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalController;
use App\Http\Controllers\InicioSesion\InicioSesionController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\UsuarioConCuenta\UsuarioConCuentaController;
use App\Http\Controllers\Playlist\PlaylistController;
use App\Http\Controllers\AsistenteIA\AsistenteIAController;
use App\Http\Controllers\VentanaDatos\VentanaDatosController;

//use Illuminate\Http\


Route::get('/', function () {
    return view('ventana principal.index');
}); 



//Se comunican con Controllers---------------------------------------------------------------------------------------
//Ruta para la ventana principal
Route::get('/ventana principal/index', [VentanaPrincipalController::class, 'index'])->name('ventana principal.index');
Route::get('/ventana principal/find', [VentanaPrincipalController::class, 'find'])->name('ventana principal.find');

//Ruta para inicio de sesión
Route::get('/inicio sesion/index',[InicioSesionController::class, 'index'])->name('inicio_sesion.index');
Route::post('/inicio sesion/login', [InicioSesionController::class, 'login'])->name('inicio_sesion.login');


//Ruta para usuario con cuenta
Route::get('/usuario-con-cuenta/index', [UsuarioConCuentaController::class, 'index'])->name('usuario_con_cuenta.index');

//Ruta para perfil de usuario con cuenta
Route::get('/perfil/index', [PerfilController::class, 'index'])->name('perfil.index');

//Ruta para Playlists
Route::get('/playlists/index', [PlaylistController::class, 'index'])->name('playlists.index');

//Ruta para Asistente IA
Route::get('/asistente ia/index', [AsistenteIAController::class, 'index'])->name('asistente ia.index');

//Ruta para ventana de datos-para registro
Route::get('/ventana datos/index', [VentanaDatosController::class, 'index'])->name('ventana datos.index');

//Ruta para crear usuario
Route::get('/usuario/create', [App\Http\Controllers\Usuario\UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/store', [App\Http\Controllers\Usuario\UsuarioController::class, 'store'])->name('usuarios.store');
Route::post('/usuario/update/{usuario}', [App\Http\Controllers\Usuario\UsuarioController::class, 'update'])->name('usuarios.update');

