@extends('layouts.admin.app')

@section('content')
    <div class="p-6 bg-gray-80 min-h-screen">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Detail Posko Bencana</h1>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200 p-6">

            {{-- ============================= --}}
            {{-- DETAIL POSKO (TABEL) --}}
            {{-- ============================= --}}
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Posko</h2>

            <table class="w-full text-gray-700 mb-8">
                <tr>
                    <td class="font-semibold w-48 py-2">ID Posko</td>
                    <td>: {{ $posko->posko_id }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">ID Kejadian</td>
                    <td>: {{ $posko->kejadian_id }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Nama Posko</td>
                    <td>: {{ $posko->nama }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Alamat</td>
                    <td>: {{ $posko->alamat }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Kontak</td>
                    <td>: {{ $posko->kontak ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Penanggung Jawab</td>
                    <td>: {{ $posko->penanggung_jawab ?? '-' }}</td>
                </tr>
            </table>

            {{-- ============================= --}}
            {{-- BAGIAN MEDIA --}}
            {{-- ============================= --}}
            @php
                $media = $posko->media->first();
                $allMedia = $posko->media;

                $isImage = $media && Str::startsWith($media->mime_type, 'image/');
                $isVideo = $media && Str::startsWith($media->mime_type, 'video/');
            @endphp

            <h2 class="text-xl font-semibold text-gray-800 mb-3">Media Utama</h2>

            {{-- MEDIA UTAMA --}}
            @if ($media)
                <div class="w-60 h-40 rounded-xl overflow-hidden shadow-lg bg-black mb-3">
                    @if ($isImage)
                        <img src="{{ asset('storage/' . $media->file_url) }}" class="w-60 h-60 object-cover"
                            alt="Media Posko">
                    @elseif ($isVideo)
                        <video controls class="w-60 h-60 object-cover rounded-xl">
                            <source src="{{ asset('storage/' . $media->file_url) }}" type="{{ $media->mime_type }}">
                        </video>
                    @else
                        <div class="block mb-2 font-medium">
                            Media tidak didukung
                        </div>
                    @endif
                </div>

                <p class="text-center text-sm font-semibold text-gray-600 italic mb-6">
                    {{ $media->caption ?? '' }}
                </p>
            @else
                <div class="w-full h-40 bg-gray-200 rounded-xl flex items-center justify-center shadow-inner mb-6">
                    <span class="text-gray-400"></span>
                </div>
            @endif

            {{-- ============================= --}}
            {{-- UPLOAD FOTO (PLACEHOLDER KECIL) --}}
            {{-- ============================= --}}
            <label class="block mb-2 font-medium">Upload Foto (opsional)</label>
            <div class="mb-4">
                <img id="preview-foto" src="{{ asset('assets-admin/img/spaceholder.png') }}" alt="Placeholder Foto Posko"
                    class="media-image rounded border mb-2 w-32 h-32 object-cover">

                <input type="file" name="foto" class="w-full" accept="image/*"
                    onchange="document.getElementById('preview-foto').src = window.URL.createObjectURL(this.files[0])">
            </div>

            {{-- ============================= --}}
            {{-- GALERI --}}
            {{-- ============================= --}}
            @if ($allMedia->count() > 1)
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Galeri Posko</h3>

                <div class="block mb-2 font-medium">
                    @foreach ($allMedia as $m)
                        @if (Str::startsWith($m->mime_type, 'image/'))
                            <img src="{{ asset('storage/' . $m->file_url) }}"
                    class="media-image rounded border mb-2 w-32 h-32 object-cover">
                        @endif
                    @endforeach
                </div>
            @endif



            {{-- ============================= --}}
            {{-- TOMBOL KEMBALI --}}
            {{-- ============================= --}}
            <div class="mt-6">
                <a href="{{ route('admin.posko.index') }}"
                    class="px-4 py-2 text-xs font-semibold bg-gray-600 text-black rounded-lg">
                    ← Kembali ke Daftar Posko
                </a>
            </div>

        </div>
    </div>
@endsection
