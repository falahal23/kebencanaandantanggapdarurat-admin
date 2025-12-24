@extends('layouts.admin.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <!-- HEADER -->
    <div class="mb-6 rounded-xl p-6 text-white bg-gradient-to-r from-indigo-600 to-blue-500 shadow-lg">
        <h1 class="text-2xl font-bold text-white">Detail Kejadian Bencana</h1>
        <p class="text-sm opacity-90">
            Informasi lengkap mengenai kejadian
            <span class="font-semibold">{{ $kejadian->jenis_bencana ?? '-' }}</span>
        </p>
    </div>

    @php
        $media = $kejadian->media->first();
        $allMedia = $kejadian->media;

        $isImage = $media && Str::startsWith($media->mime_type, 'image/');
        $isVideo = $media && Str::startsWith($media->mime_type, 'video/');
    @endphp

    <!-- GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KIRI : INFORMASI KEJADIAN -->
        <div class="lg:col-span-2 bg-white shadow rounded-xl border p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Informasi Kejadian
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                <div>
                    <p class="text-gray-500">ID Kejadian</p>
                    <p class="font-semibold">{{ $kejadian->kejadian_id }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Jenis Bencana</p>
                    <p class="font-semibold text-red-600">{{ $kejadian->jenis_bencana }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal</p>
                    <p>{{ \Carbon\Carbon::parse($kejadian->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Status</p>
                    <span
                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold mt-1
                        @if ($kejadian->status_kejadian == 'Aktif') bg-red-100 text-red-700
                        @elseif($kejadian->status_kejadian == 'Sedang Ditangani') bg-yellow-100 text-yellow-700
                        @else bg-green-100 text-green-700 @endif">
                        {{ $kejadian->status_kejadian }}
                    </span>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500">Dampak Awal</p>
                    <p class="italic">{{ $kejadian->dampak ?? 'Belum ada data dampak.' }}</p>
                </div>

                <div class="md:col-span-2 mt-3 p-4 bg-gray-50 rounded-lg">
                    <p class="font-semibold mb-1">Keterangan:</p>
                    <p>{!! nl2br(e($kejadian->keterangan ?? 'Tidak ada keterangan.')) !!}</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('kejadian.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    ← Kembali
                </a>
            </div>
        </div>

        <!-- KANAN : MEDIA -->
        <div class="bg-white shadow rounded-xl border p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Dokumentasi Media
            </h2>

            @if ($kejadian->media->isNotEmpty())
                <div class="grid grid-cols-1 gap-3">
                    @foreach ($kejadian->media as $m)
                        @php
                            $isImage = Str::startsWith($m->mime_type, 'image/');
                            $isVideo = Str::startsWith($m->mime_type, 'video/');
                        @endphp

                        <div class="rounded-lg overflow-hidden border">
                            @if ($isImage)
                                <img src="{{ asset('storage/' . $m->file_url) }}" class="w-full h-48 object-cover rounded">
                            @elseif ($isVideo)
                                <video controls class="w-full h-48 object-cover rounded">
                                    <source src="{{ asset('storage/' . $m->file_url) }}" type="{{ $m->mime_type }}">
                                </video>
                            @else
                                <div class="p-4 text-sm text-gray-700">{{ basename($m->file_url) }}</div>
                            @endif
                        </div>

                        @if ($m->caption)
                            <p class="text-sm text-gray-500 italic mt-2">{{ $m->caption }}</p>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="h-64 flex items-center justify-center text-gray-400">
                    <img src="{{ asset('assets-admin/img/spaceholder.png') }}" alt="Placeholder Foto kejadian" class="media-image rounded border mb-2 w-32 h-32 object-cover">
                </div>
            @endif

        </div>

    </div>

</div>
@endsection
