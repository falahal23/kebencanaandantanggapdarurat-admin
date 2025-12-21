@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">

        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative flex flex-col rounded-2xl bg-white">

                <h2 class="text-3xl font-bold mb-6 text-gray-700 border-b pb-3">
                    Tambah Distribusi Logistik
                </h2>

                <form action="{{ route('admin.distribusi_logistik.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

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
                            <input type="number" name="jumlah" required min="1" value="{{ old('jumlah') }}"
                                class="w-full border rounded p-3" placeholder="Masukkan jumlah logistik">
                        </div>

                        {{-- Tanggal --}}
                        <div>
                            <label class="block mb-2 font-medium">Tanggal Distribusi</label>
                            <input type="date" name="tanggal" required value="{{ old('tanggal') }}"
                                class="w-full border rounded p-3">
                        </div>

                        {{-- Penerima --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">Penerima Bantuan</label>
                            <input type="text" name="penerima" required value="{{ old('penerima') }}"
                                class="w-full border rounded p-3" placeholder="Masukkan nama penerima bantuan">
                        </div>


                        {{-- Keterangan --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">Keterangan</label>
                            <textarea name="keterangan" rows="4" class="w-full border rounded p-3" placeholder="Keterangan tambahan jika ada"></textarea>
                        </div>

                        {{-- Bukti --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">Upload Bukti Distribusi (Opsional)</label>

                            <div class="flex items-center space-x-4">
                                <img id="preview" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                    class="w-16 h-16 object-cover rounded-lg border shadow-sm">

                                <input type="file" name="bukti" accept="image/*" onchange="previewImage(event)"
                                    class="w-full border rounded p-3 bg-gray-50">
                            </div>
                        </div>


                    </div>

                    <div class="flex justify-end mt-8 space-x-4">
                        <a href="{{ route('admin.distribusi_logistik.index') }}"
                            class="px-6 py-3 font-bold text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition">
                            Kembali
                        </a>

                        <button type="submit"
                            class="px-6 py-3 font-bold text-center text-white uppercase rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-102 shadow-soft-md transition">
                            Simpan Distribusi
                        </button>
                    </div>

                </form>
            </div>
        @endsection
