<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    // 🔹 Halaman login
    public function index()
{
    if (Auth::check()) {
        // User sudah login → redirect ke dashboard
        return redirect()->route('dashboard');
    }

    // User belum login → tampilkan halaman login
    return view('pages.Auth.login');
}

    // 🔹 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal 6 karakter',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id'    => $user->id,
                'user_name'  => $user->name,
                'user_email' => $user->email,
                'last_login' => now(), // session last login
            ]);

            // Login menggunakan Auth
            Auth::login($user);

            return redirect()->route('dashboard')->with('');
        }

        return back()->withErrors(['password' => 'Email atau password salah'])->withInput();
    }

    // 🔹 Halaman register
    public function register()
    {
        return view('pages.Auth.register');
    }

    // 🔹 Proses register
    public function registerStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(6)->letters()->mixedCase()->numbers()],
        ], [
            'name.required'      => 'Nama wajib diisi',
            'email.required'     => 'Email wajib diisi',
            'email.unique'       => 'Email sudah digunakan',
            'password.required'  => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.min'       => 'Password minimal 6 karakter dan harus mengandung huruf besar, kecil, dan angka',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return back()->withErrors(['email' => 'Email sudah digunakan'])->withInput();
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.index')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'user_name', 'user_email', 'last_login']);
        Auth::logout();
        $request->session()->invalidate();      // Hapus semua session
        $request->session()->regenerateToken(); // Cegah CSRF

        return redirect()->route('login.index')->with('success', '✅ Anda telah logout!');
    }
}
