<?php

namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\PoskoBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DistribusiLogistikController extends Controller
{
    public function index()
    {
        $distribusi = DistribusiLogistik::with('logistik', 'posko', 'media')->get();
        return view('admin.distribusi.index', compact('distribusi'));
    }

    public function create()
    {
        $logistik = LogistikBencana::all();
        $posko = PoskoBencana::all();
        return view('admin.distribusi.create', compact('logistik', 'posko'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'logistik_id' => 'required',
            'posko_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'penerima' => 'required',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $distribusi = DistribusiLogistik::create($validated);

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('public/media');
            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id' => $distribusi->distribusi_id,
                'file_url' => Storage::url($path),
                'mime_type' => $request->file('bukti')->getMimeType(),
            ]);
        }

        return redirect()->route('admin.distribusi.index')->with('success', 'Distribusi berhasil dicatat.');
    }
}
