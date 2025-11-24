@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-2xl font-semibold mb-4"> ➕Posko Bencana</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.posko.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Posko -->
                <label class="block mb-2 font-medium">Nama Posko</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded p-2 mb-4"
                    required>

                <!-- Alamat -->
                <label class="block mb-2 font-medium">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full border rounded p-2 mb-4"
                    required>

                <!-- Kontak -->
                <label class="block mb-2 font-medium">Kontak</label>
                <input type="text" name="kontak" value="{{ old('kontak') }}" class="w-full border rounded p-2 mb-4">

                <!-- Penanggung Jawab -->
                <label class="block mb-2 font-medium">Penanggung Jawab</label>
                <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
                    class="w-full border rounded p-2 mb-4">

                <!-- Kejadian Bencana -->
                <label class="block mb-2 font-medium">Kejadian Bencana</label>
                <select name="kejadian_id" class="w-full border rounded p-2 mb-4" required>
                    <option value="">-- Pilih Kejadian --</option>
                    @foreach ($kejadian as $item)
                        <option value="{{ $item->kejadian_id }}"
                            {{ old('kejadian_id') == $item->kejadian_id ? 'selected' : '' }}>
                            {{ $item->jenis_bencana }} | {{ $item->lokasi_text }} |
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </option>
                    @endforeach
                </select>

                <!-- Upload Foto -->
                <label class="block mb-2 font-medium">Upload Foto (opsional)</label>
                <input type="file" name="foto" class="w-full mb-6">

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-2">
                    <button type="submit"
                        class="px-6 py-3 font-bold text-center text-white uppercase rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-102 shadow-soft-md transition">
                        <i class="fa fa-save mr-1"></i>💾Simpan
                    </button>

                    <a href="{{ route('admin.posko.index') }}"
                        class="px-6 py-3 font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition">
                        ← Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>
@endsection
