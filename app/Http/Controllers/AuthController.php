<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $authService
    ) {}

    public function login()
    {
        return view('auth.login');
    }

    public function sign(LoginRequest $request)
    {
        if ($this->authService->login($request->validated())) {

            $request->session()->regenerate();

            return redirect()->route('admin.ticket.index');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
