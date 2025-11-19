@extends('layouts.admin.app')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Detail Posko Bencana</h1>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
            <div class="md:flex">
                <!-- FOTO POSKO -->
                <div class="md:w-1/3 bg-gray-50 flex items-center justify-center p-6">
                    @php $media = $posko->media->first(); @endphp
                    @if ($media)
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-xl">
                            <span class="text-gray-400 text-sm">Tidak ada foto</span>
                        </div>
                    @endif
                </div>

                <!-- DETAIL POSKO -->
                <div class="md:w-2/3 p-6 flex flex-col justify-between">
                    <div class="grid grid-cols-1 gap-4 text-gray-700">
                        <div><span class="font-semibold">ID Posko:</span> {{ $posko->posko_id }}</div>
                        <div><span class="font-semibold">ID Kejadian:</span> {{ $posko->kejadian_id }}</div>
                        <div><span class="font-semibold">Nama Posko:</span> {{ $posko->nama }}</div>
                        <div><span class="font-semibold">Alamat:</span> {{ $posko->alamat }}</div>
                        <div><span class="font-semibold">Kontak:</span> {{ $posko->kontak ?? '-' }}</div>
                        <div><span class="font-semibold">Penanggung Jawab:</span> {{ $posko->penanggung_jawab ?? '-' }}
                        </div>
                        @if ($posko->media->first())
                            <img src="{{ asset('storage/' . $posko->media->first()->file_url) }}" alt="Foto Posko"
                                class="w-32 h-32 object-cover">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    </div>

                    <!-- TOMBOL KEMBALI -->
                    <div class="mt-6">
                        <a href="{{ route('admin.posko.index') }}"
                            class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow hover:bg-blue-700 transition duration-300">
                            ← Kembali ke Daftar Posko
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
