@extends('layouts.admin.app')

@section('content')
<div class="flex flex-wrap my-6 -mx-3">
    <!-- Card Form Posko -->
    <div class="w-full px-3 lg:w-12/12 lg:flex-none">
        <div class="bg-white shadow-xl rounded-2xl border border-gray-200 p-6">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-50 text-green-600 shadow-sm">
                    <i class="fa fa-map-marker-alt text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight border-b-4 border-green-300 pb-1 drop-shadow-sm">
                        Tambah Posko Bencana
                    </h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Formulir untuk menambahkan posko baru, lengkap dengan lokasi, kontak, dan foto.
                    </p>
                </div>
            </div>

            <!-- BODY FORM -->
            <div>
                {{-- Pesan error validasi --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.posko.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- KEJADIAN -->
                        <div>
                            <label for="kejadian_id" class="block text-sm font-medium mb-1">Kejadian Bencana</label>
                            <select name="kejadian_id" id="kejadian_id" class="w-full p-2 border rounded-lg" required>
                                <option value="">-- Pilih Kejadian --</option>
                                @foreach ($kejadian as $k)
                                    <option value="{{ $k->kejadian_id }}" {{ old('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                                        {{ $k->jenis_bencana }} | {{ $k->lokasi_text }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- NAMA POSKO -->
                        <div>
                            <label for="nama" class="block text-sm font-medium mb-1">Nama Posko</label>
                            <input type="text" name="nama" id="nama" class="w-full p-2 border rounded-lg" value="{{ old('nama') }}" required>
                        </div>

                        <!-- ALAMAT -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium mb-1">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="w-full p-2 border rounded-lg" value="{{ old('alamat') }}" required>
                        </div>

                        <!-- KONTAK -->
                        <div>
                            <label for="kontak" class="block text-sm font-medium mb-1">Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="w-full p-2 border rounded-lg" value="{{ old('kontak') }}">
                        </div>

                        <!-- PENANGGUNG JAWAB -->
                        <div>
                            <label for="penanggung_jawab" class="block text-sm font-medium mb-1">Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="w-full p-2 border rounded-lg" value="{{ old('penanggung_jawab') }}">
                        </div>

                        <!-- FOTO POSKO -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Foto Posko (opsional)</label>
                            <input type="file" name="foto" accept="image/*" class="w-full p-2 border rounded-lg" onchange="previewFoto(event)">
                            <p class="text-xs text-gray-500 mt-1">Maksimal 20MB</p>
                            <div class="mt-2">
                                <img id="preview-foto" src="{{ asset('assets-admin/img/spaceholder.png') }}" class="w-48 h-48 object-cover rounded-lg border" alt="Preview Foto Posko">
                            </div>
                        </div>

                    </div>

                    <!-- Tombol -->
                    <div class="mt-6 flex justify-between">
                        <!-- Batal (Kiri) -->
                        <a href="{{ route('admin.posko.index') }}" class="px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition flex items-center justify-center">
                            ← Batal
                        </a>

                        <!-- Simpan (Kanan) -->
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-bold rounded-lg hover:shadow-lg hover:scale-105 transition">
                            💾 Simpan Posko
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- JS Preview Foto --}}
<script>
    function previewFoto(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview-foto');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
