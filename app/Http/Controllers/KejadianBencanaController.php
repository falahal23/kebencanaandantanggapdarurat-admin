<?php
namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KejadianBencanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:User');
    }

    /**
     * 📄 LIST DATA
     */
    public function index(Request $request)
    {
        $query = KejadianBencana::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('jenis_bencana', 'like', "%{$request->search}%")
                    ->orWhere('lokasi_text', 'like', "%{$request->search}%")
                    ->orWhere('keterangan', 'like', "%{$request->search}%");
            });
        }

        if ($request->jenis_bencana) {
            $query->where('jenis_bencana', $request->jenis_bencana);
        }

        if ($request->status_kejadian) {
            $query->where('status_kejadian', $request->status_kejadian);
        }

        if ($request->tanggal_mulai && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [
                $request->tanggal_mulai,
                $request->tanggal_akhir,
            ]);
        }

        $kejadian = $query->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.kejadian_bencana.index', [
            'totalKejadian'     => KejadianBencana::count(),
            'kejadianAktif'     => KejadianBencana::where('status_kejadian', 'Aktif')->count(),
            'totalPosko'        => PoskoBencana::count(),
            'totalDonasi'       => DonasiBencana::sum('nilai'),
            'totalLogistik'     => LogistikBencana::count(),
            'totalStokLogistik' => LogistikBencana::sum('stok'),
            'totalDistribusi'   => DistribusiLogistik::count(),
            'totalPenerima'     => DistribusiLogistik::distinct('penerima')->count('penerima'),
            'kejadian'          => $kejadian,
        ]);
    }

    /**
     * ➕ FORM CREATE
     */
    public function create()
    {
        return view('pages.admin.kejadian_bencana.create');
    }

    /**
     * 💾 SIMPAN DATA
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string|max:255',
            'rt'              => 'nullable|string|max:5',
            'rw'              => 'nullable|string|max:5',
            'dampak'          => 'nullable|string|max:255',
            'status_kejadian' => 'required|string|max:50',
            'keterangan'      => 'nullable|string',

            // ✅ MULTIPLE MEDIA
            'media'           => 'nullable|array',
            'media.*'         => 'file|mimes:jpg,jpeg,png,mp4,mov,pdf|max:20480',
            'caption'         => 'nullable|string|max:255',
        ]);

        $kejadian = KejadianBencana::create($validated);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $path = $file->store('uploads/media', 'public');

                Media::create([
                    'ref_table'  => 'kejadian_bencana',
                    'ref_id'     => $kejadian->kejadian_id,
                    'file_url'   => $path,
                    'caption'    => $request->caption,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i + 1,
                ]);
            }
        }

        return redirect()->route('kejadian.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * ✏️ FORM EDIT
     */
    public function edit($id)
    {
        $kejadian = KejadianBencana::with('media')->findOrFail($id);
        return view('pages.admin.kejadian_bencana.edit', compact('kejadian'));
    }

    /**
     * 🔁 UPDATE DATA (FIX FINAL)
     */
    public function update(Request $request, $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        $validated = $request->validate([
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string|max:255',
            'rt'              => 'nullable|string|max:5',
            'rw'              => 'nullable|string|max:5',
            'dampak'          => 'nullable|string|max:255',
            'status_kejadian' => 'required|string|max:50',
            'keterangan'      => 'nullable|string',

            // ✅ WAJIB BEGINI
            'media'           => 'nullable|array',
            'media.*'         => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,pdf|max:20480',
            'caption'         => 'nullable|string|max:255',
        ]);

        $kejadian->update($validated);

        if ($request->hasFile('media')) {

            // 🔥 hapus media lama + file fisik
            $oldMedia = Media::where('ref_table', 'kejadian_bencana')
                ->where('ref_id', $kejadian->kejadian_id)
                ->get();

            foreach ($oldMedia as $m) {
                if (Storage::disk('public')->exists($m->file_url)) {
                    Storage::disk('public')->delete($m->file_url);
                }
                $m->delete();
            }

            // ✅ simpan media baru
            foreach ($request->file('media') as $i => $file) {
                $path = $file->store('uploads/media', 'public');

                Media::create([
                    'ref_table'  => 'kejadian_bencana',
                    'ref_id'     => $kejadian->kejadian_id,
                    'file_url'   => $path,
                    'caption'    => $request->caption,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i + 1,
                ]);
            }
        }

        return redirect()->route('kejadian.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * 🗑️ HAPUS DATA
     */
    public function destroy($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        $media = Media::where('ref_table', 'kejadian_bencana')
            ->where('ref_id', $kejadian->kejadian_id)
            ->get();

        foreach ($media as $m) {
            if (Storage::disk('public')->exists($m->file_url)) {
                Storage::disk('public')->delete($m->file_url);
            }
            $m->delete();
        }

        $kejadian->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
    public function show($id)
    {
        $kejadian = KejadianBencana::with('logistik', 'posko', 'media', )->findOrFail($id);
        return view('pages.admin.kejadian_bencana.show', compact('kejadian'));
    }
}
