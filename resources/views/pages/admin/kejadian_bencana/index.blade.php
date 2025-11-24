@extends('layouts.admin.app')

@section('title', 'Daftar Kejadian Bencana')

@section('content')
    {{-- Menggunakan container modern dengan padding --}}
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">


        {{-- Notifikasi (Jika ada) --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm">
                <p class="font-medium"><i class="fa fa-check-circle mr-2"></i> {{ session('success') }}</p>
            </div>
        @endif

        {{-- Card Utama Kejadian Bencana --}}
        <div class="bg-white shadow-xl rounded-xl ring-1 ring-gray-100">

            {{-- Header Card --}}
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">

                    {{-- Judul dan Deskripsi --}}
                    <div class="mb-4 sm:mb-0">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Kejadian Bencana
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fa fa-check text-green-500"></i>
                            Data Kejadian Bencana di Indonesia <span
                                class="ml-1 font-semibold text-blue-600">TERBARU!</span>
                        </p>
                    </div>

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('kejadian.create') }}"
                        class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                        <i class="fa fa-plus mr-2"></i> ✚ Tambah Kejadian
                    </a>
                </div>
                <form method="GET" class="mb-6 bg-white p-4 rounded-lg shadow flex flex-wrap gap-4">

                    <!-- Search -->
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full p-2 border rounded-lg" placeholder="Cari lokasi, jenis, keterangan...">
                    </div>

                    <!-- Jenis Bencana -->
                    <div>
                        <select name="jenis_bencana" class="p-2 border rounded-lg">
                            <option value="">Semua Jenis</option>
                            <option value="Banjir" {{ request('jenis_bencana') == 'Banjir' ? 'selected' : '' }}>Banjir
                            </option>
                            <option value="Kebakaran" {{ request('jenis_bencana') == 'Kebakaran' ? 'selected' : '' }}>
                                Kebakaran
                            </option>
                            <option value="Longsor" {{ request('jenis_bencana') == 'Longsor' ? 'selected' : '' }}>Longsor
                            </option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <select name="status_kejadian" class="p-2 border rounded-lg">
                            <option value="">Semua Status</option>
                            <option value="Aktif" {{ request('status_kejadian') == 'Aktif' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="Sedang Ditangani"
                                {{ request('status_kejadian') == 'Sedang Ditangani' ? 'selected' : '' }}>Sedang Ditangani
                            </option>
                            <option value="Selesai" {{ request('status_kejadian') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>

                    <!-- Filter Tanggal Mulai -->
                    <form action="{{ route('kejadian.index') }}" method="GET"
                        class="flex flex-wrap items-center gap-2 mb-4">

                        <!-- Filter Tanggal Mulai -->
                        <div>
                            <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                                class="p-2 border rounded-lg">
                        </div>

                        <!-- Filter Tanggal Akhir -->
                        <div>
                            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                                class="p-2 border rounded-lg">
                        </div>

                        <!-- Tombol Search / Filter -->
                        <div>
                            <button type="submit"
                                class="w-12 h-12 flex items-center justify-center text-xl font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-150">
                                🔍
                            </button>
                        </div>

                        <!-- Tombol Reset (hanya muncul jika ada input filter) -->
                        @if (request()->has('search') && request('search') != '')
                            <a href="{{ route('user.index') }}"
                                class="w-12 h-12 flex items-center justify-center text-xl font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition duration-150">
                                ⟲
                            </a>
                        @endif

                    </form>
            </div>

            {{-- Body Card (Tabel) --}}
            <div class="p-4 sm:p-6">
                <div class="overflow-x-auto shadow-inner rounded-lg">
                    <table class="min-w-full text-sm text-left text-gray-700 border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 font-semibold text-gray-700 uppercase tracking-wider w-[180px]">Jenis
                                    Bencana</th>
                                <th class="px-4 py-3 font-semibold text-gray-700 uppercase tracking-wider w-[120px]">Tanggal
                                </th>
                                <th class="px-4 py-3 font-semibold text-gray-700 uppercase tracking-wider min-w-[250px]">
                                    Lokasi</th>
                                <th
                                    class="px-4 py-3 font-semibold text-gray-700 uppercase tracking-wider text-center w-[100px]">
                                    Dampak</th>
                                <th
                                    class="px-4 py-3 font-semibold text-gray-700 uppercase tracking-wider text-center w-[120px]">
                                    Status</th>
                                <th class="px-4 py-3 font-semibold text-gray-700 uppercase tracking-wider w-[200px]">
                                    Keterangan</th>
                                <th
                                    class="px-4 py-3 font-semibold text-gray-700 uppercase tracking-wider text-center w-[150px]">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                            @forelse ($kejadian as $item)
                                <tr class="hover:bg-blue-50/20 transition duration-150">
                                    {{-- Jenis Bencana --}}
                                    <td class="p-4 align-top text-gray-900 font-medium">{{ $item->jenis_bencana }}</td>

                                    {{-- Tanggal --}}
                                    <td class="p-4 align-top text-gray-600 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </td>

                                    {{-- Lokasi --}}
                                    <td class="p-4 align-top text-gray-700">
                                        <p class="font-semibold truncate max-w-xs" title="{{ $item->lokasi_text }}">
                                            {{ $item->lokasi_text }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            (RT {{ $item->rt }}/RW {{ $item->rw }})
                                        </p>
                                    </td>

                                    {{-- Dampak --}}
                                    <td class="p-4 align-top text-center text-gray-700">
                                        <span class="font-semibold text-xs">{{ $item->dampak }}</span>
                                    </td>

                                    {{-- Status --}}
                                    <td class="p-4 align-top text-center">
                                        @php
                                            // hapus newline, tab, dan space berlebih
                                            $status = preg_replace('/\s+/', ' ', trim($item->status_kejadian));

                                            switch ($status) {
                                                case 'Aktif':
                                                    $badgeClass = 'bg-red-100 text-red-700';
                                                    break;

                                                case 'Selesai':
                                                    $badgeClass = 'bg-gray-100 text-gray-700';
                                                    break;

                                                case 'Sedang Ditangani':
                                                    $badgeClass = 'bg-purple-100 text-purple-700';
                                                    break;

                                                default:
                                                    $badgeClass = 'bg-gray-100 text-gray-700';
                                                    break;
                                            }
                                        @endphp

                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $badgeClass }}">
                                            {{ $status }}
                                        </span>
                                    </td>



                                    {{-- Keterangan --}}
                                    <td class="p-4 align-top text-xs text-gray-600 max-w-xs">
                                        <p class="line-clamp-3" title="{{ $item->keterangan ?? 'Tidak ada keterangan.' }}">
                                            {{ $item->keterangan ?? '-' }}
                                        </p>
                                    </td>

                                    {{-- Tombol Aksi --}}
                                    <td class="p-4 align-top text-center whitespace-nowrap">
                                        <div class="flex flex-col space-y-2 items-center">

                                            <!-- Tombol Lihat Detail -->
                                            {{-- Menggunakan route() asli Anda --}}
                                            <a href="{{ route('kejadian.show', $item->kejadian_id) }}"
                                                class="px-3 py-1.5 w-full font-semibold text-xs text-center text-white bg-gray-600 rounded-md hover:bg-gray-700 transition duration-150 shadow-sm hover:shadow-md">
                                                👁️ Lihat Detail
                                            </a>

                                            <!-- Tombol Edit -->
                                            {{-- Menggunakan route() asli Anda --}}
                                            <a href="{{ route('kejadian.edit', $item->kejadian_id) }}"
                                                class="px-3 py-1.5 w-full font-semibold text-black bg-blue-100"> ✏️ Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            {{-- Menggunakan route() asli Anda --}}
                                            <form action="{{ route('kejadian.destroy', $item->kejadian_id) }}"
                                                method="POST" class="w-full"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1.5 w-full font-semibold text-black bg-blue-100">
                                                    🗑️ Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-12 text-center text-gray-400 italic bg-gray-50">
                                        <i class="fa fa-exclamation-triangle fa-2x mb-3"></i><br>
                                        Tidak ada data kejadian bencana yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ASUMSI: Pagination diletakkan di sini jika ada --}}
               <div class="mt-6 flex justify-center">
                        {{ $kejadian->links() }}
                    </div>
            </div>
        </div>
    </div>
@endsection
