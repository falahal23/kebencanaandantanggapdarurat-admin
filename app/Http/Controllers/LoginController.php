<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // validasi input sesuai field di view (email + password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // kredensial dummy (uji coba)
        $validEmail = 'admin@gmail.com';
        $validPassword = '12345';

        // cek kredensial
        if ($request->email === $validEmail && $request->password === $validPassword) {
            // simpan session dengan kunci yang dicek di DashboardController
            $request->session()->put('admin_name', 'Admin Bina Desa');
            $request->session()->put('admin_email', $validEmail);

            // redirect ke dashboard dengan pesan sukses
            return redirect()->route('kejadian.index')->with('success', 'Login berhasil. Selamat datang!');
        }

        // kredensial salah
        return back()->withInput($request->only('email'))->with('error', 'Email atau password salah!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        // hapus session login admin
        $request->session()->forget(['admin_name','admin_email']);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
    }
}
