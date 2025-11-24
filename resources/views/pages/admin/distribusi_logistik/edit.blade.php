@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="bg-white rounded-2xl shadow-soft-xl p-6">

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h6 class="text-lg font-semibold">🖊️Edit Distribusi Logistik</h6>
                        <p class="text-sm text-slate-500">Perbarui data distribusi logistik</p>
                    </div>
                    <a href="{{ route('admin.distribusi_logistik.index') }}"
                        class="px-4 py-2 bg-gradient-to-r from-gray-700 to-gray-900 text-white rounded-lg shadow hover:scale-105 transition">
                        Kembali
                    </a>
                </div>

                <form action="{{ route('admin.distribusi_logistik.update', $distribusi->distribusi_id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Logistik --}}
                        <div>
                            <label class="block mb-2 font-medium">Pilih Logistik</label>
                            <select name="logistik_id" required class="w-full border rounded p-3">
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
                            <select name="posko_id" required class="w-full border rounded p-3">
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
                                class="w-full border rounded p-3">
                        </div>

                        {{-- Jumlah --}}
                        <div>
                            <label class="block mb-2 font-medium">Jumlah</label>
                            <input type="number" name="jumlah" required value="{{ $distribusi->jumlah }}"
                                class="w-full border rounded p-3">
                        </div>

                        {{-- Penerima --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">Nama Penerima</label>
                            <input type="text" name="penerima" required value="{{ $distribusi->penerima }}"
                                class="w-full border rounded p-3">
                        </div>

                        {{-- Bukti --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">Upload Bukti (Opsional)</label>

                            @if ($distribusi->media)
                                <div class="mb-3">
                                    <span class="text-sm text-slate-600">Bukti Lama:</span><br>
                                    <img src="{{ $distribusi->media->file_url }}"
                                        class="w-40 h-auto rounded-lg shadow border">
                                </div>
                            @endif

                            <input type="file" name="bukti" accept="image/*"
                                class="w-full border rounded p-3 bg-gray-50">
                        </div>

                    </div>

                    <div class="flex justify-end mt-8 space-x-3">
                        <a href="{{ route('admin.distribusi_logistik.index') }}"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg shadow hover:shadow-xl hover:scale-105 transition">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
