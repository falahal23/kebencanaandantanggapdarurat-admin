@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <style>
            .media-image {
                max-width: 100%;
                height: auto;
                border-radius: 12px;
                object-fit: cover;
            }

            .info-card {
                background: #ffffff;
                border-radius: 14px;
                padding: 20px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            }

            .label {
                font-weight: 600;
                color: #4B5563;
            }

            .value {
                color: #111827;
            }
        </style>

        <h1 class="text-3xl font-bold text-gray-700 mb-6 tracking-wide">
            📌 Detail Donasi Bencana
        </h1>

        <div class="info-card">

            {{-- Grid Informasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <div class="label">Donatur</div>
                    <div class="value text-lg">{{ $donasi->donatur_nama }}</div>
                </div>

                <div>
                    <div class="label">Jenis Donasi</div>
                    <div class="value text-lg">{{ $donasi->jenis }}</div>
                </div>

                <div>
                    <div class="label">Nilai Donasi</div>
                    <div class="value text-lg">
                        Rp {{ number_format($donasi->nilai, 0, ',', '.') }}
                    </div>
                </div>

                {{-- Kejadian --}}
                <div>
                    <div class="label">Kejadian Bencana</div>

                    @if ($donasi->kejadian)
                        <div class="value text-lg">
                            {{ $donasi->kejadian->jenis_bencana }} <br>
                            <span class="text-sm text-gray-500">
                                {{ $donasi->kejadian->lokasi_text }} •
                                {{ \Carbon\Carbon::parse($donasi->kejadian->tanggal)->format('d M Y') }}
                            </span>
                        </div>
                    @else
                        <div class="value">-</div>
                    @endif
                </div>

            </div>

            {{-- Bukti Donasi --}}
            <div class="mt-8">
                <div class="label mb-2">Bukti Donasi</div>

                @php $media = $donasi->media->first(); @endphp

                @if ($media)
                    {{-- Jika file adalah gambar --}}
                    @if (in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                        <img src="{{ asset('storage/' . $media->file_url) }}" class="media-image shadow-md border mx-auto"
                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;" alt="Bukti Donasi"
                            onerror="this.src='{{ asset('assets-admin/img/spaceholder.png') }}';">

                        <br>
                        <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                            class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            🔍 Lihat Gambar Full
                        </a>

                        {{-- Jika file adalah PDF --}}
                    @elseif ($media->mime_type === 'application/pdf')
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <span class="text-gray-700">📄 File PDF tersedia</span>
                            <br>
                            <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                📥 Download / Lihat PDF
                            </a>
                        </div>

                        {{-- Format lainnya --}}
                    @else
                        <p class="text-gray-500">Format tidak dapat ditampilkan.</p>
                        <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                            class="text-blue-600 underline">Download File</a>
                    @endif
                @else
                    {{-- Jika tidak ada media, tampilkan placeholder --}}
                    <img src="{{ asset('assets-admin/img/spaceholder.png') }}" class="media-image shadow-md border mx-auto"
                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px;"
                        alt="Placeholder Bukti Donasi">

                    <p class="text-gray-500 mt-2">Tidak ada bukti donasi.</p>
                @endif
            </div>

            {{-- Tombol kembali --}}
            <div class="mt-8">
                <a href="{{ route('admin.donasi.index') }}"
                    class="px-6 py-3 font-semibold text-white bg-gray-600 hover:bg-gray-700 rounded-lg transition">
                    ← Kembali
                </a>
            </div>

        </div>

    </div>
@endsection
