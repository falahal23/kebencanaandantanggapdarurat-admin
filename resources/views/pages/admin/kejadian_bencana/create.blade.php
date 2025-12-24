@extends('layouts.admin.app')

@section('content')

<div class="flex flex-wrap my-6 -mx-3">
    <div class="w-full px-3">
        <div class="bg-white shadow-xl rounded-2xl border border-gray-200 p-6">

            {{-- HEADER --}}
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-red-100 text-red-600 shadow-sm">
                    <!-- ICON KEJADIAN BENCANA -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                    </svg>
                </div>
                <div>
                    <h1
                        class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight border-b-4 border-red-300 pb-1">
                        Tambah Kejadian Bencana
                    </h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Formulir untuk menambahkan data kejadian bencana secara lengkap dan akurat
                    </p>
                </div>
            </div>

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

            {{-- FORM --}}
            <form action="{{ route('kejadian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- JENIS --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Jenis Bencana</label>
                        <input type="text" name="jenis_bencana"
                            class="w-full p-2 border rounded-lg"
                            value="{{ old('jenis_bencana') }}" required>
                    </div>

                    {{-- TANGGAL --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Kejadian</label>
                        <input type="date" name="tanggal"
                            class="w-full p-2 border rounded-lg"
                            value="{{ old('tanggal') }}" required>
                    </div>

                    {{-- LOKASI --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-1">Lokasi</label>
                        <input type="text" name="lokasi_text"
                            class="w-full p-2 border rounded-lg"
                            value="{{ old('lokasi_text') }}" required>
                    </div>

                    {{-- RT --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">RT</label>
                        <input type="text" name="rt"
                            class="w-full p-2 border rounded-lg"
                            value="{{ old('rt') }}">
                    </div>

                    {{-- RW --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">RW</label>
                        <input type="text" name="rw"
                            class="w-full p-2 border rounded-lg"
                            value="{{ old('rw') }}">
                    </div>

                    {{-- DAMPAK --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Dampak</label>
                        <input type="text" name="dampak"
                            class="w-full p-2 border rounded-lg"
                            value="{{ old('dampak') }}">
                    </div>

                    {{-- STATUS --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Status Kejadian</label>
                        <select name="status_kejadian"
                            class="w-full p-2 border rounded-lg" required>
                            <option value="">-- Pilih --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Sedang Ditangani">Sedang Ditangani</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-1">Keterangan</label>
                        <textarea name="keterangan" rows="4"
                            class="w-full p-2 border rounded-lg resize-none"
                            placeholder="Tambahkan keterangan tambahan">{{ old('keterangan') }}</textarea>
                    </div>

                    {{-- MEDIA --}}
                    <div class="col-span-2">
                        <label class="block mb-2 font-medium">Preview Upload (opsional)</label>

                        <div id="preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                            <div id="placeholder" class="col-span-full text-center">
                                <img src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                    class="mx-auto w-48 h-48 object-cover rounded-lg border">
                                <p class="text-xs text-gray-500 mt-2">Belum ada file dipilih</p>
                            </div>
                        </div>

                        <input id="mediaInput" type="file" name="media[]"
                            class="w-full mt-1"
                            accept="image/*,video/*,.pdf" multiple>
                    </div>

                </div>

                {{-- ACTION --}}
                <div class="mt-8 flex justify-between">
                    <a href="{{ route('kejadian.index') }}"
                        class="px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                        ← Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-400
                               text-white font-bold rounded-lg
                               hover:shadow-lg hover:scale-105 transition">
                        💾 Simpan Kejadian
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- JS PREVIEW --}}
<script>
document.getElementById('mediaInput').addEventListener('change', function () {
    const container = document.getElementById('preview-container');
    const placeholder = document.getElementById('placeholder');

    container.innerHTML = '';
    if (this.files.length === 0) {
        container.appendChild(placeholder);
        return;
    }

    Array.from(this.files).forEach(file => {
        const box = document.createElement('div');
        box.className = 'border rounded-lg overflow-hidden h-40 bg-gray-50 flex items-center justify-center';

        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-full object-cover';
            box.appendChild(img);

        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.className = 'w-full h-full object-cover';
            box.appendChild(video);

        } else {
            const text = document.createElement('div');
            text.className = 'text-xs text-gray-600 p-2 text-center';
            text.innerText = file.name;
            box.appendChild(text);
        }

        container.appendChild(box);
    });
});
</script>

@endsection
