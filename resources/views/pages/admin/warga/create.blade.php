@extends('layouts.admin.app')

@section('content')
<div class="flex flex-wrap my-6 -mx-3">
    <div class="w-full max-w-full px-3 lg:w-12/12 lg:flex-none mx-auto">

        <!-- Card Form Warga -->
        <div class="border-black/12.5 shadow-soft-xl relative flex flex-col break-words rounded-2xl border-0 bg-white bg-clip-border">

            <!-- Header Card -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 border-b border-gray-200 rounded-t-2xl">

                <!-- KIRI: Judul + Ikon -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-50 text-blue-600 shadow-sm">
                        <i class="fa fa-user-plus text-xl"></i>
                    </div>
                    <div>
                        <h6 class="text-2xl font-semibold text-slate-800 leading-tight">
                            Tambah Data Warga
                        </h6>
                        <p class="text-sm text-slate-500 flex items-center gap-2 mt-1">
                            <i class="fa fa-info-circle text-blue-500"></i>
                            Formulir untuk menambahkan data warga baru secara lengkap dan akurat
                        </p>
                    </div>
                </div>

            </div>

            <!-- Body Form -->
            <div class="p-6">

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

                {{-- Form Tambah Warga --}}
                <form action="{{ route('warga.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label for="no_ktp" class="block text-sm font-medium mb-1">No. KTP</label>
                            <input type="text" name="no_ktp" id="no_ktp" class="w-full p-2 border rounded-lg"
                                value="{{ old('no_ktp') }}" required>
                        </div>

                        <div>
                            <label for="nama" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="w-full p-2 border rounded-lg"
                                value="{{ old('nama') }}" required>
                        </div>

                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full p-2 border rounded-lg" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label for="agama" class="block text-sm font-medium mb-1">Agama</label>
                            <input type="text" name="agama" id="agama" class="w-full p-2 border rounded-lg"
                                value="{{ old('agama') }}" required>
                        </div>

                        <div>
                            <label for="pekerjaan" class="block text-sm font-medium mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="w-full p-2 border rounded-lg"
                                value="{{ old('pekerjaan') }}">
                        </div>

                        <div>
                            <label for="telp" class="block text-sm font-medium mb-1">No. Telepon</label>
                            <input type="text" name="telp" id="telp" class="w-full p-2 border rounded-lg"
                                value="{{ old('telp') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" id="email" class="w-full p-2 border rounded-lg"
                                value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-6 flex justify-between">
                        <!-- Tombol Kembali (Kiri) -->
                        <a href="{{ route('warga.index') }}"
                            class="px-6 py-3 text-sm font-semibold rounded-lg bg-gray-400 text-white hover:bg-gray-500 transition flex items-center justify-center">
                            ← Kembali
                        </a>

                        <!-- Tombol Simpan (Kanan) -->
                        <button type="submit"
                            class="px-6 py-3 font-bold text-center text-white uppercase rounded-lg
                                bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-105 shadow-soft-md transition">
                            💾 Simpan Data
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
