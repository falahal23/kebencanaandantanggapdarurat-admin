@extends('layouts.admin.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-gray-700">Detail Posko Bencana</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- FOTO POSKO -->
            <div>
                <strong>Foto Posko:</strong>
                @php
                    $media = $posko->media;
                @endphp
                @if ($media)
                    <img src="{{ $media->file_url }}" class="w-full h-64 object-cover rounded-lg shadow-md mt-2">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg mt-2">
                        <span class="text-gray-400">Tidak ada foto</span>
                    </div>
                @endif
            </div>

            <!-- DETAIL POSKO -->
            <div class="flex flex-col gap-2">
                <div><strong>Nama Posko:</strong> {{ $posko->nama }}</div>
                <div><strong>Alamat:</strong> {{ $posko->alamat }}</div>
                <div><strong>Kontak:</strong> {{ $posko->kontak ?? '-' }}</div>
                <div><strong>Penanggung Jawab:</strong> {{ $posko->penanggung_jawab ?? '-' }}</div>
                <div><strong>Kejadian:</strong> {{ $posko->kejadian ? $posko->kejadian->nama : '-' }}</div>
            </div>

            <!-- INFORMASI TAMBAHAN KEJADIAN -->
            @if($posko->kejadian)
                <div class="md:col-span-2 mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <strong>Jenis Bencana:</strong>
                        <p>{{ $posko->kejadian->jenis_bencana }}</p>
                    </div>
                    <div>
                        <strong>Tanggal Kejadian:</strong>
                        <p>{{ $posko->kejadian->tanggal }}</p>
                    </div>
                    <div>
                        <strong>Lokasi:</strong>
                        <p>{{ $posko->kejadian->lokasi_text }}</p>
                    </div>
                    <div>
                        <strong>RT/RW:</strong>
                        <p>{{ $posko->kejadian->rt }} / {{ $posko->kejadian->rw }}</p>
                    </div>
                    <div>
                        <strong>Dampak:</strong>
                        <p>{{ $posko->kejadian->dampak }}</p>
                    </div>
                    <div>
                        <strong>Status Kejadian:</strong>
                        <p>{{ $posko->kejadian->status_kejadian }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <strong>Keterangan:</strong>
                        <p>{{ $posko->kejadian->keterangan ?? '-' }}</p>
                    </div>

                    <!-- MEDIA KEJADIAN -->
                    <div class="md:col-span-2 mt-2">
                        <strong>Media Kejadian:</strong>
                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if ($posko->kejadian->media->count() > 0)
                                @foreach ($posko->kejadian->media as $m)
                                    @php
                                        $url = asset('storage/' . $m->file_url);
                                        $ext = strtolower(pathinfo($m->file_url, PATHINFO_EXTENSION));
                                    @endphp

                                    @if (in_array($ext, ['jpg','jpeg','png']))
                                        <img src="{{ $url }}" alt="Media" class="w-full h-48 object-cover rounded-lg shadow">
                                    @elseif (in_array($ext, ['mp4','mov']))
                                        <video controls class="w-full h-48 rounded-lg">
                                            <source src="{{ $url }}">
                                        </video>
                                    @else
                                        <p>Media {{ $m->file_url }} tidak dapat ditampilkan.</p>
                                    @endif
                                @endforeach
                            @else
                                <p>Tidak ada media diunggah.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('admin.posko.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                ← Kembali ke Daftar Posko
            </a>
        </div>
    </div>
</div>
@endsection
