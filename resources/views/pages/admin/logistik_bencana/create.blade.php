@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full px-3">

            <div class="p-6 border-b border-gray-200 bg-white shadow-sm rounded-t-2xl flex justify-between items-center">
                <!-- Judul + Ikon -->
                <div class="flex items-center gap-3">
                    <!-- Icon / Logo -->
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 text-blue-600 shadow">
                        <!-- Icon Truk sederhana -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M3 16c0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2-2 .9-2 2zm14 0c0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2-2 .9-2 2zM1 3h14v10H1V3zm16 0h5l3 5v5h-5V3z" />
                        </svg>
                    </div>
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight border-b-4 border-blue-300 pb-1 drop-shadow-sm">
                            Logistik Bencana
                        </h1>
                        <p class="text-sm text-slate-500 mt-1">
                            Formulir untuk menambahkan data logistik bencana dengan lengkap dan akurat
                        </p>
                    </div>
                </div>
            </div>



            <!-- Body -->
            <div class="p-6">

                <form action="{{ route('admin.logistik_bencana.store') }}" method="POST">
                    @csrf

                    <!-- Kejadian -->
                    <label class="block mb-2 font-medium">Kejadian Bencana</label>
                    <select name="kejadian_id" class="w-full border rounded p-2 mb-4" required>
                        <option value="">-- Pilih Kejadian --</option>
                        @foreach ($kejadian as $k)
                            <option value="{{ $k->kejadian_id }}"
                                {{ old('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                                {{ $k->jenis_bencana }} | {{ $k->lokasi_text }} |
                                {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                            </option>
                        @endforeach
                    </select>


                    <!-- Nama Barang -->
                    <div class="mb-4">
                        <label class="font-semibold">Nama Barang</label>
                        <input type="text" name="nama_barang" class="w-full p-3 border rounded-xl mt-1"
                            placeholder="Contoh: Beras, Air Mineral" required>
                    </div>

                    <!-- Satuan -->
                    <div class="mb-4">
                        <label class="font-semibold">Satuan</label>
                        <input type="text" name="satuan" class="w-full p-3 border rounded-xl mt-1"
                            placeholder="Pack, Kg, Liter" required>
                    </div>

                    <!-- Stok -->
                    <div class="mb-4">
                        <label class="font-semibold">Stok</label>
                        <input type="number" name="stok" class="w-full p-3 border rounded-xl mt-1"
                            placeholder="Masukkan jumlah stok" required>
                    </div>

                    <!-- Sumber -->
                    <div class="mb-4">
                        <label class="font-semibold">Sumber (Opsional)</label>
                        <input type="text" name="sumber" class="w-full p-3 border rounded-xl mt-1"
                            placeholder="BPBD, Donatur, Pemerintah">
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2">
                        <button type="submit"
                            class="px-6 py-3 font-bold text-center text-white uppercase rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-102 shadow-soft-md transition">
                            </i> 💾Simpan
                        </button>

                        <a href="{{ route('admin.logistik_bencana.index') }}"
                            class="px-6 py-3 font-bold text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition">
                            ← Kembali
                        </a>
                    </div>
                </form>

            </div>

        </div>

    </div>
    </div>
@endsection
