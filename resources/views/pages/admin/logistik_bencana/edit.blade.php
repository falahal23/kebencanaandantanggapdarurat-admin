@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full px-3">

            <div class="shadow-soft-xl rounded-2xl bg-white border border-black/10">

                <!-- Header -->
                <div class="p-6 border-b">
                    <h6 class="text-lg font-bold">🖊️Edit Logistik Bencana</h6>
                    <p class="text-sm text-slate-500 mt-1">Perbarui data logistik sesuai kebutuhan.</p>
                </div>

                <!-- Body -->
                <div class="p-6">

                    <form action="{{ route('admin.logistik_bencana.update', $logistik->logistik_id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                        </select >
                        <div class="mb-4">
                            <label class="font-semibold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="w-full p-3 border rounded-xl mt-1"
                                value="{{ $logistik->nama_barang }}" required>
                        </div>

                        <!-- Satuan -->
                        <div class="mb-4">
                            <label class="font-semibold">Satuan</label>
                            <input type="text" name="satuan" class="w-full p-3 border rounded-xl mt-1"
                                value="{{ $logistik->satuan }}" required>
                        </div>

                        <!-- Stok -->
                        <div class="mb-4">
                            <label class="font-semibold">Stok</label>
                            <input type="number" name="stok" class="w-full p-3 border rounded-xl mt-1"
                                value="{{ $logistik->stok }}" required>
                        </div>

                        <!-- Sumber -->
                        <div class="mb-4">
                            <label class="font-semibold">Sumber (Opsional)</label>
                            <input type="text" name="sumber" class="w-full p-3 border rounded-xl mt-1"
                                value="{{ $logistik->sumber }}">
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('admin.logistik_bencana.index') }}"
                                class="inline-block px-4 py-2 text-white bg-gradient-to-r from-red-600 to-rose-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                                💾Update
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection
