<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $login = $request->string('login')->toString();
        $credentials = [
            'password' => $request->string('password')->toString(),
        ];

        if (str_contains($login, '@')) {
            $credentials['email'] = $login;
        } else {
            $credentials['name'] = $login;
        }

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['login' => 'Kullanıcı adı veya şifre hatalı.'])
                ->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('drivers.index'))
            ->with('success', 'Giriş başarılı.');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->toString(),
            'password' => Hash::make($request->string('password')->toString()),
            'is_admin' => false,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Kayıt başarılı.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Çıkış yapıldı.');
    }
}
