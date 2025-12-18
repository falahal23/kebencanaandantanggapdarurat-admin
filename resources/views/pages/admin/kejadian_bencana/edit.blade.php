@extends('layouts.admin.app')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8">

        <!-- Card Utama -->
        <div class="bg-white shadow-xl rounded-2xl ring-1 ring-gray-100">

            <!-- Header -->
            <div class="p-6 border-b flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">🖊️ Edit Kejadian Bencana</h2>
                    <p class="text-sm text-gray-500">Perbarui data kejadian bencana</p>
                </div>

                <a href="{{ route('kejadian.index') }}"
                    class="px-4 py-2 text-sm font-semibold rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                    ← Kembali
                </a>
            </div>

            <!-- Body -->
            <div class="p-6">

                {{-- Error --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM -->
                <form action="{{ route('kejadian.update', $kejadian->kejadian_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Jenis -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Jenis Bencana</label>
                            <input type="text" name="jenis_bencana"
                                class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                                value="{{ old('jenis_bencana', $kejadian->jenis_bencana) }}" required>
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Tanggal Kejadian</label>
                            <input type="date" name="tanggal"
                                class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                                value="{{ old('tanggal', $kejadian->tanggal) }}" required>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Lokasi</label>
                            <input type="text" name="lokasi_text" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('lokasi_text', $kejadian->lokasi_text) }}">
                        </div>

                        <!-- Dampak -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Dampak</label>
                            <input type="text" name="dampak" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('dampak', $kejadian->dampak) }}" required>
                        </div>

                        <!-- RT -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">RT</label>
                            <input type="number" name="rt" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('rt', $kejadian->rt) }}">
                        </div>

                        <!-- RW -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">RW</label>
                            <input type="number" name="rw" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('rw', $kejadian->rw) }}">
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Status Kejadian</label>
                            <select name="status_kejadian" class="w-full px-3 py-2 border rounded-lg" required>
                                <option value="Aktif" {{ $kejadian->status_kejadian == 'Aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="Sedang Ditangani"
                                    {{ $kejadian->status_kejadian == 'Sedang Ditangani' ? 'selected' : '' }}>
                                    Sedang Ditangani
                                </option>
                                <option value="Selesai" {{ $kejadian->status_kejadian == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>

                        <!-- Upload Media -->
                    {{-- UPLOAD MEDIA --}}
<div class="md:col-span-2">
    <label class="block text-sm font-semibold mb-2">
        Upload Media (Foto / Video / File) – Bisa lebih dari satu
    </label>

    <input
        type="file"
        name="media_files[]"
        multiple
        accept="image/*,video/*,.pdf"
        class="w-full px-3 py-2 border rounded-lg"
        onchange="previewMedia(this)"
    >
</div>

{{-- PREVIEW --}}
<div class="md:col-span-2">
    <label class="block text-sm font-semibold mb-2">Preview Media</label>

    <div
        id="media-preview"
        class="flex gap-3 flex-wrap items-start"
    >
        {{-- placeholder awal --}}
        <div
            class="w-[80px] h-[100px] border rounded-lg overflow-hidden flex items-center justify-center bg-gray-100 text-xs text-gray-500"
        >
            Preview
        </div>
    </div>
</div>



                        <!-- Keterangan -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-1">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="w-full px-3 py-2 border rounded-lg">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol Aksi (KE SAMPING) -->
                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('kejadian.index') }}"
                            class="px-6 py-3 rounded-lg bg-gray-300 hover:bg-gray-400 font-semibold">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-6 py-3 font-bold text-white rounded-lg
                               bg-gradient-to-r from-blue-600 to-cyan-400
                               hover:shadow-lg hover:scale-105 transition">
                            💾 Update Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
