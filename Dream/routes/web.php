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

use Illuminate\Http\Request;

/*
Route::get('/', function () {
    return view('ventana principal.index');
}); Para mostrar la ventana principal
*/

Route::get('/', function () {
    $usuario1 = new Usuario();
    $usuario1->nombre = 'Rosy';
    $usuario1->email = 'rosy@gmail.com';
    $usuario1->contrasena = '12345';
    $usuario1->tipoUsuario = 'normal';
    $usuario1->fechaRegistro = '2023-10-01';
    $usuario1->save();

    return $usuario1;
    //return view('ventana principal.index', compact('usuario'));
    //return view('usuarios con cuenta.index ');
});
/*
Route::get('/usuario', function () {
    return View('usuario.index', compact('usuario'));
}); 
*/
/*
//Se comunican con Controllers---------------------------------------------------------------------------------------
//Ruta para la ventana principal
Route::get('/ventana principal/index', [VentanaPrincipalController::class, 'index'])->name('ventana principal.index');
Route::get('/ventana principal/find', [VentanaPrincipalController::class, 'find'])->name('ventana principal.find');

//Ruta para inicio de sesión
Route::get('/inicio sesion/index',[InicioSesionController::class, 'index'])->name('inicio sesion.index');

//Ruta para usuario con cuenta
Route::get('/usuario con cuenta/index', [UsuarioConCuentaController::class, 'index'])->name('usuario con cuenta.index');

//Ruta para perfil de usuario con cuenta
Route::get('/perfil/index', [PerfilController::class, 'index'])->name('perfil.index');

//Ruta para Playlists
Route::get('/playlists/index', [PlaylistController::class, 'index'])->name('playlists.index');

//Ruta para Asistente IA
Route::get('/asistente ia/index', [AsistenteIAController::class, 'index'])->name('asistente ia.index');
*/