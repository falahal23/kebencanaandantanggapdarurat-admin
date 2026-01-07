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
                    {{-- BUKTI / DOKUMENTASI DISTRIBUSI --}}
                    <div class="mt-10">

                        <h3 class="text-base font-semibold text-slate-700 mb-3">
                            Dokumentasi / Bukti Distribusi
                        </h3>

                        @php
                            $media = $distribusi->media->first();
                        @endphp

                        <div class="flex items-start gap-6 flex-wrap">

                            {{-- PREVIEW --}}
                            <div class="w-44 h-44 rounded-xl border bg-slate-50 overflow-hidden shadow-sm">
                                @if ($media)
                                    {{-- GAMBAR --}}
                                    @if (in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']))
                                        <img id="preview-media" src="{{ asset('storage/' . $media->file_url) }}"
                                            alt="Bukti Distribusi Logistik" class="w-full h-full object-cover"
                                            onerror="this.onerror=null;this.src='{{ asset('assets-admin/img/spaceholder.png') }}';">

                                        {{-- PDF --}}
                                    @elseif ($media->mime_type === 'application/pdf')
                                        <div
                                            class="w-full h-full flex flex-col items-center justify-center text-center px-3">
                                            <span class="text-gray-600 text-sm mb-2">📄 File PDF</span>
                                            <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                                class="px-3 py-1.5 text-xs font-semibold bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                                Lihat / Download
                                            </a>
                                        </div>

                                        {{-- FILE LAIN --}}
                                    @else
                                        <div
                                            class="w-full h-full flex flex-col items-center justify-center text-center px-3">
                                            <span class="text-gray-500 text-sm mb-2">
                                                Format tidak didukung
                                            </span>
                                            <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank"
                                                class="text-blue-600 underline text-sm">
                                                Download File
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    {{-- PLACEHOLDER --}}
                                    <img id="preview-media" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                        alt="Placeholder Bukti Distribusi" class="w-full h-full object-cover">
                                @endif
                            </div>

                            {{-- UPLOAD --}}
                            <div class="flex-1 min-w-[220px]">
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Ganti Bukti Distribusi (opsional)
                                </label>

                                <input type="file" name="media" accept="image/*"
                                    class="w-full text-sm border border-slate-300 rounded-lg p-2.5
                       focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                                    onchange="document.getElementById('preview-media').src = window.URL.createObjectURL(this.files[0])">

                                @if ($media)
                                    <p class="text-xs text-slate-500 mt-2">
                                        File saat ini:
                                        <span class="font-semibold">{{ basename($media->file_url) }}</span>
                                    </p>
                                @endif
                            </div>

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
