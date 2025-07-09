<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->user_type == 'propietario') {
                return redirect()->intended(route('propietario.dashboard'));
            }

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden'
        ]);
    }

    public function register(Request $request)
    {
        Log::info('Register request received', $request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:cliente,propietario',
            'residence' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'birthdate' => 'required|date|before_or_equal:-18 years',
        ],[
            'birthdate.before_or_equal' => 'Debes tener al menos 18 años para registrarte.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        Log::info('Validation passed');

        try {
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'residence' => $request->residence,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
        ]);

            Log::info('User created successfully', ['user_id' => $user->id]);

            Auth::login($user);

            if ($user->user_type == 'propietario') {
                return redirect()->route('propietario.dashboard');
            }
    
            return redirect()->route('user.dashboard');

        } catch (\Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'No se pudo crear el usuario.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard'); // Redirige al dashboard de admin
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'No tienes permisos de administrador.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
}
