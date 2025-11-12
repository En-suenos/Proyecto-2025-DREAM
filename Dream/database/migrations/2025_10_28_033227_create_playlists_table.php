use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;

public function store(Request $request)
{
<<<<<<< HEAD
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'sonidos' => 'nullable|array',
    ]);
=======
    public function up(): void
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->json('sonidos')->nullable();
            $table->unsignedBigInteger('id_usuario')->notnull(); 
            $table->timestamps();
>>>>>>> integracionVue-3

    Playlist::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'sonidos' => json_encode($request->sonidos),
        'id_usuario' => Auth::id(), // ✅ toma el usuario actual
    ]);

    return response()->json(['message' => 'Playlist creada correctamente']);
}
