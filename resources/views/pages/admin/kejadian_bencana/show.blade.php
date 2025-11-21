@extends('layouts.admin.app') {{-- Pastikan nama layout ini sesuai dengan yang Anda gunakan --}}

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">

                <!-- Header Card -->
                <div
                    class="border-black/12.5 mb-0 rounded-t-2xl border-b border-solid bg-white p-6 pb-3 flex justify-between items-center">
                    <h6 class="text-xl font-semibold text-gray-800">Detail Kejadian Bencana: <span
                            class="text-red-600">{{ $kejadian->jenis_bencana }}</span></h6>
                    <a href="{{ route('kejadian.index') }}"
                        class="px-4 py-2 text-sm font-bold rounded-lg bg-gray-700 text-Black hover:bg-gray-800 transition duration-200 shadow-md flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>

                <!-- Body Detail - Menggunakan Grid Layout -->
                <div class="flex-auto p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- Kolom Kiri (2/3): Detail Informasi -->
                        <div class="lg:col-span-2 space-y-6">

                            <!-- Card Info Umum -->
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                                <h5 class="text-lg font-bold mb-3 text-gray-700 border-b pb-2">Informasi Umum</h5>
                                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 text-sm">

                                    <div class="col-span-1">
                                        <dt class="font-medium text-gray-500">ID Kejadian:</dt>
                                        <dd class="text-gray-900 font-semibold">{{ $kejadian->kejadian_id }}</dd>
                                    </div>
                                    <div class="col-span-1">
                                        <dt class="font-medium text-gray-500">Jenis Bencana:</dt>
                                        <dd class="text-red-600 font-bold text-base">{{ $kejadian->jenis_bencana }}</dd>
                                    </div>
                                    <div class="col-span-1">
                                        <dt class="font-medium text-gray-500">Tanggal Kejadian:</dt>
                                        <dd class="text-gray-900">
                                            {{ \Carbon\Carbon::parse($kejadian->tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                                        </dd>
                                    </div>
                                    <div class="col-span-1">
                                        <dt class="font-medium text-gray-500">Status Kejadian:</dt>
                                        <dd class="mt-1">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase {{ $kejadian->status_kejadian == 'Aktif'
                                                    ? 'bg-red-100 text-red-700'
                                                    : ($kejadian->status_kejadian == 'Sedang Ditangani'
                                                        ? 'bg-yellow-100 text-yellow-700'
                                                        : 'bg-green-100 text-green-700') }}">
                                                {{ $kejadian->status_kejadian }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="col-span-2">
                                        <dt class="font-medium text-gray-500">Dampak Awal:</dt>
                                        <dd class="text-gray-900 italic">{{ $kejadian->dampak ?? 'Belum ada data dampak.' }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Card Lokasi & Keterangan -->
                            <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-blue-500">
                                <h5 class="text-lg font-bold mb-3 text-blue-600 border-b pb-2">Detail Lokasi & Keterangan
                                </h5>
                                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 text-sm">
                                    <div class="col-span-1">
                                        <dt class="font-medium text-gray-500">Lokasi Teks:</dt>
                                        <dd class="text-gray-900">{{ $kejadian->lokasi_text ?? '-' }}</dd>
                                    </div>
                                    <div class="col-span-1">
                                        <dt class="font-medium text-gray-500">RT / RW:</dt>
                                        <dd class="text-gray-900">
                                            {{ ($kejadian->rt ?? '-') . ' / ' . ($kejadian->rw ?? '-') }}</dd>
                                    </div>

                                    <div class="col-span-2 mt-3 p-3 bg-gray-50 rounded-lg border-l-2 border-gray-300">
                                        <dt class="font-medium text-gray-700 mb-1">Keterangan Detail:</dt>
                                        <dd class="text-gray-800 text-justify text-sm leading-relaxed">
                                            {!! nl2br(e($kejadian->keterangan ?? 'Tidak ada keterangan rinci yang dicatat.')) !!}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="mt-6 flex justify-end space-x-3">
                                <a href="{{ route('kejadian.edit', $kejadian->kejadian_id) }}"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-blue-600 to-cyan-400 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft">
                                    <i class="fas fa-edit mr-1"></i> Edit Data
                                </a>
                                <form action="{{ route('kejadian.destroy', $kejadian->kejadian_id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-red-600 to-pink-500 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data kejadian bencana ini? Tindakan ini tidak dapat dibatalkan.')">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus Data
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Kolom Kanan (1/3): Media Dokumentasi -->
                        <div class="lg:col-span-1">
                            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                                <h5 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">Dokumentasi Media</h5>

                                @php
                                    $media = $kejadian->media->first(); // Mengambil media pertama
                                @endphp

                                @if ($media)
                                    <div
                                        class="relative w-full aspect-video overflow-hidden rounded-lg shadow-md mb-3 bg-gray-100">
                                        @php
                                            // Asumsi file_url sudah di-setup dengan benar untuk akses publik storage
                                            $url = str_contains($media->file_url, 'http')
                                                ? $media->file_url
                                                : asset('storage/' . $media->file_url);
                                            $mime = $media->mime_type;
                                        @endphp

                                        @if (Str::startsWith($mime, 'image/'))
                                            <img src="{{ $url }}" alt="Foto Kejadian"
                                                class="w-full h-full object-cover">
                                        @elseif(Str::startsWith($mime, 'video/'))
                                            <video controls class="w-full h-full object-cover">
                                                <source src="{{ $url }}" type="{{ $mime }}">
                                                Browser Anda tidak mendukung tag video.
                                            </video>
                                        @elseif(Str::endsWith($mime, '/pdf'))
                                            <div class="flex flex-col items-center justify-center h-full p-4">
                                                <i class="fas fa-file-pdf fa-3x text-red-500 mb-2"></i>
                                                <p class="text-sm font-semibold text-gray-700">Dokumen PDF Terlampir</p>
                                                <a href="{{ $url }}" target="_blank"
                                                    class="mt-2 text-blue-600 hover:text-blue-800 text-xs font-medium">Lihat
                                                    Dokumen</a>
                                            </div>
                                        @else
                                            <div class="flex flex-col items-center justify-center h-full p-4">
                                                <i class="fas fa-file fa-3x text-gray-500 mb-2"></i>
                                                <p class="text-sm text-gray-700">Tipe Media Tidak Dikenali</p>
                                                <a href="{{ $url }}" target="_blank"
                                                    class="mt-2 text-blue-600 hover:text-blue-800 text-xs font-medium">Unduh
                                                    File</a>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-center text-xs text-gray-500 italic">
                                        {{ $media->caption ?? 'Tanpa Keterangan Media' }}</p>
                                @else
                                    <div class="text-center py-4 px-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <i class="fas fa-exclamation-circle text-yellow-500 mr-1"></i>
                                        <p class="text-sm text-yellow-800">Tidak ada media pendukung yang diunggah.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
