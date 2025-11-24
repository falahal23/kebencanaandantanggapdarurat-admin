@extends('layouts.admin.app')

@section('content')
<div class="flex flex-wrap my-6 -mx-3">
    <!-- Card Form Warga -->
    <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
        <div
            class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">

            <!-- Header Card -->
            <div
                class="border-black/12.5 mb-0 rounded-t-2xl border-b border-solid bg-white p-6 pb-3 flex justify-between items-center">
                <h6 class="text-lg font-semibold">Tambah Data Warga</h6>
                <a href="{{ route('warga.index') }}"
                   class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>

            <!-- Body Form -->
            <div class="flex-auto p-6">

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
                            <input type="text" name="no_ktp" id="no_ktp"
                                   class="w-full p-2 border rounded-lg"
                                   value="{{ old('no_ktp') }}" required>
                        </div>

                        <div>
                            <label for="nama" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama"
                                   class="w-full p-2 border rounded-lg"
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
                            <input type="text" name="agama" id="agama"
                                   class="w-full p-2 border rounded-lg"
                                   value="{{ old('agama') }}" required>
                        </div>

                        <div>
                            <label for="pekerjaan" class="block text-sm font-medium mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan"
                                   class="w-full p-2 border rounded-lg"
                                   value="{{ old('pekerjaan') }}">
                        </div>

                        <div>
                            <label for="telp" class="block text-sm font-medium mb-1">No. Telepon</label>
                            <input type="text" name="telp" id="telp"
                                   class="w-full p-2 border rounded-lg"
                                   value="{{ old('telp') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" id="email"
                                   class="w-full p-2 border rounded-lg"
                                   value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-6 flex justify-end space-x-2">
                        <button type="submit"
                                class="px-6 py-3 font-bold text-center text-white uppercase rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-102 shadow-soft-md transition">
                            <i class="fa fa-save mr-1"></i> 💾Simpan Data
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
