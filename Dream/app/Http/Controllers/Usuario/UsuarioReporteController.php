<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
// use App\Http\Controllers\Usuario\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UsuarioReporteController extends Controller
{
    //
    public function index(Request $request) {

        $datos = DB::table('users')
            ->join('playlists', 'users.id', '=', 'playlists.id_usuario')
            ->select(
                'users.name as user_name',
                'users.email as user_email', // Agregado: Correo del usuario
                'playlists.nombre as playlist_nombre'
            )
            ->orderBy('users.name') // Usamos el nombre de la columna original en la tabla
            ->orderBy('playlist_nombre') // Ordenamos por el nombre de la playlist también
            ->get();

        // $usuarios = User::get();

        $totalUsuarios = User::count();
        $totalSonidos = count(Playlist::getSonidosDisponibles()); // Obtener el total de sonidos disponibles
        $pdf = Pdf::loadView('usuario.pdf.index', compact('datos', 'totalUsuarios', 'totalSonidos'));

        return $pdf->download('invoice.pdf');
    }
}
