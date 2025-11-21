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
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out transform hover:scale-105">
                        <i class="fa fa-plus mr-2"></i> Tambah Kejadian
                    </a>
                </div>
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
                                            $status = $item->status_kejadian;
                                            $badgeClass = '';
                                            if ($status == 'Selesai') {
                                                $badgeClass = 'bg-green-100 text-green-700';
                                            } elseif ($status == 'Sedang Ditangani') {
                                                $badgeClass = 'bg-yellow-100 text-yellow-700';
                                            } else {
                                                $badgeClass = 'bg-red-100 text-red-700';
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
