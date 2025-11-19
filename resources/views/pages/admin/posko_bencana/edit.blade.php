@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Tombol Kembali -->
        <a href="{{ route('admin.posko.index') }}" class="text-pink-600 hover:underline mb-6 inline-block">
            ← Kembali ke Daftar Posko
        </a>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-6 text-gray-700">Edit Posko Bencana</h1>

            <!-- Form Edit Posko -->
            <form action="{{ route('admin.posko.update', $posko->posko_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Posko -->
                    <div>
                        <label class="block mb-2 font-medium">Nama Posko</label>
                        <input type="text" name="nama" value="{{ old('nama', $posko->nama) }}"
                            class="w-full border rounded p-2" required>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block mb-2 font-medium">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $posko->alamat) }}"
                            class="w-full border rounded p-2" required>
                    </div>

                    <!-- Kontak -->
                    <div>
                        <label class="block mb-2 font-medium">Kontak</label>
                        <input type="text" name="kontak" value="{{ old('kontak', $posko->kontak) }}"
                            class="w-full border rounded p-2">
                    </div>

                    <!-- Penanggung Jawab -->
                    <div>
                        <label class="block mb-2 font-medium">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab"
                            value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}"
                            class="w-full border rounded p-2">
                    </div>

                    <!-- Kejadian Bencana (Relasi) -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Kejadian Bencana</label>
                        <select name="kejadian_id" class="w-full border rounded p-2" required>
                            <option value="">-- Pilih Kejadian --</option>
                            @foreach ($kejadian as $item)
                                <option value="{{ $item->kejadian_id }}"
                                    {{ old('kejadian_id', $item->kejadian_id) == $item->kejadian_id ? 'selected' : '' }}>
                                    {{ $item->jenis_bencana }} | {{ $item->lokasi_text }} |
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Foto Lama -->
                    <div class="md:col-span-2">
                        <label class="block font-medium mb-2">Foto Lama</label>
                        @php $media = $posko->media->first(); @endphp
                        @if ($media)
                            <img src="{{ asset('storage/' . $media->file_url) }}" class="w-52 h-52 object-cover rounded shadow">
                        @else
                            <p class="text-gray-500">Tidak ada foto.</p>
                        @endif
                    </div>

                    <!-- Upload Foto Baru -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Upload Foto Baru (opsional)</label>
                        <input type="file" name="foto" class="w-full">
                    </div>
                </div>

                <!-- Submit -->
                <!-- Submit / Update Button -->
                <div class="mt-6">
                    <button type="submit"
                                class="px-6 py-3 font-bold text-white uppercase bg-gradient-to-tl from-gray-900 to-slate-800 rounded-lg shadow-md hover:scale-102 transition">
                        <i class="fa fa-save mr-2"></i> Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
