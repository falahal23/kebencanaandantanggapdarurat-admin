@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Detail Donasi Bencana</h1>

        <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <p class="text-sm text-gray-500">Nama Donatur</p>
                    <p class="text-lg font-semibold">{{ $donasi->donatur_nama }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Jenis Donasi</p>
                    <p class="text-lg font-semibold">{{ $donasi->jenis }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Nilai Donasi</p>
                    <p class="text-lg font-semibold text-green-600">
                        Rp {{ number_format($donasi->nilai, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Kejadian Bencana</p>
                    @if ($donasi->kejadian)
                        <p class="font-semibold">
                            {{ $donasi->kejadian->jenis_bencana }} <br>
                            <span class="text-gray-600">{{ $donasi->kejadian->lokasi_text }}</span> <br>
                            <span class="text-gray-500 text-sm">
                                {{ \Carbon\Carbon::parse($donasi->kejadian->tanggal)->format('d M Y') }}
                            </span>
                        </p>
                    @else
                        <p>-</p>
                    @endif
                </div>

            </div>

            {{-- Bukti Donasi --}}
            <div class="mt-8">
                <p class="text-sm text-gray-500">Bukti Donasi</p>

                @php $media = $donasi->media->first(); @endphp

                @if ($media)
                    <div class="mt-3">
                        <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                            📄 Lihat Bukti Donasi
                        </a>
                    </div>
                @else
                    <p class="text-gray-500 mt-2">Tidak ada bukti donasi.</p>
                @endif
            </div>

            <div class="mt-8">
                <a href="{{ route('admin.donasi.index') }}"
                    class="px-2 py-1 text-xs text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition font-semibold shadow-md whitespace-nowrap">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
