<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login.
     * Route: GET /auth
     */
    public function index()
    {
        return view('login-form');
    }

    /**
     * Memproses data dari form login.
     * Route: POST /auth/login
     */
    public function login(Request $request)
    {
        // 1. Aturan validasi
        $rules = [
            'username' => 'required',
            'password' => ['required', 'min:3', 'regex:/[A-Z]/'],
        ];

        // 2. Pesan error kustom dalam Bahasa Indonesia
        $messages = [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 3 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital.',
        ];

        // 3. Lakukan validasi
        $request->validate($rules, $messages);

        // --- Logika Pengecekan Username & Password ---
        $correctUsername = 'Admin';
        $correctPassword = 'Admin123';

        if ($request->username === $correctUsername && $request->password === $correctPassword) {
            // Jika berhasil, arahkan ke halaman dashboard dengan pesan sukses
            return redirect('/dashboard')->with('success', 'Selamat datang kembali, ' . $request->username . '!');
        } else {
            // Jika gagal, kembali ke halaman login dengan pesan error
            return Redirect::back()->withErrors(['loginError' => 'Username atau password tidak sesuai.']);
        }
    }
}
