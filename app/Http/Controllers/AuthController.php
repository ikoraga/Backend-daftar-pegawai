<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/'
            ],
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',

            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password harus berupa teks',
            'password.min' => 'Password minimal 6 karakter',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter spesial (@$!%*?&)',
        ]);


        $data = $this->auth->login([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (!$data) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }
        return response()->json([
            'message' => 'Login berhasil',
        ]);
    }
    public function logout(Request $request)
    {
        $this->auth->logout($request->user());
        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }

}
