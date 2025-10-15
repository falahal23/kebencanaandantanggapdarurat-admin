<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin
     */
    public function index(Request $request)
    {
        // Cek apakah admin sudah login
        if (!$request->session()->has('admin_name')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil nama admin dari session
        $adminName = $request->session()->get('admin_name');

        // Kirim data ke view dashboard
        return view('admin.dashboard', compact('adminName'));
    }
}
