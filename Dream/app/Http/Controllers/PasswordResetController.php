<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

class PasswordResetController extends Controller
{
    // Mostrar formulario para solicitar recuperación
    public function showForgotPassword()
    {
        return view('recuperacion_cuenta.index');
    }

    // Procesar solicitud de recuperación
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuarios,correo'
        ]);

        // Generar token único
        $token = Str::random(64);

        // Guardar token en la base de datos
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        // En producción, usa Mail::to(...)->send(new ResetPasswordMail($token));
        // Para desarrollo, mostramos el enlace (opcional)
        $resetUrl = route('password.reset.form', ['token' => $token]);

        return back()->with('status', 'Hemos enviado instrucciones a tu correo.<br>
            <small class="text-muted">🔗 Enlace de desarrollo: <a href="' . $resetUrl . '" class="text-white">' . e($resetUrl) . '</a></small>');
    }

    // Mostrar formulario para nueva contraseña
    public function showResetForm($token)
    {
        // Opcional: verificar que el token exista
        $exists = DB::table('password_resets')->where('token', $token)->exists();
        if (!$exists) {
            return redirect()->route('password.forgot')->with('error', 'El enlace de recuperación es inválido o ha expirado.');
        }

        return view('recuperacion_cuenta.reset', ['token' => $token]);
    }

    // Procesar el restablecimiento de contraseña
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:usuarios,correo',
            'password' => 'required|min:6|confirmed',
        ]);

        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$tokenData || now()->diffInMinutes($tokenData->created_at) > 60) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'El enlace de recuperación es inválido o ha expirado.']);
        }

        $usuario = Usuario::where('correo', $request->email)->first();
        if ($usuario) {
            $usuario->update([
                'contraseña' => Hash::make($request->password)
            ]);

            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('inicio_sesion.index')
                ->with('success', '¡Tu contraseña ha sido restablecida con éxito! Ahora puedes iniciar sesión.');
        }

        return back()->withErrors(['email' => 'No se pudo actualizar la contraseña.']);
    }
}