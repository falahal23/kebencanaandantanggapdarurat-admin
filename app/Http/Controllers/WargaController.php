<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use App\Http\Controllers\WargaController;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga
     */
    public function index()
    {
        $warga = Warga::latest()->paginate(10);
        return view('pages.admin.warga.index', compact('warga'));
    }

    /**
     * Tampilkan form tambah warga
     */
    public function create()
    {
        return view('pages.admin.warga.create');
    }

    /**
     * Simpan data warga baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp'       => 'required|string|max:20|unique:warga,no_ktp',
            'nama'         => 'required|string|max:100',
            'jenis_kelamin'=> 'required|in:Laki-Laki,Perempuan',
            'agama'        => 'required|string|max:50',
            'pekerjaan'    => 'nullable|string|max:100',
            'telp'         => 'nullable|string|max:15',
            'email'        => 'nullable|email|max:100'
        ]);

        Warga::create($validated);

        return redirect()->route('pages.admin.warga.index')->with('success', '');
    }

    /**
     * Tampilkan detail warga
     */
    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.admin.warga.show', compact('warga'));
    }

    /**
     * Tampilkan form edit warga
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.admin.warga.edit', compact('warga'));
    }

    /**
     * Update data warga
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp'       => 'required|string|max:20|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama'         => 'required|string|max:100',
            'jenis_kelamin'=> 'required|in:Laki-Laki,Perempuan',
            'agama'        => 'required|string|max:50',
            'pekerjaan'    => 'nullable|string|max:100',
            'telp'         => 'nullable|string|max:15',
            'email'        => 'nullable|email|max:100'
        ]);

        $warga->update($validated);

        return redirect()->route('pages.admin.warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    /**
     * Hapus data warga
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('pages.admin.warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
