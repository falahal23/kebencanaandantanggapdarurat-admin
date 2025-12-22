@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Detail Distribusi Logistik</h1>
                <p class="mt-1 text-white/90 text-sm">
                    Distribusi logistik ke posko <span class="font-semibold">{{ $distribusi->posko->nama ?? '-' }}</span>
                </p>
            </div>
        </div>
    </div>

    @php
        $media = optional($distribusi->media)->first();
        $placeholder = asset('assets-admin/img/spaceholder.png');
        $previewUrl = $media && \Illuminate\Support\Str::startsWith($media->mime_type, 'image/')
            ? asset(ltrim($media->file_url, '/'))
            : $placeholder;
        $isVideo = $media && \Illuminate\Support\Str::startsWith($media->mime_type, 'video/');
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- KIRI: INFORMASI DISTRIBUSI -->
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl shadow p-6 border">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 border-b pb-2">Informasi Distribusi</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                    <div>
                        <p class="text-gray-500">ID Distribusi</p>
                        <p class="font-semibold text-gray-700">{{ $distribusi->distribusi_id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tanggal Distribusi</p>
                        <p class="font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($distribusi->tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Logistik</p>
                        <p class="font-semibold text-gray-700">{{ $distribusi->logistik->nama_barang ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Jumlah</p>
                        <p class="font-semibold text-gray-700">{{ $distribusi->jumlah }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-500">Penerima</p>
                        <p class="font-semibold text-gray-700">{{ $distribusi->penerima }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-500">Keterangan</p>
                        <p class="italic text-gray-600">{!! nl2br(e($distribusi->keterangan ?? 'Tidak ada keterangan.')) !!}</p>
                    </div>

                </div>

                <!-- Tombol Kembali di kiri bawah -->
                <div class="mt-6">
                    <a href="{{ route('admin.distribusi_logistik.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-lg font-semibold transition">
                        ← Kembali
                    </a>
                </div>
            </div>

        </div>

        <!-- KANAN: MEDIA / BUKTI -->
        <div class="space-y-6">

            <div class="bg-white rounded-2xl shadow p-6 border">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 border-b pb-2">Dokumentasi / Bukti</h2>

                @if ($media)
                    {{-- GAMBAR --}}
                    @if (\Illuminate\Support\Str::startsWith($media->mime_type, 'image/'))
                        <div class="rounded-xl overflow-hidden border mb-4 w-full h-72">
                            <img src="{{ $previewUrl }}" class="w-full h-full object-cover" onerror="this.src='{{ $placeholder }}';">
                        </div>
                        <a href="{{ asset(ltrim($media->file_url, '/')) }}" target="_blank"
                            class="block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            🔍 Lihat Gambar Full
                        </a>

                    {{-- VIDEO --}}
                    @elseif($isVideo)
                        <video controls class="w-full h-72 rounded-lg mb-4">
                            <source src="{{ asset(ltrim($media->file_url, '/')) }}" type="{{ $media->mime_type }}">
                        </video>

                    {{-- PDF --}}
                    @elseif($media->mime_type === 'application/pdf')
                        <div class="p-4 bg-gray-100 rounded-lg text-center mb-4">
                            <p class="text-gray-700 mb-3">📄 File PDF tersedia</p>
                            <a href="{{ asset(ltrim($media->file_url, '/')) }}" target="_blank"
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                📥 Lihat / Download PDF
                            </a>
                        </div>

                    {{-- LAINNYA --}}
                    @else
                        <p class="text-gray-500 mb-2">Format tidak dapat ditampilkan.</p>
                        <a href="{{ asset(ltrim($media->file_url, '/')) }}" class="text-blue-600 underline" target="_blank">
                            Download File
                        </a>
                    @endif
                @else
                    <div class="h-64 flex flex-col items-center justify-center text-gray-400 border rounded-lg">
                        <img src="{{ $placeholder }}" class="w-32 h-32 object-cover rounded-lg mb-2">
                        Tidak ada dokumentasi
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>
@endsection
