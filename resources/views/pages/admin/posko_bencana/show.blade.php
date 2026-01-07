@extends('layouts.admin.app')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
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

                @if ($posko->media->isNotEmpty())
                    <div class="grid grid-cols-1 gap-3">
                        @foreach ($posko->media as $m)
                            @php
                                $isImage = Str::startsWith($m->mime_type, 'image/');
                                $isVideo = Str::startsWith($m->mime_type, 'video/');
                            @endphp

                            <div class="rounded-lg overflow-hidden border">
                                @if ($isImage)
                                    <img src="{{ asset('storage/' . $m->file_url) }}"
                                        class="w-full h-48 object-cover rounded">
                                @elseif ($isVideo)
                                    <video controls class="w-full h-48 object-cover rounded">
                                        <source src="{{ asset('storage/' . $m->file_url) }}" type="{{ $m->mime_type }}">
                                    </video>
                                @else
                                    <div class="p-4 text-sm text-gray-700">{{ basename($m->file_url) }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="h-64 flex flex-col items-center justify-center text-gray-400 space-y-3">
                        <img src="{{ asset('assets-admin/img/spaceholder.png') }}" alt="Placeholder Foto Posko"
                            class="rounded border w-32 h-32 object-cover">
                        <span class="text-sm">Tidak ada dokumentasi</span>
                    </div>
                @endif

                @if ($media)
                    <div class="mt-4">
                        <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                            class="block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            🔍 Lihat Gambar Full
                        </a>
                    </div>
                @endif

            </div>

        </div>

    </div>
@endsection
