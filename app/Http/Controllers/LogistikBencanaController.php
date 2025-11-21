<?php

namespace App\Http\Controllers;

use App\Models\LogistikBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;

class LogistikBencanaController extends Controller
{
    // =======================
    // INDEX
    // =======================
    public function index()
    {
        $logistik = LogistikBencana::with('kejadian')->get();
        return view('pages.admin.logistik_bencana.index', compact('logistik'));
    }

    // =======================
    // CREATE
    // =======================
    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('pages.admin.logistik_bencana.create', compact('kejadian'));
    }

    // =======================
    // STORE
    // =======================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required',
            'nama_barang' => 'required|string|max:255',
            'satuan'      => 'required|string',
            'stok'        => 'required|numeric',
            'sumber'      => 'nullable|string',
        ]);

        LogistikBencana::create($validated);

        return redirect()->route('admin.logistik_bencana.index')
                         ->with('success', 'Data logistik berhasil ditambahkan.');
    }

    // =======================
    // EDIT FORM
    // =======================
    public function edit($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();

        return view('pages.admin.logistik_bencana.edit', compact('logistik', 'kejadian'));
    }

    // =======================
    // UPDATE DATA
    // =======================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required',
            'nama_barang' => 'required|string|max:255',
            'satuan'      => 'required|string',
            'stok'        => 'required|numeric',
            'sumber'      => 'nullable|string',
        ]);

        $logistik = LogistikBencana::findOrFail($id);
        $logistik->update($validated);

        return redirect()->route('admin.logistik_bencana.index')
                         ->with('success', 'Data logistik berhasil diperbarui.');
    }

    // =======================
    // DELETE / DESTROY
    // =======================
    public function destroy($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $logistik->delete();

        return redirect()->route('admin.logistik_bencana.index')
                         ->with('success', 'Data logistik berhasil dihapus.');
    }
}
