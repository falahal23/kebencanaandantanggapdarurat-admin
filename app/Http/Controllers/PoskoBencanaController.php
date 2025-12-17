<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoskoBencanaController extends Controller
{
        public function __construct()
    {

        $this->middleware('auth'); // HARUS DI SINI
    }
    
    // ➤ List semua posko dengan pagination + search + filter
    public function index(Request $request)
    {
        $search = $request->input('search');
        $alamat = $request->input('alamat');

        $query = PoskoBencana::query();

        // 🔍 Search by nama, alamat, penanggung_jawab
        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('penanggung_jawab', 'like', "%{$search}%");
            });
        }

        // 🗂 Filter by alamat
        if (! empty($alamat)) {
            $query->where('alamat', $alamat);
        }

        // Ambil list alamat unik untuk filter dropdown
        $alamatList = PoskoBencana::select('alamat')->distinct()->pluck('alamat');

        // Paginate (10 per halaman) + query string tetap terbawa saat pagination
        $posko = $query->orderBy('posko_id', 'DESC')->paginate(10)->withQueryString();

        return view('pages.admin.posko_bencana.index', compact('posko', 'alamatList'));
    }

    // ➤ Form tambah posko
    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('pages.admin.posko_bencana.create', compact('kejadian'));
    }

    // ➤ Simpan posko baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id',
            'nama'             => 'required|string|max:255',
            'alamat'           => 'required|string|max:255',
            'kontak'           => 'nullable|string|max:50',
            'penanggung_jawab' => 'nullable|string|max:100',
            'foto'             => 'nullable|image|max:20480',
        ]);

        $posko = PoskoBencana::create($validated);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('uploads/posko', 'public');

            Media::create([
                'ref_table' => 'posko_bencana',
                'ref_id'    => $posko->posko_id,
                'file_url'  => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return redirect()->route('admin.posko.index')
            ->with('success', 'Posko berhasil ditambahkan!');
    }

    // ➤ Show detail posko
    public function show($id)
    {
        $posko = PoskoBencana::with('kejadian', 'media')->findOrFail($id);
        return view('pages.admin.posko_bencana.show', compact('posko'));
    }

    // ➤ Form edit posko
    public function edit($id)
    {
        $posko    = PoskoBencana::with('kejadian', 'media')->findOrFail($id);
        $kejadian = KejadianBencana::all();

        return view('pages.admin.posko_bencana.edit', compact('posko', 'kejadian'));
    }

    // ➤ Update posko
    public function update(Request $request, $id)
    {
        $posko = PoskoBencana::findOrFail($id);

        $validated = $request->validate([
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id',
            'nama'             => 'required|string|max:255',
            'alamat'           => 'required|string|max:255',
            'kontak'           => 'nullable|string|max:50',
            'penanggung_jawab' => 'nullable|string|max:100',
            'foto'             => 'nullable|image|max:20480',
        ]);

        $posko->update($validated);

        // Update atau tambah media jika ada file baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('uploads/posko', 'public');

            $media = Media::where('ref_table', 'posko_bencana')
                ->where('ref_id', $posko->posko_id)
                ->first();

            if ($media) {
                if (Storage::disk('public')->exists($media->file_url)) {
                    Storage::disk('public')->delete($media->file_url);
                }
                $media->update([
                    'file_url'  => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            } else {
                Media::create([
                    'ref_table' => 'posko_bencana',
                    'ref_id'    => $posko->posko_id,
                    'file_url'  => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('admin.posko.index')
            ->with('success', 'Data posko berhasil diperbarui.');
    }

    // ➤ Hapus posko
    public function destroy($id)
    {
        $posko = PoskoBencana::findOrFail($id);

        // Hapus media terkait
        $media = $posko->media;
        if ($media) {
            foreach ($media as $m) {
                if (Storage::disk('public')->exists($m->file_url)) {
                    Storage::disk('public')->delete($m->file_url);
                }
                $m->delete();
            }
        }

        $posko->delete();

        return redirect()->route('admin.posko.index')
            ->with('success', 'Posko berhasil dihapus.');
    }
}
