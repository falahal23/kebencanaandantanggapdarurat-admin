@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <div class="p-6 border-b border-gray-200 bg-white shadow-sm rounded-t-2xl flex justify-between items-center">
            <!-- Judul + Ikon -->
            <div class="flex items-center gap-3">
                <!-- Icon / Logo -->
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-100 text-red-600 shadow">
                    <!-- Icon Hati untuk donasi -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3
                                 c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3
                                 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
                <div>
                    <h1
                        class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight border-b-4 border-red-300 pb-1 drop-shadow-sm">
                        Tambah Donasi Bencana
                    </h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Formulir untuk menambahkan data donasi bencana secara lengkap dan akurat
                    </p>
                </div>
            </div>
        </div>


        {{-- Notifikasi error --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                <strong>Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.donasi.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Kejadian -->
                <div class="col-span-2">
                    <label class="block mb-2 font-medium">Kejadian Bencana</label>
                    <select name="kejadian_id"
                        class="w-full border rounded-lg p-3 bg-gray-50 focus:ring focus:ring-gray-200" required>
                        <option value="">-- Pilih Kejadian --</option>
                        @foreach ($kejadian as $k)
                            <option value="{{ $k->kejadian_id }}"
                                {{ old('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                                {{ $k->jenis_bencana }} | {{ $k->lokasi_text }} |
                                {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Donatur -->
                <div>
                    <label class="block mb-2 font-medium">Nama Donatur</label>
                    <input type="text" name="donatur_nama" value="{{ old('donatur_nama') }}"
                        class="w-full border rounded-lg p-3 bg-gray-50 focus:ring focus:ring-gray-200" required>
                </div>

                <!-- Jenis -->
                <div>
                    <label class="block mb-2 font-medium">Jenis Donasi</label>
                    <input type="text" name="jenis" value="{{ old('jenis') }}"
                        class="w-full border rounded-lg p-3 bg-gray-50 focus:ring focus:ring-gray-200" required>
                </div>

                <!-- Nilai -->
                <div>
                    <label class="block mb-2 font-medium">Nilai Donasi</label>
                    <input type="number" name="nilai" value="{{ old('nilai') }}"
                        class="w-full border rounded-lg p-3 bg-gray-50 focus:ring focus:ring-gray-200" required>
                </div>

                {{-- BUKTI DONASI --}}
                <div class="mt-8">
                    <p class="text-sm text-gray-500">Bukti Donasi</p>

                    @php $media = null; @endphp

                    {{-- Preview Foto / Placeholder --}}
                    <div class="mt-3 w-40 h-40 rounded border overflow-hidden">
                        <img id="preview-bukti" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                            alt="Placeholder Bukti Donasi" class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Upload Bukti Donasi --}}
                <div class="mt-6">
                    <label class="block text-sm mb-2 font-medium">Upload Bukti Donasi (opsional)</label>

                    <input type="file" name="bukti" accept="image/*,application/pdf" class="w-full border rounded p-2"
                        onchange="
                if (this.files[0].type.startsWith('image')) {
                    document.getElementById('preview-bukti').src =
                    window.URL.createObjectURL(this.files[0]);
                }
           ">
                </div>


            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end mt-8 space-x-3">
                <a href="{{ route('admin.donasi.index') }}"
                    class="px-6 py-3 font-semibold text-white bg-gray-600 hover:bg-gray-700 rounded-lg transition">
                    ← Kembali
                </a>

                <button type="submit"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                    <i class="fa fa-save mr-1"></i> Simpan Data Donasi
                </button>
            </div>

        </form>
    </div>

    {{-- Script Preview --}}
    <script>
        function previewImage(event) {
            const output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
