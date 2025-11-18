<?php

namespace App\Http\Controllers\Opciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpcionesController extends Controller
{
    // ⚠️ Eliminamos __construct con middleware — lo aplicamos en routes/web.php

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Redirige si no hay usuario
        }

        $opciones = [
            'fondo' => $user->opciones['fondo'] ?? 'estrellado',
            'idioma' => $user->opciones['idioma'] ?? 'es',
            'notificaciones' => $user->opciones['notificaciones'] ?? true,
        ];

        return view('obsiones.index', compact('opciones'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'fondo' => 'required|in:estrellado,luna,oscuro,claro',
            'idioma' => 'required|in:es,en',
            'notificaciones' => 'boolean',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // ✅ Asegúrate de que $user sea una instancia de Eloquent Model
        $user->opciones = array_merge($user->opciones ?? [], $request->only([
            'fondo', 'idioma', 'notificaciones'
        ]));
        
        // ✅ Usa save() solo si $user es un modelo Eloquent
        $user->save();

        return back()->with('success', '✅ Opciones actualizadas con éxito.');
    }
}