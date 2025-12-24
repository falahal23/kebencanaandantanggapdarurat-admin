@extends('layouts.admin.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<div class="w-full px-6 py-6 bg-white rounded-2xl shadow-soft-xl border-0">
    <div class="bg-white shadow-lg rounded-lg p-6">

        {{-- HEADER --}}
        <h1
            class="text-4xl font-semibold text-blue-700 mb-6
                   border-b-4 border-blue-300 pb-2
                   drop-shadow-sm">
            Edit Kejadian Bencana
        </h1>

        {{-- FORM --}}
        <form action="{{ route('kejadian.update', $kejadian->kejadian_id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Jenis --}}
                <div>
                    <label class="block mb-2 font-medium">Jenis Bencana</label>
                    <input type="text" name="jenis_bencana"
                           value="{{ old('jenis_bencana', $kejadian->jenis_bencana) }}"
                           class="w-full border rounded p-2" required>
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block mb-2 font-medium">Tanggal Kejadian</label>
                    <input type="date" name="tanggal"
                           value="{{ old('tanggal', $kejadian->tanggal) }}"
                           class="w-full border rounded p-2" required>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block mb-2 font-medium">Lokasi</label>
                    <input type="text" name="lokasi_text"
                           value="{{ old('lokasi_text', $kejadian->lokasi_text) }}"
                           class="w-full border rounded p-2">
                </div>

                {{-- Dampak --}}
                <div>
                    <label class="block mb-2 font-medium">Dampak</label>
                    <input type="text" name="dampak"
                           value="{{ old('dampak', $kejadian->dampak) }}"
                           class="w-full border rounded p-2">
                </div>

                {{-- RT --}}
                <div>
                    <label class="block mb-2 font-medium">RT</label>
                    <input type="number" name="rt"
                           value="{{ old('rt', $kejadian->rt) }}"
                           class="w-full border rounded p-2">
                </div>

                {{-- RW --}}
                <div>
                    <label class="block mb-2 font-medium">RW</label>
                    <input type="number" name="rw"
                           value="{{ old('rw', $kejadian->rw) }}"
                           class="w-full border rounded p-2">
                </div>

                {{-- Status --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 font-medium">Status Kejadian</label>
                    <select name="status_kejadian" class="w-full border rounded p-2">
                        <option value="Aktif" {{ $kejadian->status_kejadian == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Sedang Ditangani" {{ $kejadian->status_kejadian == 'Sedang Ditangani' ? 'selected' : '' }}>
                            Sedang Ditangani
                        </option>
                        <option value="Selesai" {{ $kejadian->status_kejadian == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- MEDIA --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 font-medium">Media Kejadian</label>

                    <p class="text-sm text-gray-500 mb-3">
                        ⚠️ Jika upload media baru, semua media lama akan diganti.
                    </p>

                    {{-- MEDIA LAMA --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                        @forelse ($kejadian->media as $m)
                            <div class="border rounded overflow-hidden h-40 bg-gray-100 flex items-center justify-center">
                                @if (Str::startsWith($m->mime_type, 'image/'))
                                    <img src="{{ asset('storage/'.$m->file_url) }}"
                                         class="w-full h-full object-cover">
                                @elseif (Str::startsWith($m->mime_type, 'video/'))
                                    <video controls class="w-full h-full object-cover">
                                        <source src="{{ asset('storage/'.$m->file_url) }}"
                                                type="{{ $m->mime_type }}">
                                    </video>
                                @else
                                    <span class="text-xs p-2 text-center">
                                        {{ basename($m->file_url) }}
                                    </span>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full text-sm text-gray-400 italic">
                                Tidak ada media sebelumnya
                            </div>
                        @endforelse
                    </div>

                    {{-- PREVIEW MEDIA BARU --}}
                    <div id="preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4"></div>

                    {{-- INPUT FILE --}}
                    <input type="file" name="media[]"
                           class="w-full"
                           multiple accept="image/*,video/*,.pdf">
                </div>

                {{-- KETERANGAN --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 font-medium">Keterangan</label>
                    <textarea name="keterangan" rows="4"
                              class="w-full border rounded p-2">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
                </div>

            </div>

            {{-- ACTION --}}
            <div class="mt-8 flex justify-between">
                <a href="{{ route('kejadian.index') }}"
                   class="px-4 py-2 bg-gray-300 rounded">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    💾 Update Kejadian
                </button>
            </div>
        </form>

    </div>
</div>

{{-- ================= JS (SAMA DENGAN POSKO) ================= --}}
<script>
    const placeholderUrl = "{{ asset('assets-admin/img/slideshow/spaceholder.png') }}";

    function showPlaceholder() {
        const container = document.getElementById('preview-container');
        container.innerHTML = '';

        const wrapper = document.createElement('div');
        wrapper.className = 'rounded overflow-hidden border h-40 flex items-center justify-center bg-gray-50';

        const img = document.createElement('img');
        img.src = placeholderUrl;
        img.className = 'w-full h-full object-cover';

        wrapper.appendChild(img);
        container.appendChild(wrapper);
    }

    function renderPreviews(files) {
        const container = document.getElementById('preview-container');
        container.innerHTML = '';

        if (!files || files.length === 0) {
            showPlaceholder();
            return;
        }

        Array.from(files).forEach(file => {
            const wrapper = document.createElement('div');
            wrapper.className = 'rounded overflow-hidden border h-40 flex items-center justify-center bg-gray-50';

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
                const span = document.createElement('div');
                span.innerText = file.name;
                span.className = 'text-xs text-gray-600 p-2 text-center';
                wrapper.appendChild(span);
            }

            container.appendChild(wrapper);
        });
    }

    document.querySelector('input[name="media[]"]').addEventListener('change', e => {
        renderPreviews(e.target.files);
    });

    document.addEventListener('DOMContentLoaded', showPlaceholder);
</script>
@endsection
