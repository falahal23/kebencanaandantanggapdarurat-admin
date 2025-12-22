@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <!-- HEADER -->
    <div class="mb-6 rounded-xl p-6 text-white bg-gradient-to-r from-indigo-600 to-blue-500 shadow-lg">
        <h1 class="text-2xl font-bold text-white">Detail Posko Bencana</h1>
        <p class="text-sm opacity-90">
            Informasi lengkap mengenai posko terkait kejadian bencana
        </p>
    </div>

    @php
        $media = $posko->media->first();
        $allMedia = $posko->media;

        $isImage = $media && Str::startsWith($media->mime_type, 'image/');
        $isVideo = $media && Str::startsWith($media->mime_type, 'video/');
    @endphp

    <!-- GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KIRI : INFORMASI POSKO -->
        <div class="lg:col-span-2 bg-white shadow rounded-xl border p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Informasi Posko
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                <div>
                    <p class="text-gray-500">ID Posko</p>
                    <p class="font-semibold">{{ $posko->posko_id }}</p>
                </div>

                <div>
                    <p class="text-gray-500">ID Kejadian</p>
                    <p class="font-semibold">{{ $posko->kejadian_id }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Nama Posko</p>
                    <p class="font-semibold">{{ $posko->nama }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Kontak</p>
                    <p class="font-semibold">{{ $posko->kontak ?? '-' }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500">Alamat</p>
                    <p class="font-semibold">{{ $posko->alamat }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500">Penanggung Jawab</p>
                    <p class="font-semibold">{{ $posko->penanggung_jawab ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.posko.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    ← Kembali
                </a>
            </div>
        </div>

        <!-- KANAN : MEDIA -->
        <div class="bg-white shadow rounded-xl border p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Dokumentasi Media
            </h2>

            @if ($media)
                <div class="rounded-lg overflow-hidden border mb-3">
                    @if ($isImage)
                        <img src="{{ asset('storage/' . $media->file_url) }}"
                             class="w-full h-64 object-cover">
                    @elseif ($isVideo)
                        <video controls class="w-full h-64 object-cover">
                            <source src="{{ asset('storage/' . $media->file_url) }}"
                                    type="{{ $media->mime_type }}">
                        </video>
                    @endif
                </div>

                <p class="text-sm text-gray-500 italic text-center">
                    {{ $media->caption ?? '' }}
                </p>
            @else
                <div class="h-64 flex items-center justify-center text-gray-400">
                      <div class="md:col-span-2">
                            <label class="block mb-2 font-medium"></label>
                            <div class="mb-4">
                                <img id="preview-foto" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                    alt="Placeholder Foto kejadian" class="media-image rounded border mb-2">
                            </div>
                        </div>
                </div>
            @endif

        </div>

    </div>

</div>
@endsection
