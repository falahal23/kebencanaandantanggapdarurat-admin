@extends('layouts.admin.app')

@section('content')

    <div class="w-full py-6">

        {{-- HEADER SECTION --}}
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Detail Kejadian Bencana</h1>
                    <p class="text-sm opacity-90 mt-1">
                        Informasi lengkap mengenai kejadian
                        <span class="font-semibold">{{ $kejadian->jenis_bencana }}</span>
                    </p>
                </div>

                <a href="{{ route('kejadian.index') }}"
                    class="px-4 py-2 bg-white text-indigo-600 font-semibold rounded-lg shadow hover:bg-gray-100">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT SIDE: DETAIL INFO --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- CARD: INFORMASI UMUM --}}
                <div class="bg-white rounded-xl shadow-xl border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 pb-3 border-b">Informasi Umum</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-3 text-sm">

                        <div>
                            <p class="text-gray-500">ID Kejadian</p>
                            <p class="text-gray-900 font-bold">{{ $kejadian->kejadian_id }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Jenis Bencana</p>
                            <p class="text-red-600 font-bold">{{ $kejadian->jenis_bencana }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Tanggal</p>
                            <p class="font-medium">
                                {{ \Carbon\Carbon::parse($kejadian->tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Status Kejadian</p>

                            <span
                                class="
                            inline-flex px-3 py-1 rounded-full text-xs font-semibold mt-1
                            @if ($kejadian->status_kejadian == 'Aktif') bg-red-100 text-red-700
                            @elseif($kejadian->status_kejadian == 'Sedang Ditangani')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-green-100 text-green-700 @endif
                        ">
                                {{ $kejadian->status_kejadian }}
                            </span>
                        </div>

                        <div class="col-span-2">
                            <p class="text-gray-500">Dampak Awal</p>
                            <p class="font-medium italic">
                                {{ $kejadian->dampak ?? 'Belum ada data dampak.' }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- CARD: DETAIL LOKASI --}}
                <div class="bg-white rounded-xl shadow-xl border-l-4 border-indigo-500 p-6">
                    <h2 class="text-lg font-semibold text-indigo-600 pb-3 border-b">Detail Lokasi & Keterangan</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-3 text-sm">

                        <div>
                            <p class="text-gray-500">Lokasi</p>
                            <p class="font-medium">{{ $kejadian->lokasi_text ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">RT / RW</p>
                            <p class="font-medium">
                                {{ ($kejadian->rt ?? '-') . ' / ' . ($kejadian->rw ?? '-') }}
                            </p>
                        </div>

                        <div class="col-span-2 mt-3 p-4 bg-gray-50 shadow-inner rounded-lg">
                            <p class="font-semibold text-gray-700 mb-1">Keterangan:</p>
                            <p class="text-gray-800 leading-relaxed">
                                {!! nl2br(e($kejadian->keterangan ?? 'Tidak ada keterangan rinci.')) !!}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- BUTTON ACTION --}}
                <div class="flex justify-end gap-3 mt-4">
                    <a href="{{ route('kejadian.edit', $kejadian->kejadian_id) }}"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                        ✏️ Edit
                    </a>

                    <form action="{{ route('kejadian.destroy', $kejadian->kejadian_id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin hapus kejadian ini?')"
                            class="px-5 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700">
                            🗑 Hapus
                        </button>
                    </form>
                </div>

            </div>

            {{-- RIGHT SIDE: MEDIA --}}
            <div class="space-y-4">

                <div class="bg-white rounded-xl shadow-xl border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 pb-3 border-b">Dokumentasi Media</h2>

                    @php $media = $kejadian->media->first(); @endphp
            {{-- spacwholder --}}
                    <div class="media-card">
                        @if ($media)
                            @php
                                $url = str_contains($media->file_url, 'http')
                                    ? $media->file_url
                                    : asset('storage/' . $media->file_url);
                            @endphp

                            @if (Str::startsWith($media->mime_type, 'image/'))
                                <img src="{{ $url }}" alt="Media Kejadian"
                                    onerror="this.onerror=null; this.src='{{ asset('assets-admin/img/spaceholder.png') }}';">
                            @elseif (Str::startsWith($media->mime_type, 'video/'))
                                <video controls>
                                    <source src="{{ $url }}" type="{{ $media->mime_type }}">
                                </video>
                            @else
                                <img src="{{ asset('assets-admin/img/spaceholder.png') }}" alt="Placeholder Media">
                            @endif
                        @else
                            <img src="{{ asset('assets-admin/img/spaceholder.png') }}" alt="Placeholder Media">
                        @endif
                    </div>


                    <p class="text-center text-sm text-gray-500 italic">
                        {{ $media->caption ?? 'Tanpa keterangan.' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

@endsection
