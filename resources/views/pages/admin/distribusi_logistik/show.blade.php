@extends('layouts.admin.app')

@section('title', 'Detail Distribusi Logistik')

@section('content')
    <div class="max-w-5xl mx-auto mt-8">

        {{-- CARD WRAPPER --}}
        <div class="bg-white shadow-soft-xl rounded-2xl p-8 border border-gray-100">

            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Detail Distribusi Logistik
                </h2>
                <a href="{{ route('admin.distribusi_logistik.index') }}"
                    class="px-4 py-2 text-sm rounded-lg bg-gradient-to-r from-gray-900 to-slate-700 text-white shadow hover:shadow-lg transition">
                    Kembali
                </a>
            </div>

            {{-- GRID INFORMASI UTAMA --}}
            <div class="grid grid-cols-2 gap-6">

                {{-- NAMA LOGISTIK --}}
                <div class="p-5 bg-gradient-to-br from-white to-gray-50 rounded-xl shadow border border-gray-100">
                    <h4 class="text-xs font-semibold text-gray-500">Nama Logistik</h4>
                    <p class="mt-1 text-lg font-bold text-gray-800">
                        {{ $distribusi->logistik->nama_logistik ?? ($distribusi->logistik->nama_barang ?? '-') }}
                    </p>
                </div>

                {{-- POSKO --}}
                <div class="p-5 bg-gradient-to-br from-white to-gray-50 rounded-xl shadow border border-gray-100">
                    <h4 class="text-xs font-semibold text-gray-500">Posko Tujuan</h4>
                    <p class="mt-1 text-lg font-bold text-gray-800">
                        {{ $distribusi->posko->nama_posko ?? ($distribusi->posko->nama ?? '-') }}
                    </p>
                </div>

                {{-- TANGGAL --}}
                <div class="p-5 bg-gradient-to-br from-white to-gray-50 rounded-xl shadow border border-gray-100">
                    <h4 class="text-xs font-semibold text-gray-500">Tanggal Distribusi</h4>
                    <p class="mt-1 text-lg font-bold text-gray-800">
                        {{ \Carbon\Carbon::parse($distribusi->tanggal)->format('d M Y') }}
                    </p>
                </div>

                {{-- PENERIMA --}}
                <div class="p-5 bg-gradient-to-br from-white to-gray-50 rounded-xl shadow border border-gray-100">
                    <h4 class="text-xs font-semibold text-gray-500">Penerima</h4>
                    <p class="mt-1 text-lg font-bold text-gray-800">
                        {{ $distribusi->penerima }}
                    </p>
                </div>

                {{-- JUMLAH --}}
                <div class="p-5 bg-gradient-to-br from-white to-gray-50 rounded-xl shadow border border-gray-100">
                    <h4 class="text-xs font-semibold text-gray-500">Jumlah</h4>
                    <p class="mt-1 text-lg font-bold text-gray-800">
                        {{ $distribusi->jumlah }} item
                    </p>
                </div>

            </div>

            {{-- BUKTI FOTO --}}
            <div class="md:col-span-2 mt-2">
                <strong>Media Bukti Distribusi:</strong>
                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">

                    @php
                        $placeholderImage = asset('assets-admin/img/spaceholder.png');
                        $placeholderVideo = asset('assets-admin/img/spaceholder-video.png');
                    @endphp

                    @if ($distribusi->media)
                        @php
                            $url = asset($distribusi->media->file_url);
                            $ext = strtolower(pathinfo($distribusi->media->file_url, PATHINFO_EXTENSION));
                        @endphp

                        {{-- Jika media adalah gambar --}}
                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ $url }}" onerror="this.onerror=null; this.src='{{ $placeholderImage }}';"
                                alt="Bukti Distribusi" class="rounded-lg shadow"
                                style="width:120px; height:150px; object-fit:cover;">

                            {{-- Jika media adalah video --}}
                        @elseif (in_array($ext, ['mp4', 'mov', 'webm']))
                            <video controls class="rounded-lg shadow" style="width:120px; height:150px; object-fit:cover;">
                                <source src="{{ $url }}">
                                Video tidak dapat diputar.
                            </video>
                        @else
                            <p>Media {{ $distribusi->media->file_url }} tidak dapat ditampilkan.</p>
                        @endif
                    @else
                        {{-- TIDAK ADA MEDIA --}}
                        <img src="{{ $placeholderImage }}" class="rounded-lg shadow border mx-auto" alt="Tidak ada media"
                            style="width:120px; height:150px; object-fit:cover;">
                    @endif

                </div>
            </div>

        </div>

    </div>

    </div>
@endsection
