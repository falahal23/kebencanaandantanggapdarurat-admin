@extends('layouts.admin.app')
@section('content')

    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full px-3">
            <div class="bg-white rounded-2xl shadow-xl">

                {{-- HEADER --}}
                <div class="p-6 border-b border-gray-200 bg-white shadow-sm rounded-t-2xl flex justify-between items-center">
                    <!-- Judul + Ikon -->
                    <div class="flex items-center gap-3">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-100 text-green-600 shadow">
                            <span class="text-xl">➕</span>
                        </div>
                        <div>
                            <h1
                                class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight border-b-4 border-green-300 pb-1 drop-shadow-sm">
                                Tambah Kejadian Bencana
                            </h1>
                            <p class="text-sm text-slate-500 mt-1">
                                Formulir untuk menambahkan data kejadian bencana secara lengkap dan akurat
                            </p>
                        </div>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="p-6">

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kejadian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- JENIS --}}
                            <div>
                                <label class="block text-sm font-medium mb-1">Jenis Bencana</label>
                                <input type="text" name="jenis_bencana" class="w-full p-2 border rounded-lg" required>
                            </div>

                            {{-- TANGGAL --}}
                            <div>
                                <label class="block text-sm font-medium mb-1">Tanggal</label>
                                <input type="date" name="tanggal" class="w-full p-2 border rounded-lg" required>
                            </div>

                            {{-- LOKASI --}}
                            <div>
                                <label class="block text-sm font-medium mb-1">Lokasi</label>
                                <input type="text" name="lokasi_text" class="w-full p-2 border rounded-lg" required>
                            </div>

                            {{-- RT --}}
                            <div>
                                <label class="block text-sm font-medium mb-1">RT</label>
                                <input type="text" name="rt" class="w-full p-2 border rounded-lg">
                            </div>

                            {{-- RW --}}
                            <div>
                                <label class="block text-sm font-medium mb-1">RW</label>
                                <input type="text" name="rw" class="w-full p-2 border rounded-lg">
                            </div>

                            {{-- DAMPAK --}}
                            <div>
                                <label class="block text-sm font-medium mb-1">Dampak</label>
                                <input type="text" name="dampak" class="w-full p-2 border rounded-lg">
                            </div>

                            {{-- STATUS --}}
                            <div>
                                <label class="block text-sm font-medium mb-1">Status Kejadian</label>
                                <select name="status_kejadian" class="w-full p-2 border rounded-lg" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Sedang Ditangani">Ditangani</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>

                            {{-- MEDIA --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold mb-2">
                                    Upload Media (Foto / Video / File)
                                </label>
                                <input type="file" name="media" accept="image/*,video/*,.pdf"
                                    class="w-full px-3 py-2 border rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Maksimal 20MB (1 file)</p>
                                {{-- KETERANGAN --}}
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-1">Keterangan</label>
                                    <textarea name="keterangan" rows="4" class="w-full p-2 border rounded-lg resize-none"
                                        placeholder="Masukkan keterangan tambahan mengenai kejadian">{{ old('keterangan') }}</textarea>
                                </div>

                            </div>

                            {{-- PREVIEW --}}
                            <div class="col-span-2">
                                <label class="block mb-2 font-medium">Upload Foto jika ada (opsional)</label>
                                <div class="mb-4 media-card w-40 h-40 rounded border overflow-hidden">
                                    <img id="preview-foto" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                        alt="Placeholder Foto Posko" class="w-full h-full object-cover">
                                </div>
                                <input type="file" name="media" class="w-full mt-1" accept="image/*"
                                    onchange="document.getElementById('preview-foto').src = window.URL.createObjectURL(this.files[0])">
                            </div>

                        </div>

                        {{-- KEMBALI & SIMPAN --}}
                        <div class="mt-12 flex items-center justify-between">
                            <!-- KIRI -->
                            <a href="{{ route('kejadian.index') }}"
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                ← Batal
                            </a>

                            <!-- KANAN -->
                            <button type="submit"
                                class="px-6 py-3 font-bold text-white rounded-lg
                                       bg-gradient-to-r from-blue-600 to-cyan-400
                                       hover:shadow-lg hover:scale-105 transition">
                                💾 Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- JS PREVIEW --}}
    <script>
        const previewFoto = document.getElementById('preview-foto');
        document.querySelector('input[name="media"]').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                previewFoto.src = URL.createObjectURL(file);
            }
        });
    </script>

@endsection
