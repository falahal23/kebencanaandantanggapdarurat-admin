<?php

namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use App\Http\Controllers\DashboardController;

class DonasiBencanaController extends Controller
{
    public function index()
    {
        $donasi = DonasiBencana::with('kejadian', 'media')->get();
        return view('admin.donasi_bencana.index', compact('donasi'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('donasi_bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required',
            'donatur_nama' => 'required',
            'jenis' => 'required',
            'nilai' => 'required|numeric',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $donasi = DonasiBencana::create($validated);

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('public/media');
            Media::create([
                'ref_table' => 'donasi_bencana',
                'ref_id' => $donasi->donasi_id,
                'file_url' => Storage::url($path),
                'mime_type' => $request->file('bukti')->getMimeType(),
            ]);
        }

        return redirect()->route('admin.donasi.index')->with('success', 'Donasi berhasil disimpan.');
    }
}
