<?php
namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // ✅ Tampilkan semua media
    public function index()
    {
        $media = Media::orderBy('sort_order', 'asc')->get();
        return response()->json($media);
    }

    // ✅ Simpan media baru
    public function store(Request $request)
    {
        $request->validate([
            'ref_table'  => 'required|string|max:100',
            'ref_id'     => 'required|integer',
            'file_url'   => 'required|string',
            'caption'    => 'nullable|string',
            'mime_type'  => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $media = Media::create($request->all());
        return response()->json(['message' => 'Media berhasil ditambahkan', 'data' => $media]);
    }

    // ✅ Detail media
    public function show($id)
    {
        $media = Media::findOrFail($id);
        return response()->json($media);
    }

    // ✅ Update media
    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'ref_table'  => 'required|string|max:100',
            'ref_id'     => 'required|integer',
            'file_url'   => 'required|string',
            'caption'    => 'nullable|string',
            'mime_type'  => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $media->update($request->all());
        return response()->json(['message' => 'Media berhasil diupdate', 'data' => $media]);
    }

    // ✅ Hapus media
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        if (Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        $media->delete();

        return back()->with('success', 'Media berhasil dihapus');
    }
}
