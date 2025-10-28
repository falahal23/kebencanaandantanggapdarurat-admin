<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    // 🔹 Halaman login
    public function index()
    {
        return view('login');
    }

    // 🔹 Halaman register
    public function registerForm()
    {
        return view('admin.auth.register');
    }

    // 🔹 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email
            ]);

            // 🔸 Langsung ke halaman home.index
            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()->withErrors(['password' => 'Email atau password salah'])->withInput();
    }

    // 🔹 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(6)->letters()->mixedCase()->numbers()],
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.min' => 'Password minimal 6 karakter dan harus mengandung huruf besar, kecil, dan angka',
        ]);

         $user = User::where('email', $request->email)->first();

        if ($user) {
        return back()->withErrors(['email' => 'Email sudah digunakan'])->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.index')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 🔹 Logout
    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email']);
        return redirect()->route('login.index')->with('success', 'Anda telah logout.');
    }
}
