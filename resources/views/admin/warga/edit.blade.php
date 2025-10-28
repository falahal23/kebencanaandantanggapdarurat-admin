@extends('layouts.admin.app')

@section('content')
<div class="flex flex-wrap my-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 lg:w-12/12">
        <div class="border-black/12.5 shadow-soft-xl relative flex flex-col break-words bg-white rounded-2xl">

            <!-- Header Card -->
            <div class="border-b border-gray-200 p-6 flex justify-between items-center">
                <h6 class="text-lg font-semibold">Edit Data Warga</h6>
                <a href="{{ route('warga.index') }}"
                   class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>

            <!-- Body Form -->
            <div class="p-6">
                {{-- Pesan Error Validasi --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="list-disc pl-5 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Edit Warga --}}
                <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- No. KTP -->
                        <div>
                            <label class="block text-sm font-medium mb-1">No. KTP</label>
                            <input type="text" name="no_ktp" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                   value="{{ old('no_ktp', $warga->no_ktp) }}" required>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                   value="{{ old('nama', $warga->nama) }}" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Agama -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Agama</label>
                            <input type="text" name="agama" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                   value="{{ old('agama', $warga->agama) }}" required>
                        </div>

                        <!-- Pekerjaan -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                   value="{{ old('pekerjaan', $warga->pekerjaan) }}">
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label class="block text-sm font-medium mb-1">No. Telepon</label>
                            <input type="text" name="telp" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                   value="{{ old('telp', $warga->telp) }}">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                   value="{{ old('email', $warga->email) }}">
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-6 flex justify-end space-x-2">

                        <button type="submit"
                                class="px-6 py-3 font-bold text-white uppercase bg-gradient-to-tl from-gray-900 to-slate-800 rounded-lg shadow-md hover:scale-102 transition">
                            Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
