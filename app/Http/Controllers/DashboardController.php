<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Models\DistribusiLogistik;
use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use App\Models\Media;
use App\Models\PoskoBencana;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'totalKejadian'     => KejadianBencana::count(),
            'kejadianAktif'     => KejadianBencana::where('status_kejadian', 'Aktif')->count(),
            'totalPosko'        => PoskoBencana::count(),
            'totalDonasi'       => DonasiBencana::sum('nilai'),
            'totalLogistik'     => LogistikBencana::count(),
            'totalStokLogistik' => LogistikBencana::sum('stok'),
            'totalDistribusi'   => DistribusiLogistik::count(),
            'totalPenerima'     => DistribusiLogistik::distinct('penerima')->count('penerima'),
            'kejadian'          => KejadianBencana::all(), // ✅ Tambahkan di array
        ];

        return view('pages.admin.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
