@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <h1 class="text-2xl font-semibold mb-6 text-gray-700">Tambah Donasi Bencana</h1>

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

                <!-- Bukti Donasi + Placeholder -->
                <div class="col-span-2">
                    <label class="block mb-2 font-medium">Upload Bukti Donasi (Opsional)</label>

                    <div class="flex items-center space-x-3 mb-3">
                        <img id="preview" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                            class="w-12 h-12 object-cover rounded-lg border shadow-sm">

                        <input type="file" name="bukti" accept="image/*" onchange="previewImage(event)"
                            class="border rounded-lg p-2 w-full bg-gray-50 focus:ring focus:ring-gray-200">
                    </div>
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
