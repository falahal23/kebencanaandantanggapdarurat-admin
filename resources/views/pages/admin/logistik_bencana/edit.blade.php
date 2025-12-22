@extends('layouts.admin.app')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8">

        <!-- Card Utama -->
        <div class="bg-white shadow-xl rounded-2xl ring-1 ring-gray-100">

            <!-- Header -->
            <h1
                class="text-4xl font-semibold text-blue-700 mb-6
           border-b-4 border-blue-300 pb-2
           drop-shadow-sm">
                Edit Logistik Bencana
            </h1>


            <!-- Body -->
            <div class="p-6">
                <form action="{{ route('admin.logistik_bencana.update', $logistik->logistik_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Grid Form -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Kejadian -->
                        <div class="col-span-1 md:col-span-2">
                            <label class="block mb-2 font-medium text-gray-700">Kejadian Bencana</label>
                            <select name="kejadian_id" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-300"
                                required>
                                <option value="">-- Pilih Kejadian --</option>
                                @foreach ($kejadian as $k)
                                    <option value="{{ $k->kejadian_id }}"
                                        {{ old('kejadian_id', $logistik->kejadian_id) == $k->kejadian_id ? 'selected' : '' }}>
                                        {{ $k->jenis_bencana }} | {{ $k->lokasi_text }} |
                                        {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama Barang -->
                        <div>
                            <label class="font-semibold text-gray-700">Nama Barang</label>
                            <input type="text" name="nama_barang"
                                class="w-full p-3 border rounded-lg mt-1 focus:ring-2 focus:ring-blue-300"
                                value="{{ $logistik->nama_barang }}" required>
                        </div>

                        <!-- Satuan -->
                        <div>
                            <label class="font-semibold text-gray-700">Satuan</label>
                            <input type="text" name="satuan"
                                class="w-full p-3 border rounded-lg mt-1 focus:ring-2 focus:ring-blue-300"
                                value="{{ $logistik->satuan }}" required>
                        </div>

                        <!-- Stok -->
                        <div>
                            <label class="font-semibold text-gray-700">Stok</label>
                            <input type="number" name="stok"
                                class="w-full p-3 border rounded-lg mt-1 focus:ring-2 focus:ring-blue-300"
                                value="{{ $logistik->stok }}" required>
                        </div>

                        <!-- Sumber -->
                        <div>
                            <label class="font-semibold text-gray-700">Sumber (Opsional)</label>
                            <input type="text" name="sumber"
                                class="w-full p-3 border rounded-lg mt-1 focus:ring-2 focus:ring-blue-300"
                                value="{{ $logistik->sumber }}">
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end mt-8 space-x-3">
                        <a href="{{ route('admin.logistik_bencana.index') }}"
                            class="px-6 py-3 bg-gray-900 text-white rounded-lg shadow-md hover:shadow-lg transition font-semibold">
                            ← Kembali
                        </a>
                        <button type="submit"
                            class="px-5 py-2 text-white bg-blue-600 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
                            💾 Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
