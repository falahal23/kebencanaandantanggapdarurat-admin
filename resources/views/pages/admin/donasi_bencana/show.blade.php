@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <!-- HEADER -->
 <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Detail Donasi Bencana</h1>
                    <p class="text-sm opacity-90 mt-1">
                        Informasi lengkap mengenai donasi
                        <span class="font-semibold">{{ $donasi->jenis }}</span>
                    </p>
                </div>

            </div>
        </div>

    @php
        $media = $donasi->media->first();
    @endphp

    <!-- GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KIRI : INFORMASI DONASI -->
        <div class="lg:col-span-2 bg-white shadow rounded-xl border p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Informasi Donasi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 text-sm">

                <div>
                    <p class="text-gray-500">Nama Donatur</p>
                    <p class="font-semibold text-base">{{ $donasi->donatur_nama }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Jenis Donasi</p>
                    <p class="font-semibold text-base">{{ $donasi->jenis }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Nilai Donasi</p>
                    <p class="font-semibold text-base text-green-600">
                        Rp {{ number_format($donasi->nilai, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Kejadian Bencana</p>
                    @if ($donasi->kejadian)
                        <p class="font-semibold text-base">
                            {{ $donasi->kejadian->jenis_bencana }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $donasi->kejadian->lokasi_text }} •
                            {{ \Carbon\Carbon::parse($donasi->kejadian->tanggal)->format('d M Y') }}
                        </p>
                    @else
                        <p class="text-gray-400">-</p>
                    @endif
                </div>

            </div>

            <div class="mt-6">
                <a href="{{ route('admin.donasi.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    ← Kembali
                </a>
            </div>
        </div>

        <!-- KANAN : BUKTI DONASI -->
        <div class="bg-white shadow rounded-xl border p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Bukti Donasi
            </h2>

            @if ($media)

                {{-- GAMBAR --}}
                @if (Str::startsWith($media->mime_type, 'image/'))
                    <div class="rounded-lg overflow-hidden border mb-3">
                        <img src="{{ asset('storage/' . $media->file_url) }}"
                             class="w-full h-64 object-cover"
                             onerror="this.src='{{ asset('assets-admin/img/spaceholder.png') }}';">
                    </div>

                    <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                       class="block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        🔍 Lihat Gambar Full
                    </a>

                {{-- PDF --}}
                @elseif ($media->mime_type === 'application/pdf')
                    <div class="p-4 bg-gray-100 rounded-lg text-center">
                        <p class="text-gray-700 mb-3">📄 File PDF tersedia</p>
                        <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            📥 Lihat / Download PDF
                        </a>
                    </div>

                {{-- LAINNYA --}}
                @else
                    <p class="text-gray-500 mb-2">Format tidak dapat ditampilkan.</p>
                    <a href="{{ asset('storage/' . $media->file_url) }}"
                       class="text-blue-600 underline" target="_blank">
                        Download File
                    </a>
                @endif

            @else
                <div class="h-64 flex flex-col items-center justify-center text-gray-400">
                    <img src="{{ asset('assets-admin/img/spaceholder.png') }}"
                         class="w-32 h-32 object-cover rounded-lg mb-2">
                    Tidak ada bukti donasi
                </div>
            @endif

        </div>

    </div>

</div>
@endsection
