<?php

namespace App\Http\Controllers;

use App\Models\LogistikBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;

class LogistikBencanaController extends Controller
{
    public function index()
    {
        $logistik = LogistikBencana::with('kejadian')->get();
        return view('admin.logistik_bencana.index', compact('logistik'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('admin.logistik_bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'stok' => 'required|numeric',
            'sumber' => 'nullable',
        ]);

        LogistikBencana::create($validated);
        return redirect()->route('admin.logistik_bencana.index')->with('success', 'Data logistik ditambahkan.');
    }
}
