<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use Illuminate\Http\Request;

class LogistikBencanaController extends Controller
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
        $query = LogistikBencana::with('kejadian');

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('sumber', 'like', "%{$search}%");
            });
        }

        // 🗂 FILTER KEJADIAN
        if ($request->filled('kejadian_id')) {
            $query->where('kejadian_id', $request->kejadian_id);
        }

        $logistik = $query->orderBy('logistik_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        // 🔹 Tambahkan ini supaya compact('kejadians') tidak error
        $kejadians = KejadianBencana::orderBy('tanggal', 'desc')->get();

        return view('pages.admin.logistik_bencana.index', compact('logistik', 'kejadians'));
    }

    // =======================
    // CREATE
    // =======================
    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('pages.admin.logistik_bencana.create', compact('kejadian'));
    }

    // =======================
    // STORE
    // =======================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required',
            'nama_barang' => 'required|string|max:255',
            'satuan'      => 'required|string',
            'stok'        => 'required|numeric',
            'sumber'      => 'nullable|string',
        ]);

        LogistikBencana::create($validated);

        return redirect()->route('admin.logistik_bencana.index')
            ->with('success', 'Data logistik berhasil ditambahkan.');
    }

    // =======================
    // EDIT FORM
    // =======================
    public function edit($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();

        return view('pages.admin.logistik_bencana.edit', compact('logistik', 'kejadian'));
    }

    // =======================
    // UPDATE DATA
    // =======================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required',
            'nama_barang' => 'required|string|max:255',
            'satuan'      => 'required|string',
            'stok'        => 'required|numeric',
            'sumber'      => 'nullable|string',
        ]);

        $logistik = LogistikBencana::findOrFail($id);
        $logistik->update($validated);

        return redirect()->route('admin.logistik_bencana.index')
            ->with('success', 'Data logistik berhasil diperbarui.');
    }

    public function show($id)
    {
        $logistik = LogistikBencana::with('kejadian')->findOrFail($id);

        return view('pages.admin.logistik_bencana.show', compact('logistik'));
    }

    // =======================
    // DELETE / DESTROY
    // =======================
    public function destroy($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $logistik->delete();

        return redirect()->route('admin.logistik_bencana.index')
            ->with('success', 'Data logistik berhasil dihapus.');
    }
}
