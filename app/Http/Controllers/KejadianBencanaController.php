<?php
namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;

class KejadianBencanaController extends Controller
{

    public function index()
    {
        $data = [
            'totalKejadian'     => KejadianBencana::count(),
            'kejadianAktif'     => KejadianBencana::where('status_kejadian', 'Aktif')->count(),
            'totalPosko'        => PoskoBencana::count(),
            'totalDonasi'       => DonasiBencana::sum('nilai'),
            'totalLogistik'     => LogistikBencana::count(),
            'totalStokLogistik' => LogistikBencana::sum('stok'),
            'totalDistribusi'   => DistribusiLogistik::count(),
            'totalPenerima'     => DistribusiLogistik::distinct('penerima')->count('penerima'),
            'kejadian'          => KejadianBencana::all(), // ✅ Tambahkan di array
        ];

        return view('admin.kejadian_bencana.index', $data);
    }

    /**
     * ➕ Form tambah data
     */
    public function create()
    {
        return view('admin.kejadian_bencana.create');
    }

    /**
     * 💾 Simpan data baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string|max:255',
            'rt'              => 'nullable|string|max:5',
            'rw'              => 'nullable|string|max:5',
            'dampak'          => 'nullable|string|max:255',
            'status_kejadian' => 'required|string|max:50',
            'keterangan'      => 'nullable|string',

                                                                                           // Validasi media tunggal
            'media'           => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,pdf|max:20480', // max 20MB
            'caption'         => 'nullable|string|max:255',
        ]);

        // Simpan data kejadian bencana
        $kejadian = KejadianBencana::create([
            'jenis_bencana'   => $validated['jenis_bencana'],
            'tanggal'         => $validated['tanggal'],
            'lokasi_text'     => $validated['lokasi_text'],
            'rt'              => $validated['rt'] ?? null,
            'rw'              => $validated['rw'] ?? null,
            'dampak'          => $validated['dampak'] ?? null,
            'status_kejadian' => $validated['status_kejadian'],
            'keterangan'      => $validated['keterangan'] ?? null,
        ]);

        // Jika ada upload media
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $path = $file->store('uploads/media', 'public');

            Media::create([
                'ref_table'  => 'kejadian_bencana',
                'ref_id'     => $kejadian->kejadian_id, // Sesuai primary key
                'file_url'   => $path,
                'caption'    => $request->caption,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => 1,
            ]);
        }

        return redirect()->route('kejadian.index')->with('success', 'Data kejadian dan media berhasil disimpan!');
    }

    /**
     * 🔍 Menampilkan detail kejadian
     */
    public function show($id)
    {
        // $kejadian = KejadianBencana::with('media')->findOrFail($id);
        $kejadian = KejadianBencana::findOrFail($id);
        return view('admin.kejadian_bencana.show', compact('kejadian'));
    }

    /**
     * ✏️ Form edit data
     */
    public function edit($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('admin.kejadian_bencana.edit', compact('kejadian'));
    }

    /**
     * 🔁 Update data
     */
    public function update(Request $request, $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        // Aturan validasi dasar (tidak termasuk media)
        $rules = [
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string|max:255',
            'rt'              => 'nullable|string|max:5',
            'rw'              => 'nullable|string|max:5',
            'dampak'          => 'nullable|string|max:255',
            'status_kejadian' => 'required|string|max:50',
            'keterangan'      => 'nullable|string',
            'caption'         => 'nullable|string|max:255',
        ];

        // Hanya tambahkan aturan file jika ada file yang diupload
        if ($request->hasFile('media')) {
            $rules['media'] = 'file|mimes:jpg,jpeg,png,mp4,mov,pdf|max:20480'; // max 20MB
        } else {
            // pastikan media tidak divalidasi sebagai required/file jika tidak dikirim
            $rules['media'] = 'nullable';
        }

        // Validasi
        $validated = $request->validate($rules);

        // Update data kejadian
        $kejadian->update([
            'jenis_bencana'   => $validated['jenis_bencana'],
            'tanggal'         => $validated['tanggal'],
            'lokasi_text'     => $validated['lokasi_text'],
            'rt'              => $validated['rt'] ?? null,
            'rw'              => $validated['rw'] ?? null,
            'dampak'          => $validated['dampak'] ?? null,
            'status_kejadian' => $validated['status_kejadian'],
            'keterangan'      => $validated['keterangan'] ?? null,
        ]);

        // Jika ada file baru, proses upload & replace media lama
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $path = $file->store('uploads/media', 'public');

            $media = Media::where('ref_table', 'kejadian_bencana')
                ->where('ref_id', $kejadian->kejadian_id)
                ->first();

            if ($media) {
                // Pastikan menghapus file lama jika ada
                if (\Storage::disk('public')->exists($media->file_url)) {
                    \Storage::disk('public')->delete($media->file_url);
                }

                $media->update([
                    'file_url'  => $path,
                    'caption'   => $request->caption ?? $media->caption,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            } else {
                Media::create([
                    'ref_table'  => 'kejadian_bencana',
                    'ref_id'     => $kejadian->kejadian_id,
                    'file_url'   => $path,
                    'caption'    => $request->caption ?? '',
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => 1,
                ]);
            }
        } else {
            // Jika hanya caption yang diubah dan media record exist, update caption saja
            if (! empty($request->caption)) {
                $media = Media::where('ref_table', 'kejadian_bencana')
                    ->where('ref_id', $kejadian->kejadian_id)
                    ->first();

                if ($media) {
                    $media->update(['caption' => $request->caption]);
                }
            }
        }

        return redirect()->route('kejadian.index')->with('success', 'Data kejadian dan media berhasil diperbarui!');
    }

    /**
     * 🗑️ Hapus data kejadian
     */
    public function destroy($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        $kejadian->delete();

        return back()->with('success', 'Data kejadian berhasil dihapus.');
    }

}
