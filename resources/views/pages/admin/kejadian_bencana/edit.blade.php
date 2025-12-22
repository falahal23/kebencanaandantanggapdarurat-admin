@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

@extends('layouts.admin.app')

@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8 py-8">

        <!-- Card Utama -->
        <div class="bg-white shadow-xl rounded-2xl ring-1 ring-gray-100">

            <!-- Header -->
            <h1
                class="text-4xl font-semibold text-blue-700 mb-6
           border-b-4 border-blue-300 pb-2
           drop-shadow-sm">
                Edit Kejadian Bencana
            </h1>

            <!-- Body -->
            <div class="p-6">

                {{-- Error --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM -->
                <form action="{{ route('kejadian.update', $kejadian->kejadian_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Jenis -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Jenis Bencana</label>
                            <input type="text" name="jenis_bencana"
                                class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                                value="{{ old('jenis_bencana', $kejadian->jenis_bencana) }}" required>
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Tanggal Kejadian</label>
                            <input type="date" name="tanggal"
                                class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                                value="{{ old('tanggal', $kejadian->tanggal) }}" required>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Lokasi</label>
                            <input type="text" name="lokasi_text" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('lokasi_text', $kejadian->lokasi_text) }}">
                        </div>

                        <!-- Dampak -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Dampak</label>
                            <input type="text" name="dampak" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('dampak', $kejadian->dampak) }}" required>
                        </div>

                        <!-- RT -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">RT</label>
                            <input type="number" name="rt" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('rt', $kejadian->rt) }}">
                        </div>

                        <!-- RW -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">RW</label>
                            <input type="number" name="rw" class="w-full px-3 py-2 border rounded-lg"
                                value="{{ old('rw', $kejadian->rw) }}">
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold mb-1">Status Kejadian</label>
                            <select name="status_kejadian" class="w-full px-3 py-2 border rounded-lg" required>
                                <option value="Aktif" {{ $kejadian->status_kejadian == 'Aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="Sedang Ditangani"
                                    {{ $kejadian->status_kejadian == 'Sedang Ditangani' ? 'selected' : '' }}>
                                    Sedang Ditangani
                                </option>
                                <option value="Selesai" {{ $kejadian->status_kejadian == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>


                        {{-- PREVIEW --}}
                          <div class="col-span-2">
                                <label class="block mb-2 font-medium">Upload Foto jika ada (opsional)</label>
                                <div class="mb-4 media-card w-40 h-40 rounded border overflow-hidden">
                                    <img id="preview-foto" src="{{ asset('assets-admin/img/spaceholder.png') }}"
                                         alt="Placeholder Foto Posko"
                                         class="w-full h-full object-cover">
                                </div>
                                <input type="file" name="media" class="w-full mt-1" accept="image/*"
                                       onchange="document.getElementById('preview-foto').src = window.URL.createObjectURL(this.files[0])">
                            </div>



                        <!-- Keterangan -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-1">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="w-full px-3 py-2 border rounded-lg">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol Aksi (KE SAMPING) -->
                    <div class="mt-12 flex items-center justify-between">
                        <!-- KIRI -->
                        <a href="{{ route('kejadian.index') }}"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                            ← Batal
                        </a>

                        <!-- KANAN -->
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
    </div>
@endsection
