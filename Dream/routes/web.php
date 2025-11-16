<?php

use App\Http\Controllers\UsuarioConCuenta\VentanaUsuarioConCuentaInertiaController;
use App\Http\Controllers\Perfil\PerfilInertiaController;
use App\Http\Controllers\VentanaPrincipal\VentanaPrincipalInertiaController;
use App\Http\Controllers\RegistroCuenta\RegistroCuentaInertiaController;
use App\Http\Controllers\Sonido\SonidoInertiaController;
use App\Http\Controllers\PlayList\PlaylistInertiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usuario\UsuarioReporteController;
use App\Http\Controllers\Administrador\AdministradorAuthController;
use App\Http\Controllers\Usuario\UsuarioInertiaController;
use App\Http\Controllers\AdminSonidos\AdminSonidoInertiaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Ruta principal
Route::get('/', function () {
    return Inertia::render('Inicio/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Rutas de usuario autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de playlist
    Route::get('/playlists', [PlaylistInertiaController::class, 'index'])->name('playlist.index');
    Route::get('/playlists/create', [PlaylistInertiaController::class, 'create'])->name('playlist.create');
    Route::post('/playlists', [PlaylistInertiaController::class, 'store'])->name('playlist.store');
    Route::get('/playlists/{playlist}', [PlaylistInertiaController::class, 'show'])->name('playlist.show');
});

Route::get('/Principal', function () {
    return Inertia::render('VentanaUsuarioCuenta/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/ConCuenta', VentanaUsuarioConCuentaInertiaController::class);
Route::resource('/perfil', PerfilInertiaController::class);
Route::resource('/inicio', VentanaPrincipalInertiaController::class);
Route::resource('/registro', RegistroCuentaInertiaController::class);
Route::resource('/sonido', SonidoInertiaController::class);
Route::resource('/adminSonidos', AdminSonidoInertiaController::class);
Route::get('/adminSonidos/delete', [AdminSonidoInertiaController::class, 'delete'])->name('adminSonidos.delete');
Route::get('/usuarios/reporte/pdf', [UsuarioReporteController::class, 'index'])->name('usuarios.reporte.pdf');

Route::get('/audio/{filename}', function ($filename) {
    $path = public_path('audio/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});

Route::resource('/lista/usuario', UsuarioInertiaController::class);
// ====================================================================
// RUTAS DE ADMINISTRADOR
// ====================================================================
// use App\Http\Controllers\Administrador\AdministradorAuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Rutas públicas (guest)
    Route::middleware('guest:administrador')->group(function () {
        Route::get('/login', [AdministradorAuthController::class, 'showLogin'])->name('login.admin');
        Route::post('/login', [AdministradorAuthController::class, 'login'])->name('login.store');
        Route::get('/register', [AdministradorAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AdministradorAuthController::class, 'register'])->name('register.store');
    });
    
    // Rutas protegidas (auth)
    Route::middleware('auth:administrador')->group(function () {
        Route::post('/logout', [AdministradorAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', function () {
            return Inertia::render('AdministradorAutenticacion/Dashboard');
        })->name('dashboard');
        Route::get('/principal', [AdministradorAuthController::class, 'index'])->name('index');
        
    });
});
require __DIR__.'/auth.php';