@extends('layouts.admin.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<div class="w-full px-6 py-6 bg-white rounded-2xl shadow-soft-xl">

    <!-- HEADER -->
    <div class="mb-6">
        <h1
            class="text-4xl font-semibold text-blue-700
                   border-b-4 border-blue-300 pb-2
                   drop-shadow-sm">
            ✏️ Edit Kejadian Bencana
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Perbarui informasi kejadian bencana secara lengkap
        </p>
    </div>

    {{-- ERROR --}}
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
    <form action="{{ route('kejadian.update', $kejadian->kejadian_id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Jenis -->
            <div>
                <label class="block mb-2 font-medium">Jenis Bencana</label>
                <input type="text" name="jenis_bencana"
                    value="{{ old('jenis_bencana', $kejadian->jenis_bencana) }}"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block mb-2 font-medium">Tanggal Kejadian</label>
                <input type="date" name="tanggal"
                    value="{{ old('tanggal', $kejadian->tanggal) }}"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block mb-2 font-medium">Lokasi</label>
                <input type="text" name="lokasi_text"
                    value="{{ old('lokasi_text', $kejadian->lokasi_text) }}"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Dampak -->
            <div>
                <label class="block mb-2 font-medium">Dampak</label>
                <input type="text" name="dampak"
                    value="{{ old('dampak', $kejadian->dampak) }}"
                    class="w-full border rounded p-2">
            </div>

            <!-- RT -->
            <div>
                <label class="block mb-2 font-medium">RT</label>
                <input type="number" name="rt"
                    value="{{ old('rt', $kejadian->rt) }}"
                    class="w-full border rounded p-2">
            </div>

            <!-- RW -->
            <div>
                <label class="block mb-2 font-medium">RW</label>
                <input type="number" name="rw"
                    value="{{ old('rw', $kejadian->rw) }}"
                    class="w-full border rounded p-2">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-2 font-medium">Status Kejadian</label>
                <select name="status_kejadian" class="w-full border rounded p-2" required>
                    <option value="Aktif" {{ $kejadian->status_kejadian == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Sedang Ditangani" {{ $kejadian->status_kejadian == 'Sedang Ditangani' ? 'selected' : '' }}>Sedang Ditangani</option>
                    <option value="Selesai" {{ $kejadian->status_kejadian == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <!-- MEDIA -->
            <div class="md:col-span-2">
                <label class="block mb-2 font-medium">Media Kejadian</label>
                <p class="text-sm text-gray-500 mb-3">
                    ⚠️ Mengunggah media baru akan mengganti semua media lama
                </p>

                <!-- MEDIA LAMA -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    @forelse ($kejadian->media as $m)
                        <div class="border rounded overflow-hidden h-40 bg-gray-100 flex items-center justify-center">
                            @if (Str::startsWith($m->mime_type, 'image/'))
                                <img src="{{ asset('storage/' . $m->file_url) }}"
                                     class="w-full h-full object-cover">
                            @elseif (Str::startsWith($m->mime_type, 'video/'))
                                <video controls class="w-full h-full object-cover">
                                    <source src="{{ asset('storage/' . $m->file_url) }}"
                                            type="{{ $m->mime_type }}">
                                </video>
                            @else
                                <span class="text-xs p-2 text-gray-600">
                                    {{ basename($m->file_url) }}
                                </span>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 col-span-full">
                            Belum ada media
                        </p>
                    @endforelse
                </div>

                <!-- UPLOAD BARU -->
                <input type="file"
                       name="media[]"
                       multiple
                       accept="image/*,video/*,.pdf"
                       class="w-full border rounded p-2"
                       onchange="renderPreviews(this.files)">
            </div>

            <!-- PREVIEW -->
            <div class="md:col-span-2">
                <label class="block mb-2 font-medium">Preview Media Baru</label>
                <div id="preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4"></div>
            </div>

            <!-- Keterangan -->
            <div class="md:col-span-2">
                <label class="block mb-2 font-medium">Keterangan</label>
                <textarea name="keterangan" rows="3"
                    class="w-full border rounded p-2">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
            </div>

        </div>

        <!-- ACTION -->
        <div class="mt-8 flex justify-between">
            <a href="{{ route('kejadian.index') }}"
               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                ← Kembali
            </a>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded
                       hover:bg-blue-700 transition">
                💾 Update Kejadian
            </button>
        </div>
    </form>
</div>

<!-- JS PREVIEW -->
<script>
function renderPreviews(files) {
    const container = document.getElementById('preview-container');
    container.innerHTML = '';

    if (!files || files.length === 0) return;

    Array.from(files).forEach(file => {
        const wrapper = document.createElement('div');
        wrapper.className = 'border rounded overflow-hidden h-40 bg-gray-100 flex items-center justify-center';

        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-full object-cover';
            wrapper.appendChild(img);
        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.className = 'w-full h-full object-cover';
            wrapper.appendChild(video);
        } else {
            const span = document.createElement('span');
            span.className = 'text-xs p-2 text-gray-600';
            span.innerText = file.name;
            wrapper.appendChild(span);
        }

        container.appendChild(wrapper);
    });
}
</script>
@endsection
