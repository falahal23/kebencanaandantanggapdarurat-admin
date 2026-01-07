@extends('layouts.admin.app')

@section('content')
<div class="flex flex-wrap my-6 -mx-3">

    <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
        <div class="border-black/12.5 shadow-soft-xl relative flex flex-col rounded-2xl bg-white">

            <div class="p-6 border-b border-gray-200 bg-white shadow-sm rounded-t-2xl flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-100 text-green-600 shadow">
                        <span class="text-xl">➕</span>
                    </div>
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight border-b-4 border-green-300 pb-1 drop-shadow-sm">
                            Tambah Data Distribusi Logistik
                        </h1>
                        <p class="text-sm text-slate-500 mt-1">
                            Formulir untuk menambahkan data Distribusi Logistik secara lengkap dan akurat
                        </p>
                    </div>
                </div>
            </div>

            <h2 class="text-3xl font-bold mb-6 text-gray-700 border-b pb-3 px-6 pt-6">
                Tambah Distribusi Logistik
            </h2>

            <form action="{{ route('admin.distribusi_logistik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-6">

                    {{-- Logistik --}}
                    <div>
                        <label class="block mb-2 font-medium">Pilih Logistik</label>
                        <select name="logistik_id" required class="w-full border rounded p-3">
                            <option value="">-- Pilih Logistik --</option>
                            @foreach ($logistik as $item)
                                <option value="{{ $item->logistik_id }}">
                                    {{ $item->nama_logistik }} (Stok: {{ $item->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Posko --}}
                    <div>
                        <label class="block mb-2 font-medium">Posko Tujuan</label>
                        <select name="posko_id" required class="w-full border rounded p-3">
                            <option value="">-- Pilih Posko --</option>
                            @foreach ($posko as $p)
                                <option value="{{ $p->posko_id }}">
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah --}}
                    <div>
                        <label class="block mb-2 font-medium">Jumlah Dikirim</label>
                        <input type="number" name="jumlah" min="1" required
                               value="{{ old('jumlah') }}"
                               class="w-full border rounded p-3"
                               placeholder="Masukkan jumlah logistik">
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block mb-2 font-medium">Tanggal Distribusi</label>
                        <input type="date" name="tanggal" required
                               value="{{ old('tanggal') }}"
                               class="w-full border rounded p-3">
                    </div>

                    {{-- Penerima --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Penerima Bantuan</label>
                        <input type="text" name="penerima" required
                               value="{{ old('penerima') }}"
                               class="w-full border rounded p-3"
                               placeholder="Masukkan nama penerima bantuan">
                    </div>

                    {{-- Media --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Upload Foto (opsional)</label>

                        <div class="mb-4 media-card w-40 h-40 rounded border overflow-hidden">
                            <img id="preview-foto"
                                 src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                 alt="Preview Foto Distribusi"
                                 class="w-full h-full object-cover">
                        </div>

                        <input type="file"
                               name="media"
                               accept="image/*"
                               class="w-full mt-1"
                               onchange="document.getElementById('preview-foto').src = window.URL.createObjectURL(this.files[0])">
                    </div>

                </div>

                <div class="flex justify-end mt-8 space-x-4 px-6 pb-6">
                    <a href="{{ route('admin.distribusi_logistik.index') }}"
                       class="px-6 py-3 font-bold text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-6 py-3 font-bold text-white uppercase rounded-lg
                               bg-gradient-to-tl from-gray-900 to-slate-800
                               hover:scale-102 shadow-soft-md transition">
                        Simpan Distribusi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
