@extends('layouts.admin.app')
@section('content')

    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full px-3">
            <div class="bg-white rounded-2xl shadow-xl">

                {{-- HEADER --}}
                <div class="p-6 border-b flex justify-between items-center">
                    <h6 class="text-lg font-semibold">➕ Tambah Kejadian Bencana</h6>
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

                        <di class="grid grid-cols-1 md:grid-cols-2 gap-4">

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
                                    <option value="Sedang Ditangani">Sedang Ditangani</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>

                            {{-- KETERANGAN --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold mb-2">
                                    Upload Media (Foto / Video / File)
                                </label>

                                <input type="file" name="media" accept="image/*,video/*,.pdf"
                                    class="w-full px-3 py-2 border rounded-lg">

                                <p class="text-xs text-gray-500 mt-1">
                                    Maksimal 20MB (1 file)
                                </p>
                            </div>




                            {{-- PREVIEW --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold mb-2">Preview Media</label>

                                <div class="md:col-span-2">
                                    <label class="block mb-2 font-medium">Upload Foto (opsional)</label>
                                    <div class="mb-4">
                                        <img id="preview-foto" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                            alt="Placeholder Foto kejadian" class="media-image rounded border mb-2">
                                    </div>
                                </div>
                            </div>
                        </di>
                </div>
                {{-- KEMBALI --}}
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
            </div>

            </form>

        </div>
    </div>
    </div>
    </div>

    {{-- JS PREVIEW --}}
    <script>
        function previewFile(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
            }
        }
    </script>

@endsection
