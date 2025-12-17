@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Detail Donasi Bencana</h1>

        <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">

            {{-- DETAIL DATA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <p class="text-sm text-gray-500">Nama Donatur</p>
                    <p class="text-lg font-semibold">{{ $donasi->donatur_nama ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Jenis Donasi</p>
                    <p class="text-lg font-semibold">{{ $donasi->jenis ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Nilai Donasi</p>
                    <p class="text-lg font-semibold text-green-600">
                        Rp {{ number_format($donasi->nilai ?? 0, 0, ',', '.') }}
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

            {{-- BUKTI DONASI --}}
            <div class="mt-8">
                <p class="text-sm text-gray-500">Bukti Donasi</p>

                @php $media = $donasi->media->first(); @endphp

                @if ($media)
                    @if (in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                        {{-- Gambar ada --}}
                        <img src="{{ asset('storage/' . $media->file_url) }}" alt="Bukti Donasi"
                            class="w-48 h-48 mt-3 rounded object-cover border"
                            onerror="this.onerror=null;this.src='{{ asset('assets-admin/img/placeholder.png') }}';">
                    @elseif ($media->mime_type === 'application/pdf')
                        {{-- PDF --}}
                        <div class="p-4 bg-gray-100 rounded-lg mt-3">
                            <span class="text-gray-700">📄 File PDF tersedia</span>
                            <br>
                            <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                📥 Download / Lihat PDF
                            </a>
                        </div>
                    @else
                        {{-- Format lain --}}
                        <p class="text-gray-500 mt-2">Format file tidak dapat ditampilkan.</p>
                        <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                            class="text-blue-600 underline">Download File</a>
                    @endif
                @else
                    {{-- Tidak ada media → pakai placeholder --}}
                    <img src="{{ asset('assets-admin/img/spaceholder.png') }}" alt="Placeholder Bukti Donasi"
                        class="w-48 h-48 mt-3 rounded object-cover border">
                    <p class="text-gray-500 mt-2">Tidak ada bukti donasi.</p>
                @endif
            </div>

            {{-- Update Bukti --}}
            <div class="mt-6">
                <label class="block text-sm mb-2 font-medium">Ganti Bukti Donasi (opsional)</label>
                <input type="file" name="bukti" class="w-full border rounded p-2">
                @if ($media)
                    <p class="text-xs text-gray-500 mt-1">
                        File saat ini: <strong>{{ $media->file_url }}</strong>
                    </p>
                @endif
            </div>

            <div class="flex justify-end mt-6 space-x-3">
                <a href="{{ route('admin.donasi.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white text-sm rounded-lg hover:bg-gray-700 transition">
                    ← Kembali
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg shadow hover:bg-green-700 transition">
                    💾 Simpan Perubahan
                </button>
            </div>

            </form>

        </div>
    </div>
@endsection
