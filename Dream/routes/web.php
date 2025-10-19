<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('ventana principal.index');
});
