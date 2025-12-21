<?php

namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use App\Models\PoskoBencana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // Cek login
        if (!Auth::check()) {
            return redirect()->route('login.index')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // ===============================
        // STATISTIK DASHBOARD
        // ===============================
        $totalKejadian     = KejadianBencana::count();
        $kejadianAktif     = KejadianBencana::where('status_kejadian', 'Aktif')->count();
        $totalPosko        = PoskoBencana::count();
        $totalDonasi       = DonasiBencana::sum('nilai');
        $totalLogistik     = LogistikBencana::count();
        $totalStokLogistik = LogistikBencana::sum('stok');
        $totalDistribusi   = DistribusiLogistik::count();
        $totalPenerima     = DistribusiLogistik::distinct('penerima')->count('penerima');

        // Tabel kejadian (batasi 5)
        $kejadian = KejadianBencana::latest()->take(5)->get();

        // ===============================
        // DATA GRAFIK KEJADIAN PER TAHUN
        // ===============================
        $grafikKejadian = KejadianBencana::select(
                DB::raw('YEAR(tanggal) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tahun')
            ->orderBy('tahun', 'ASC')
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalKejadian',
            'kejadianAktif',
            'totalPosko',
            'totalDonasi',
            'totalLogistik',
            'totalStokLogistik',
            'totalDistribusi',
            'totalPenerima',
            'kejadian',
            'grafikKejadian'
        ));
    }
}
