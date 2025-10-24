<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            // $token = $user->createToken('api_token')->plainTextToken;

            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }

    public function showLoginForm()
    {
        return view('livewire.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }

    public function showRegisterForm()
    {
        return view('livewire.auth.register');
    }

    public function register(LoginRequest $request)
    {
        $validated = $request->validated();

        event($user = User::create($validated));

        Auth::login($user);

        Session::regenerate();

        return redirect()->route('dashboard');
    }
}
