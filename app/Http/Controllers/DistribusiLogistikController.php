<?php
namespace App\Http\Controllers;

use App\Models\DistribusiLogistik; // Pastikan model ini sudah di-import
use App\Models\LogistikBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use App\Models\Warga;
use Illuminate\Http\Request;

class DistribusiLogistikController extends Controller
{
    // =======================
    // INDEX
    // =======================
    public function index()
    {
        // ✅ Perubahan: Menggunakan paginate(10) dan mengurutkan berdasarkan tanggal distribusi terbaru
        $distribusi = DistribusiLogistik::with('logistik', 'posko', 'media', 'warga')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        // $distribusi sekarang berisi objek Paginator
        return view('pages.admin.distribusi_logistik.index', compact('distribusi'));
    }

    // =======================
    // CREATE
    // =======================
    public function create()
    {
        $logistik = LogistikBencana::all();
        $posko    = PoskoBencana::all();
        $warga    = Warga::all();

        return view('pages.admin.distribusi_logistik.create', compact('logistik', 'posko', 'warga'));
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

        // 1. Ambil file 'bukti' dari request, lalu hapus dari array $validated
        $buktiFile = $request->file('bukti');
        unset($validated['bukti']);

        // 2. Simpan distribusi logistik ke database
        $distribusi = DistribusiLogistik::create($validated);

        // 3. Upload bukti distribusi jika ada
        if ($buktiFile) {
            $file = $buktiFile;
            $name = time() . '_' . $file->getClientOriginalName();
            // ✅ Menggunakan Storage::disk('public')->putFileAs() adalah praktik yang lebih baik di Laravel
            // Jika ingin tetap menggunakan public_path, pastikan direktori sudah ada.
            $file->move(public_path('uploads/distribusi'), $name);

            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $distribusi->distribusi_id,
                'file_url'  => '/uploads/distribusi/' . $name,
                'mime_type' => $file->getClientMimeType(),
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
        $distribusi = DistribusiLogistik::with('logistik', 'posko', 'media', 'warga')->findOrFail($id);

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
        $warga      = Warga::all();

        return view('pages.admin.distribusi_logistik.edit', compact(
            'distribusi', 'logistik', 'posko', 'warga'
        ));
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

        // 1. Pisahkan bukti (file) dari data yang akan diupdate ke model
        $buktiFile = $request->file('bukti');
        unset($validated['bukti']);

        // 2. Update data utama
        $distribusi->update($validated);

        // 3. Upload foto baru (jika ada)
        if ($buktiFile) {

            // Hapus media lama
            $old = Media::where('ref_table', 'distribusi_logistik')
                ->where('ref_id', $id)
                ->first();

            if ($old) {
                $oldPath = public_path($old->file_url);

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }

                $old->delete();
            }

            // Upload file baru
            $file = $buktiFile;
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/distribusi'), $name);

            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $id,
                'file_url'  => '/uploads/distribusi/' . $name,
                'mime_type' => $file->getClientMimeType(),
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

        // Hapus media terkait
        $media = Media::where('ref_table', 'distribusi_logistik')
            ->where('ref_id', $id)
            ->first();

        if ($media) {
            $filePath = public_path($media->file_url);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $media->delete();
        }

        // Hapus data utama
        $distribusi->delete();

        return redirect()->route('admin.distribusi_logistik.index')
            ->with('success', 'Distribusi logistik berhasil dihapus.');
    }
}
