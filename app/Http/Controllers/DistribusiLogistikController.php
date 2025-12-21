<?php
namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;

class DistribusiLogistikController extends Controller
{
 public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:User');
    }
    // =======================
    // INDEX
    // =======================
    public function index(Request $request)
    {
        $query = DistribusiLogistik::with('logistik', 'posko', 'media', );

        // 🔍 SEARCH: logistik nama atau posko nama
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('logistik', function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%");
            })->orWhereHas('posko', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // 🗂 FILTER: posko_id
        if ($request->filled('posko_id')) {
            $query->where('posko_id', $request->posko_id);
        }

        // Ambil semua posko untuk filter dropdown
        $poskos = PoskoBencana::orderBy('nama')->get();

        // Pagination & urut terbaru
        $distribusi = $query->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString(); // query search/filter tetap terbawa

        return view('pages.admin.distribusi_logistik.index', compact('distribusi', 'poskos'));
    }

    // =======================
    // CREATE
    // =======================
    public function create()
    {
        $logistik = LogistikBencana::all();
        $posko    = PoskoBencana::all();

        return view('pages.admin.distribusi_logistik.create', compact('logistik', 'posko'));
    }

    // =======================
    // STORE
    // =======================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'logistik_id' => 'required',
            'posko_id'    => 'required',
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|integer|min:1',
            'penerima'    => 'required',
            'keterangan'  => 'nullable|string',
            'bukti'       => 'nullable|image|max:2048',
        ]);

        $buktiFile = $request->file('bukti');
        unset($validated['bukti']);

        $distribusi = DistribusiLogistik::create($validated);

        if ($buktiFile) {
            $name = time() . '_' . $buktiFile->getClientOriginalName();
            $buktiFile->move(public_path('uploads/distribusi'), $name);

            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $distribusi->distribusi_id,
                'file_url'  => '/uploads/distribusi/' . $name,
                'mime_type' => $buktiFile->getClientMimeType(),
                'file_name' => $name,
            ]);
        }

        return redirect()->route('admin.distribusi_logistik.index')
            ->with('success', 'Distribusi logistik berhasil ditambahkan.');
    }

    // =======================
    // SHOW
    // =======================
    public function show($id)
    {
        $distribusi = DistribusiLogistik::with('logistik', 'posko', 'media', )->findOrFail($id);
        return view('pages.admin.distribusi_logistik.show', compact('distribusi'));
    }

    // =======================
    // EDIT
    // =======================
    public function edit($id)
    {
        $distribusi = DistribusiLogistik::with('media')->findOrFail($id);
        $logistik   = LogistikBencana::all();
        $posko      = PoskoBencana::all();

        return view('pages.admin.distribusi_logistik.edit', compact('distribusi', 'logistik', 'posko'));
    }

    // =======================
    // UPDATE
    // =======================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'logistik_id' => 'required',
            'posko_id'    => 'required',
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|integer|min:1',
            'penerima'    => 'required',
            'keterangan'  => 'nullable|string',
            'bukti'       => 'nullable|image|max:2048',
        ]);

        $distribusi = DistribusiLogistik::findOrFail($id);

        $buktiFile = $request->file('bukti');
        unset($validated['bukti']);

        $distribusi->update($validated);

        if ($buktiFile) {
            $old = Media::where('ref_table', 'distribusi_logistik')->where('ref_id', $id)->first();
            if ($old) {
                $oldPath = public_path($old->file_url);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }

                $old->delete();
            }

            $name = time() . '_' . $buktiFile->getClientOriginalName();
            $buktiFile->move(public_path('uploads/distribusi'), $name);

            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $id,
                'file_url'  => '/uploads/distribusi/' . $name,
                'mime_type' => $buktiFile->getClientMimeType(),
                'file_name' => $name,
            ]);
        }

        return redirect()->route('admin.distribusi_logistik.index')
            ->with('success', 'Distribusi logistik berhasil diperbarui.');
    }

    // =======================
    // DELETE
    // =======================
    public function destroy($id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);

        $media = Media::where('ref_table', 'distribusi_logistik')->where('ref_id', $id)->first();
        if ($media) {
            $filePath = public_path($media->file_url);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $media->delete();
        }

        $distribusi->delete();

        return redirect()->route('admin.distribusi_logistik.index')
            ->with('success', 'Distribusi logistik berhasil dihapus.');
    }
}
