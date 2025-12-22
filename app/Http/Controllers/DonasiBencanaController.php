<?php
namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonasiBencanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole:User');
    }

    public function index(Request $request)
    {
        $query = DonasiBencana::with('kejadian');

        // === SEARCH ===
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('donatur_nama', 'like', '%' . $request->search . '%')
                    ->orWhere('jenis', 'like', '%' . $request->search . '%')
                    ->orWhere('nilai', 'like', '%' . $request->search . '%');
            });
        }

        // === FILTER KEJADIAN ===
        // === FILTER JENIS DONASI ===
        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

// Eksekusi query
        $donasi = $query->paginate(10)->appends($request->query());

// Untuk dropdown filter jenis donasi
        $jenisList = DonasiBencana::select('jenis')->distinct()->pluck('jenis');

        return view('pages.admin.donasi_bencana.index',compact('donasi', 'jenisList')
        );

    }

    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('pages.admin.donasi_bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id'  => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|string|max:100',
            'jenis'        => 'required|string|max:50',
            'nilai'        => 'required|numeric|min:1',
            'bukti'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        $donasi = DonasiBencana::create($validated);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $path = $file->store('uploads/donasi', 'public');

            Media::create([
                'ref_table'  => 'donasi_bencana',
                'ref_id'     => $donasi->donasi_id,
                'file_url'   => $path,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => 1,
            ]);
        }

        return redirect()->route('admin.donasi.index')->with('success', 'Donasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $donasi   = DonasiBencana::with('media')->findOrFail($id);
        $kejadian = KejadianBencana::all();
        return view('pages.admin.donasi_bencana.edit', compact('donasi', 'kejadian'));
    }

    public function update(Request $request, $id)
    {
        $donasi = DonasiBencana::findOrFail($id);

        $validated = $request->validate([
            'kejadian_id'  => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|string|max:100',
            'jenis'        => 'required|string|max:50',
            'nilai'        => 'required|numeric|min:1',
            'bukti'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        $donasi->update($validated);

        if ($request->hasFile('bukti')) {
            $media = Media::where('ref_table', 'donasi_bencana')
                ->where('ref_id', $donasi->donasi_id)
                ->first();

            if ($media) {
                if (Storage::disk('public')->exists($media->file_url)) {
                    Storage::disk('public')->delete($media->file_url);
                }
                $media->delete();
            }

            $file = $request->file('bukti');
            $path = $file->store('uploads/donasi', 'public');

            Media::create([
                'ref_table'  => 'donasi_bencana',
                'ref_id'     => $donasi->donasi_id,
                'file_url'   => $path,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => 1,
            ]);
        }

        return redirect()->route('admin.donasi.index')->with('success', 'Donasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $donasi = DonasiBencana::findOrFail($id);

        $media = Media::where('ref_table', 'donasi_bencana')
            ->where('ref_id', $donasi->donasi_id)
            ->first();

        if ($media) {
            if (Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }
            $media->delete();
        }

        $donasi->delete();

        return back()->with('success', 'Data donasi dihapus!');
    }

    public function show($id)
    {
        $donasi = DonasiBencana::with('kejadian', 'media')->findOrFail($id);
        return view('pages.admin.donasi_bencana.show', compact('donasi'));
    }
}
