<?php

namespace App\Http\Controllers\PlayList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlayList;

class PlayListController extends Controller
{
    //  se conecta con la vista ventana playlista
    public function index(Request $request)
    {
        return view('ventana playlista.index');
    }
}
