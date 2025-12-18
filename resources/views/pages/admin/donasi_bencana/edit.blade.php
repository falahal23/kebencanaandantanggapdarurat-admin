@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Donasi Bencana</h1>

        <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">

            {{-- FORM EDIT DONASI --}}
            <form action="{{ route('admin.donasi.update', $donasi->donasi_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- DETAIL DATA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                    {{-- Nama Donatur --}}
                    <div>
                        <label class="text-sm text-gray-500">Nama Donatur</label>
                        <input type="text" name="donatur_nama" value="{{ old('donatur_nama', $donasi->donatur_nama) }}"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Jenis Donasi --}}
                    <div>
                        <label class="text-sm text-gray-500">Jenis Donasi</label>
                        <input type="text" name="jenis" value="{{ old('jenis', $donasi->jenis) }}"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Nilai Donasi --}}
                    <div>
                        <label class="text-sm text-gray-500">Nilai Donasi</label>
                        <input type="number" name="nilai" value="{{ old('nilai', $donasi->nilai) }}"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Kejadian Bencana --}}
                    <div>
                        <label class="text-sm text-gray-500">Kejadian Bencana</label>
                        <select name="kejadian_id" class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-blue-200">
                            <option value="">-- Pilih Kejadian --</option>
                            @foreach ($kejadian as $item)
                                <option value="{{ $item->kejadian_id }}"
                                    {{ old('kejadian_id', $donasi->kejadian_id) == $item->kejadian_id ? 'selected' : '' }}>
                                    {{ $item->jenis_bencana }} |
                                    {{ $item->lokasi_text }} |
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- BUKTI DONASI --}}
                <div class="mt-8">
                    <p class="text-sm text-gray-500">Bukti Donasi</p>

                    @php $media = $donasi->media->first(); @endphp

                    @if ($media)
                        @if (in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                            <img src="{{ asset('storage/' . $media->file_url) }}"
                                class="w-32 h-32 mt-3 rounded object-cover border"  style="width: 100px; height: 100px;" alt="Bukti Donasi"
                                onerror="this.onerror=null;this.src='{{ asset('assets-admin/img/spaceholder.png') }}';">
                        @elseif ($media->mime_type === 'application/pdf')
                            <div class="p-4 bg-gray-100 rounded-lg mt-3">
                                <span class="text-gray-700">📄 File PDF tersedia</span><br>
                                <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                    class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    📥 Download / Lihat PDF
                                </a>
                            </div>
                        @else
                            <p class="text-gray-500 mt-2" style="width: 100px; height: 100px;" >Format file tidak dapat ditampilkan.</p>
                            <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                class="text-blue-600 underline">Download File</a>
                        @endif
                    @else
                        <img src="{{ asset('assets-admin/img/spaceholder.png') }}"
                            class="w-32 h-32 mt-3 rounded object-cover border" style="width: 100px; height: 100px;" alt="Placeholder Bukti Donasi">
                        <p class="text-gray-500 mt-2">Tidak ada bukti donasi.</p>
                    @endif
                </div>

                {{-- GANTI BUKTI --}}
                <div class="mt-6">
                    <label class="block text-sm mb-2 font-medium">Ganti Bukti Donasi (opsional)</label>
                    <input type="file" name="bukti" class="w-full border rounded p-2">

                    @if ($media)
                        <p class="text-xs text-gray-500 mt-1">
                            File saat ini: <strong>{{ basename($media->file_url) }}</strong>
                        </p>
                    @endif
                </div>

                {{-- ACTION --}}
                <div class="flex justify-end mt-6 space-x-3">
                    <a href="{{ route('admin.donasi.index') }}"
                        class="px-4 py-2 bg-gray-600 text-white text-sm rounded-lg hover:bg-gray-700 transition">
                        ← Kembali
                    </a>

                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-black text-sm rounded-lg shadow hover:bg-green-700 transition">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
