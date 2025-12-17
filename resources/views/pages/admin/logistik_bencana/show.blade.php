@extends('layouts.admin.app')

@section('content')
<div class="flex flex-wrap my-6 -mx-3">
    <div class="w-full px-3">

        <div class="shadow-soft-xl rounded-2xl bg-white border border-black/10">

            <!-- Header -->
            <div class="p-6 border-b">
                <h6 class="text-lg font-bold">📄 Detail Logistik Bencana</h6>
                <p class="text-sm text-slate-500 mt-1">Informasi lengkap mengenai logistik yang dipilih.</p>
            </div>

            <!-- Body -->
            <div class="p-6">

                <!-- Jika ada gambar -->
                @if ($logistik->gambar)
                    <div class="mb-6">
                        <label class="font-semibold block mb-2">Gambar Barang</label>
                        <img src="{{ asset('storage/' . $logistik->gambar) }}"
                             class="w-48 h-48 object-cover rounded-xl shadow-md border"
                             alt="Gambar Barang">
                    </div>
                @endif


                <!-- Nama Barang -->
                <div class="mb-4">
                    <label class="font-semibold">Nama Barang:</label>
                    <p class="p-3 border rounded-xl mt-1 bg-gray-50">{{ $logistik->nama_barang }}</p>
                </div>

                <!-- Satuan -->
                <div class="mb-4">
                    <label class="font-semibold">Satuan:</label>
                    <p class="p-3 border rounded-xl mt-1 bg-gray-50">{{ $logistik->satuan }}</p>
                </div>

                <!-- Stok -->
                <div class="mb-4">
                    <label class="font-semibold">Stok:</label>
                    <p class="p-3 border rounded-xl mt-1 bg-gray-50">{{ $logistik->stok }}</p>
                </div>

                <!-- Sumber -->
                <div class="mb-4">
                    <label class="font-semibold">Sumber:</label>
                    <p class="p-3 border rounded-xl mt-1 bg-gray-50">
                        {{ $logistik->sumber ?? '-' }}
                    </p>
                </div>

                <!-- Kejadian -->
                <div class="mb-4">
                    <label class="font-semibold">Kejadian Bencana:</label>

                    @if ($logistik->kejadian)
                        <p class="p-3 border rounded-xl mt-1 bg-gray-50">
                            {{ $logistik->kejadian->jenis_bencana }} |
                            {{ $logistik->kejadian->lokasi_text }} |
                            {{ \Carbon\Carbon::parse($logistik->kejadian->tanggal)->format('d M Y') }}
                        </p>
                    @else
                        <p class="p-3 border rounded-xl mt-1 bg-gray-50">Tidak terkait ke kejadian manapun.</p>
                    @endif
                </div>

                <!-- Tombol -->
                <div class="flex justify-end mt-6 space-x-3">
                    <a href="{{ route('admin.logistik_bencana.index') }}"
                        class="inline-block px-4 py-2 text-white bg-gradient-to-r from-red-600 to-rose-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                        ⬅️ Kembali
                    </a>

                    <a href="{{ route('admin.logistik_bencana.edit', $logistik->logistik_id) }}"
                        class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                        ✏️ Edit
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
