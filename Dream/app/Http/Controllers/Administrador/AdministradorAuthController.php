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
    public function index(Request $request)
    {
        return Inertia::render('AdminPrincipal/Index');
    }
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

        // Iniciar sesión automáticamente después del registro
        Auth::guard('administrador')->login($admin);
        $request->session()->regenerate();

        return redirect()->route('admin.inicio');
    }

    // Muestra el formulario de login (Inertia)
    public function showLogin()
    {
        // Si ya está autenticado como admin, redirigir al panel
        if (Auth::guard('administrador')->check()) {
            return redirect()->route('admin.inicio');
        }
        
        // Cerrar sesión de usuario normal si existe
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        
        return Inertia::render('AdministradorAutenticacion/Login');
    }

    // Procesa el login
    public function login(Request $request)
    {
        \Log::info('=== INICIO LOGIN ADMINISTRADOR ===');
        \Log::info('Request data:', $request->only('email', 'codigo'));
        
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'codigo' => 'required|string',
        ]);

        // Buscamos por email y codigo
        $admin = Administrador::where('email', $data['email'])
                              ->where('codigo', $data['codigo'])
                              ->first();

        \Log::info('Admin found:', ['found' => $admin ? 'Yes' : 'No', 'admin_id' => $admin?->id]);

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            \Log::warning('Invalid credentials for email: ' . $data['email']);
            return back()->withErrors(['email' => 'Credenciales inválidas.'])->withInput($request->only('email', 'codigo'));
        }

        // IMPORTANTE: Cerrar sesión de usuario normal si existe
        $wasLoggedAsUser = Auth::guard('web')->check();
        if ($wasLoggedAsUser) {
            Auth::guard('web')->logout();
            \Log::info('Closed user session before admin login');
        }

        // Login del administrador
        Auth::guard('administrador')->login($admin);
        $request->session()->regenerate();

        \Log::info('Auth login executed');
        \Log::info('Auth check after login:', ['check' => Auth::guard('administrador')->check()]);
        \Log::info('Current admin ID:', ['id' => Auth::guard('administrador')->id()]);
        \Log::info('Redirect URL:', ['url' => route('admin.index')]);
        \Log::info('=== FIN LOGIN ADMINISTRADOR ===');

        // Redirección con intended para verificar
        return redirect()->route('admin.index');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('administrador')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.admin');
    }
}