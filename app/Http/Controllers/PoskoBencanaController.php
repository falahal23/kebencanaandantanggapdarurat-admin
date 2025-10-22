<?php

namespace App\Http\Controllers;

use App\Models\PoskoBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class PoskoBencanaController extends Controller
{
    public function index()
    {
        $posko = PoskoBencana::with('kejadian', 'media')->get();
        return view('admin.posko_bencana.index', compact('posko'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('admin.posko_bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'kontak' => 'nullable',
            'penanggung_jawab' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ]);

        $posko = PoskoBencana::create($validated);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/media');
            Media::create([
                'ref_table' => 'posko_bencana',
                'ref_id' => $posko->posko_id,
                'file_url' => Storage::url($path),
                'mime_type' => $request->file('foto')->getMimeType(),
            ]);
        }

        return redirect()->route('admin.posko_bencana.index')->with('success', 'Posko berhasil ditambahkan.');
    }
}
