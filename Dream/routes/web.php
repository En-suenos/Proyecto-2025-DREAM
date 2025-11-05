<?php

use App\Http\Controllers\VentanaDatos\VentanaDatosController;

use App\Http\Controllers\Perfil\PerfilInertiaController;
use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalInertiaController;
use App\Http\Controllers\AsistenteIA\AsistenteIAInertiaController;
use App\Http\Controllers\PlayList\PlaylistInertiaController;
use App\Http\Controllers\Sonido\SonidoInertiaController;
use App\Http\Controllers\Usuario\UsuarioInertiaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\InicioSesion\InicioSesionInertiaController;
use App\Http\Controllers\UsuarioConCuenta\UsuarioConCuentaController;

Route::get('/', function () {
    // return Inertia::render('VentanaInicio/VentanaInicio', [
    //     'canLogin' => Route::has('login'),
    //     // 'canRegister' => Route::has('register'),
    //     // 'laravelVersion' => Application::VERSION,
    //     // 'phpVersion' => PHP_VERSION,
    // ]);
    return view('ventana principal.index');
});

Route::get('/registro', function () {
    return Inertia::render('Registro/Register');
})->name('register');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/usuarios', UsuarioInertiaController::class);
Route::resource('/sonidos', SonidoInertiaController::class);
Route::resource('/playlists', PlaylistInertiaController::class);
Route::resource('/asistente-ia', AsistenteIAInertiaController::class);
Route::resource('/ventana-principal', VentanaPrincipalInertiaController::class);
Route::resource('/inicio_sesion', InicioSesionInertiaController::class);
Route::resource('/ventana-datos', VentanaDatosController::class);
Route::resource('/perfil', PerfilInertiaController::class);

Route::resource('/usuario-cuenta', UsuarioConCuentaController::class);

require __DIR__.'/auth.php';
