<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdministradorAuthController extends Controller
{
    // Muestra el formulario de registro (Inertia)
    public function showRegister()
    {
        return Inertia::render('AdministradorAutenticacion/Register');
    }

    // Procesa el registro
    public function register(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'email' => 'required|email|unique:administrador,email',
            'password' => 'required|min:6|confirmed',
            'codigo' => 'required|string|max:50',
        ]);

        $admin = Administrador::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'codigo' => $data['codigo'],
        ]);

        // Opcional: iniciar sesión automáticamente después del registro
        Auth::guard('administrador')->login($admin);
        $request->session()->regenerate();

        return redirect()->intended('/admin/dashboard');
    }

    // Muestra el formulario de login (Inertia)
    public function showLogin()
    {
        return Inertia::render('AdministradorAutenticacion/Login');
    }

    // Procesa el login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'codigo' => 'required|string',
        ]);

        // Buscamos por email y codigo (codigo se compara en claro)
        $admin = Administrador::where('email', $data['email'])
                              ->where('codigo', $data['codigo'])
                              ->first();

        if (! $admin || ! Hash::check($data['password'], $admin->password)) {
            return back()->withErrors(['email' => 'Credenciales inválidas.']);
        }

        Auth::guard('administrador')->login($admin);
        $request->session()->regenerate();

        return redirect()->intended('/admin/dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('administrador')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
