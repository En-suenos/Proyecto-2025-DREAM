use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'sonidos' => 'nullable|array',
    ]);

    Playlist::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'sonidos' => json_encode($request->sonidos),
        'id_usuario' => Auth::id(), // ✅ toma el usuario actual
    ]);

    return response()->json(['message' => 'Playlist creada correctamente']);
}
