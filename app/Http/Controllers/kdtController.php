<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kdtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Judul/deskripsi utama
    $data['Tanggap Darurat'] = "Tanggap darurat: kejadian, posko, pengungsi, donasi, serta logistik.";

    // Kejadian Bencana
    $data['kejadian_bencana'] = [
        'kejadian_id'    => 1,
        'jenis_bencana'  => 'Banjir',
        'tanggal'        => '2025-09-27',
        'lokasi_text'    => 'Jl. Merdeka No. 123',
        'rt'             => '05',
        'rw'             => '12',
        'dampak'         => '100 rumah terendam',
        'status_kejadian'=> 'Darurat',
        'keterangan'     => 'Butuh bantuan segera'
    ];

    // Posko Bencana
    $data['posko_bencana'] = [
        'posko_id'        => 1,
        'kejadian_id'     => 1,
        'nama'            => 'Posko Utama',
        'alamat'          => 'Gedung Serbaguna RW 12',
        'kontak'          => '08123456789',
        'penanggung_jawab'=> 'Pak Budi'
    ];

    // Donasi Bencana
    $data['donasi_bencana'] = [
        'donasi_id'    => 1,
        'kejadian_id'  => 1,
        'donatur_nama' => 'PT Peduli Bersama',
        'jenis'        => 'Uang Tunai',
        'nilai'        => 50000000
    ];

    // Logistik Bencana
    $data['logistik_bencana'] = [
        'logistik_id' => 1,
        'kejadian_id' => 1,
        'nama_barang' => 'Beras',
        'satuan'      => 'Karung',
        'stok'        => 200,
        'sumber'      => 'Bulog'
    ];

    // Distribusi Logistik
    $data['distribusi_logistik'] = [
        'distribusi_id' => 1,
        'logistik_id'   => 1,
        'posko_id'      => 1,
        'tanggal'       => '2025-09-27',
        'jumlah'        => 50,
        'penerima'      => 'Warga RW 12'
    ];

    return view('kdt', $data);
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
