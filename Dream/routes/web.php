<?php

use Illuminate\Support\Facades\Route;
use App\Models\Usuario;
use Illuminate\Http\
Route::get('/', function () {
    $usuario = new Usuario();
    $usuario->nombre = 'Juan Perez';
    $usuario->email = 'juanperez@gmail.com';
    $usuario->contraseña = 'bla123';
    $usuario->save();

    return view('welcome');
});

Route::get('/usuario', function () {
    return View('usuario.index', compact('usuario'));
}); 
