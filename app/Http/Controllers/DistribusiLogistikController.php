<?php
namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $query = DistribusiLogistik::with('logistik', 'posko', 'media');

        // 🔍 SEARCH: logistik nama atau posko nama
        if ($request->filled('search')) {
            $search = $request->search;

            // Bungkus grup search agar orWhereHas tidak konflik dengan filter lain
            $query->where(function ($q) use ($search) {
                $q->whereHas('logistik', function ($q2) use ($search) {
                    $q2->where('nama_barang', 'like', "%{$search}%");
                })->orWhereHas('posko', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%");
                });
            });
        }

        // 🗂 FILTER POSKO
        if ($request->filled('posko_id')) {
            $query->where('posko_id', $request->posko_id);
        }

        // Ambil semua posko untuk dropdown filter
        $posko = PoskoBencana::orderBy('nama')->get();

        // Pagination terbaru
        $distribusi = $query->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.distribusi_logistik.index', compact('distribusi', 'posko'));
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
            'media'       => 'nullable|image|max:2048',
        ]);

        $mediaFile = $request->file('media');
        unset($validated['media']);

        $distribusi = DistribusiLogistik::create($validated);

        if ($mediaFile) {
            $path = $mediaFile->store('uploads/distribusi', 'public');

            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $distribusi->distribusi_id,
                'file_url'  => $path,
                'mime_type' => $mediaFile->getClientMimeType(),
                'file_name' => $mediaFile->getClientOriginalName(),
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
            'media'       => 'nullable|image|max:2048',
        ]);

        $distribusi = DistribusiLogistik::findOrFail($id);

        $mediaFile = $request->file('media');
        unset($validated['media']);

        $distribusi->update($validated);

        if ($mediaFile) {

            // Hapus media lama
            $old = Media::where('ref_table', 'distribusi_logistik')
                ->where('ref_id', $id)
                ->first();

            if ($old && Storage::disk('public')->exists($old->file_url)) {
                Storage::disk('public')->delete($old->file_url);
                $old->delete();
            }

            // Simpan media baru
            $path = $mediaFile->store('uploads/distribusi', 'public');

            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $id,
                'file_url'  => $path,
                'mime_type' => $mediaFile->getClientMimeType(),
                'file_name' => $mediaFile->getClientOriginalName(),
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

        $media = Media::where('ref_table', 'distribusi_logistik')
            ->where('ref_id', $id)
            ->first();

        if ($media && Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
            $media->delete();
        }

        $distribusi->delete();

        return redirect()->route('admin.distribusi_logistik.index')
            ->with('success', 'Distribusi logistik berhasil dihapus.');
    }

}
