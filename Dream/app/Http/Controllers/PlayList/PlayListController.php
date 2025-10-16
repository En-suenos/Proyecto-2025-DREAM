<?php

namespace App\Http\Controllers\PlayList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlayList;

class PlayListController extends Controller
{
    //  conectar con la vista
    public function index()
    {
        return view('playlist.index', compact('playlist'));
    }
}
