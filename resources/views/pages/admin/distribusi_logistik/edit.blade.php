@extends('layouts.admin.app')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8">

        <!-- Card Utama -->
        <div class="bg-white shadow-xl rounded-2xl ring-1 ring-gray-100">
            <!-- Header -->
            <h1 class="text-4xl font-semibold text-blue-700 mb-8 border-b-4 border-blue-300 pb-2 drop-shadow-sm">
                Edit Distribusi Logistik
            </h1>

            <form action="{{ route('admin.distribusi_logistik.update', $distribusi->distribusi_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Logistik --}}
                    <div>
                        <label class="block mb-2 font-medium">Pilih Logistik</label>
                        <select name="logistik_id" required
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                            @foreach ($logistik as $l)
                                <option value="{{ $l->logistik_id }}"
                                    {{ $l->logistik_id == $distribusi->logistik_id ? 'selected' : '' }}>
                                    {{ $l->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Posko --}}
                    <div>
                        <label class="block mb-2 font-medium">Pilih Posko</label>
                        <select name="posko_id" required
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                            @foreach ($posko as $p)
                                <option value="{{ $p->posko_id }}"
                                    {{ $p->posko_id == $distribusi->posko_id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block mb-2 font-medium">Tanggal Distribusi</label>
                        <input type="date" name="tanggal" required value="{{ $distribusi->tanggal }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    {{-- Jumlah --}}
                    <div>
                        <label class="block mb-2 font-medium">Jumlah</label>
                        <input type="number" name="jumlah" required value="{{ $distribusi->jumlah }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    {{-- Penerima --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Nama Penerima</label>
                        <input type="text" name="penerima" required value="{{ $distribusi->penerima }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    {{-- Bukti --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Upload Bukti (Opsional)</label>

                        {{-- PREVIEW GAMBAR --}}
                        <div class="col-span-2">
                            <label class="block mb-2 font-medium">Upload Foto jika ada (opsional)</label>
                            <div class="mb-4 media-card w-40 h-40 rounded border overflow-hidden">
                                <img id="preview-foto" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                    alt="Placeholder Foto Distribusi Logistik" class="w-full h-full object-cover">
                            </div>
                            <input type="file" name="media" class="w-full mt-1" accept="image/*"
                                onchange="document.getElementById('preview-foto').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                    </div>

                </div>

                {{-- BUTTONS --}}
                <div class="mt-8 flex justify-between items-center">
                    <!-- Kiri: Batal -->
                    <a href="{{ route('distribusi.index') }}"
                        class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-semibold">
                        ← Batal
                    </a>

                    <!-- Kanan: Simpan -->
                    <button type="submit"
                        class="px-6 py-3 font-bold text-white rounded-lg
                           bg-gradient-to-r from-blue-600 to-cyan-400
                           hover:shadow-lg hover:scale-105 transition">
                        💾 Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
