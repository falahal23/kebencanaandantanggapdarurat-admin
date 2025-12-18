@extends('layouts.admin.app')

@section('title', 'Daftar Donasi Bencana')

@section('content')
    <div class="container mx-auto px-4 py-6">


        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Daftar Donasi Bencana</h1>
            <a href="{{ route('admin.donasi.create') }}"
                class="inline-block px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-semibold shadow hover:shadow-lg transition">
                <i class="fa fa-plus mr-1"></i> Tambah Donasi
            </a>
        </div>
        <form method="GET" class="mb-4 flex gap-3">

            {{-- Search --}}
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari donatur / jenis donasi..."
                class="px-3 py-2 border rounded-lg w-60">

            {{-- Filter Kejadian --}}
            <select name="kejadian_id" class="px-3 py-2 border rounded-lg">
                <option value="">-- Semua Kejadian --</option>
                @foreach ($kejadianList as $k)
                    <option value="{{ $k->kejadian_id }}" {{ request('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                        {{ $k->jenis_bencana }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold">
                🔍
            </button>

            {{-- Reset --}}
            @if (request()->has('search') && request('search') != '')
                <a href="{{ route('user.index') }}"
                    class="px-4 py-2 bg-gray-300 text-black rounded-lg shadow hover:bg-gray-400 transition text-sm flex items-center justify-center">
                    ⟲
                </a>
            @endif
        </form>


        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabel Donasi --}}
        <div class="bg-white shadow rounded-lg p-8 overflow-x-auto w-full">
            <table class="min-w-full min-w-[1100px] text-sm text-left text-gray-600 border-collapse">


                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 whitespace-nowrap">ID</th>
                        <th class="px-4 py-2 whitespace-nowrap">Donatur</th>
                        <th class="px-4 py-2 whitespace-nowrap">Jenis</th>
                        <th class="px-4 py-2 whitespace-nowrap">Nilai</th>
                        <th class="px-4 py-2 whitespace-nowrap">Kejadian</th>
                        <th class="px-4 py-2 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($donasi as $d)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $d->donasi_id }}</td>
                            <td class="px-4 py-2">{{ $d->donatur_nama }}</td>
                            <td class="px-4 py-2">{{ $d->jenis }}</td>
                            <td class="px-4 py-2">{{ number_format($d->nilai, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if ($d->kejadian)
                                    {{ $d->kejadian->jenis_bencana }} |
                                    {{ $d->kejadian->lokasi_text }} |
                                    {{ \Carbon\Carbon::parse($d->kejadian->tanggal)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-row justify-center items-center gap-1.5">

                                    {{-- Tombol Lihat Detail (Warna Netral/Gray) --}}
                                    <a href="{{ route('admin.donasi.show', $d->donasi_id) }}"
                                        class="px-2 py-1 text-xs text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition font-semibold shadow-md whitespace-nowrap">
                                        🔍 Detail
                                    </a>

                                    {{-- Tombol Edit (Warna Primer/Indigo) --}}
                                    <a href="{{ route('admin.donasi.edit', $d->donasi_id) }}"
                                        class="px-2 py-1 text-xs text-black bg-indigo-500 hover:bg-blue-600 rounded-lg font-semibold shadow-md transition whitespace-nowrap">
                                        ✏️ Edit
                                    </a>

                                    {{-- Tombol Hapus (Warna Bahaya/Red) --}}
                                    <form action="{{ route('admin.donasi.destroy', $d->donasi_id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus donasi ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 text-xs text-black bg-red-600 hover:bg-red-700 rounded-lg font-semibold shadow-md transition whitespace-nowrap">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data donasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


            <div class="mt-6" style="display: flex; justify-content: center; align-items: center; gap: 6px;">

                <!-- Pagination -->
                <div class="w-full flex justify-center items-center gap-2 py-8 flex-wrap">

                    {{-- Previous --}}
                    @if ($donasi->onFirstPage())
                        <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                            style="background:#C40BB2">
                            ‹ Prev
                        </span>
                    @else
                        <a href="{{ $donasi->previousPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                            style="background:#C40BB2">
                            ‹ Prev
                        </a>
                    @endif

                    {{-- Pagination Logic --}}
                    @php
                        $start = max($donasi->currentPage() - 2, 1);
                        $end = min($donasi->currentPage() + 2, $donasi->lastPage());
                    @endphp

                    {{-- First Page --}}
                    @if ($start > 1)
                        <a href="{{ $donasi->url(1) }}" class="px-4 py-2 rounded-lg font-bold"
                            style="background:#e0e0e0">1</a>
                        <span class="px-2">...</span>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($donasi->getUrlRange($start, $end) as $page => $url)
                        @if ($page == $donasi->currentPage())
                            <span class="px-4 py-2 rounded-lg font-bold text-white" style="background:#333">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg font-bold"
                                style="background:#e0e0e0">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Last Page --}}
                    @if ($end < $donasi->lastPage())
                        <span class="px-2">...</span>
                        <a href="{{ $donasi->url($donasi->lastPage()) }}" class="px-4 py-2 rounded-lg font-bold"
                            style="background:#e0e0e0">
                            {{ $donasi->lastPage() }}
                        </a>
                    @endif

                    {{-- Next --}}
                    @if ($donasi->hasMorePages())
                        <a href="{{ $donasi->nextPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                            style="background:#669be6">
                            Next ›
                        </a>
                    @else
                        <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                            style="background:#669be6">
                            Next ›
                        </span>
                    @endif

                </div>
            </div>
        @endsection
