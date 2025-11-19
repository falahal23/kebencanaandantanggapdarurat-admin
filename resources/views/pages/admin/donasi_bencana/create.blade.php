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
            class="bg-white shadow rounded-lg p-6">
            @csrf

            <!-- Kejadian -->
            <label class="block mb-2 font-medium">Kejadian Bencana</label>
            <select name="kejadian_id" class="w-full border rounded p-2 mb-4" required>
                <option value="">-- Pilih Kejadian --</option>
                @foreach ($kejadian as $k)
                    <option value="{{ $k->kejadian_id }}" {{ old('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                        {{ $k->jenis_bencana }} | {{ $k->lokasi_text }} |
                        {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                    </option>
                @endforeach
            </select>

            <!-- Donatur -->
            <label class="block mb-2 font-medium">Nama Donatur</label>
            <input type="text" name="donatur_nama" value="{{ old('donatur_nama') }}"
                class="w-full border rounded p-2 mb-4" required>

            <!-- Jenis -->
            <label class="block mb-2 font-medium">Jenis Donasi</label>
            <input type="text" name="jenis" value="{{ old('jenis') }}" class="w-full border rounded p-2 mb-4"
                required>

            <!-- Nilai -->
            <label class="block mb-2 font-medium">Nilai Donasi</label>
            <input type="number" name="nilai" value="{{ old('nilai') }}" class="w-full border rounded p-2 mb-4"
                required>

            <!-- Bukti Donasi -->
            <label class="block mb-2 font-medium">Upload Bukti Donasi (opsional)</label>
            <input type="file" name="bukti" class="w-full mb-6">

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-2">
                <button type="submit"
                  class="px-6 py-3 font-bold text-center text-white uppercase rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-102 shadow-soft-md transition">
                    <i class="fa fa-save mr-1"></i> Simpan Data Donasi
                </button>

                <a href="{{ route('admin.donasi.index') }}"
                    class="px-6 py-3 font-bold text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition">
                    ← Kembali
                </a>
            </div>
        </form>

    </div>
@endsection
