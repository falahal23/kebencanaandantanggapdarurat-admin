@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <h1
            class="text-4xl font-semibold text-blue-700 mb-6
           border-b-4 border-blue-300 pb-2
           drop-shadow-sm">
            Edit Donasi Bencana
        </h1>


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

                    <!-- Preview Foto / PDF / Placeholder -->
                    <div class="mt-3 w-40 h-40 rounded border overflow-hidden">
                        @if ($media)
                            @if (in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                                <img id="preview-bukti" src="{{ asset('storage/' . $media->file_url) }}" alt="Bukti Donasi"
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null;this.src='{{ asset('assets-admin/img/spaceholder.png') }}';">
                            @elseif ($media->mime_type === 'application/pdf')
                                <div
                                    class="p-4 bg-gray-100 rounded-lg w-full h-full flex flex-col justify-center items-center text-center">
                                    <span class="text-gray-700">📄 File PDF tersedia</span>
                                    <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                        class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        📥 Download / Lihat PDF
                                    </a>
                                </div>
                            @else
                                <div class="w-full h-full flex flex-col justify-center items-center text-gray-500 text-sm">
                                    <span>Format file tidak dapat ditampilkan.</span>
                                    <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                        class="text-blue-600 underline">
                                        Download File
                                    </a>
                                </div>
                            @endif
                        @else
                            <img id="preview-bukti" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                alt="Placeholder Bukti Donasi" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                {{-- Upload / Ganti Bukti Donasi --}}
                <div class="mt-6">
                    <label class="block text-sm mb-2 font-medium">Ganti Bukti Donasi (opsional)</label>
                    <input type="file" name="bukti" accept="image/*" class="w-full border rounded p-2"
                        onchange="document.getElementById('preview-bukti').src = window.URL.createObjectURL(this.files[0])">

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
                        class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        💾 Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
