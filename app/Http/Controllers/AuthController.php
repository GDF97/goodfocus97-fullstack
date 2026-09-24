<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Exibe a tela de login
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }

        return view('admin.login');
    }

    /**
     * Processa o login
     */
    public function login(Request $request)
    {
        // Validação dos campos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenta autenticar o usuário
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        // Login inválido
        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.',
        ])->onlyInput('email');
    }

    /**
     * Faz logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida a sessão atual
        $request->session()->invalidate();

        // Regenera o token CSRF
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

