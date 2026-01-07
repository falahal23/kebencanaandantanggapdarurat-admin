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
            Edit Posko Bencana
        </h1>

        {{-- FORM --}}
        <form action="{{ route('admin.posko.update', $posko->posko_id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- KEJADIAN --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 font-medium">Kejadian Bencana</label>
                    <select name="kejadian_id" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Kejadian --</option>
                        @foreach ($kejadian as $item)
                            <option value="{{ $item->kejadian_id }}"
                                {{ $item->kejadian_id == $posko->kejadian_id ? 'selected' : '' }}>
                                {{ $item->jenis_bencana }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- NAMA POSKO --}}
                <div>
                    <label class="block mb-2 font-medium">Nama Posko</label>
                    <input type="text" name="nama"
                           value="{{ old('nama', $posko->nama) }}"
                           class="w-full border rounded p-2" required>
                </div>

                {{-- KONTAK --}}
                <div>
                    <label class="block mb-2 font-medium">Kontak</label>
                    <input type="text" name="kontak"
                           value="{{ old('kontak', $posko->kontak) }}"
                           class="w-full border rounded p-2">
                </div>

                {{-- ALAMAT --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 font-medium">Alamat Posko</label>
                    <input type="text" name="alamat"
                           value="{{ old('alamat', $posko->alamat) }}"
                           class="w-full border rounded p-2" required>
                </div>

                {{-- PENANGGUNG JAWAB --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 font-medium">Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab"
                           value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}"
                           class="w-full border rounded p-2">
                </div>

                {{-- MEDIA --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 font-medium">Media Posko</label>

                    <p class="text-sm text-gray-500 mb-3">
                        ⚠️ Jika upload media baru, semua media lama akan diganti.
                    </p>

                    {{-- MEDIA LAMA --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                        @forelse ($posko->media as $m)
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

            </div>

            {{-- ACTION --}}
            <div class="mt-8 flex justify-between">
                <a href="{{ route('admin.posko.index') }}"
                   class="px-4 py-2 bg-gray-300 rounded">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    💾 Update Posko
                </button>
            </div>
        </form>

    </div>
</div>

{{-- ================= JS PREVIEW ================= --}}
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
