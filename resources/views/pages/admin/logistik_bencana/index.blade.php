@extends('layouts.admin.app')

@section('content')
    <div class="w-full px-6 py-6">

        <!-- Card Logistik Bencana -->
        <div class="w-full">
            <div class="shadow-soft-xl relative flex flex-col rounded-2xl bg-white">

                <!-- Header Card -->
                <div class="p-6 pb-0">
                    <div class="flex justify-between items-center flex-wrap gap-4">
                        <div>
                            <h6>Logistik Bencana</h6>
                            <p class="mb-0 text-sm leading-normal">
                                <i class="fa fa-check text-cyan-500"></i>
                                Semua data logistik terdaftar
                            </p>
                        </div>

                        <!-- Tombol Tambah -->
                        <a href="{{ route('admin.logistik_bencana.create') }}"
                            class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                            <i class="fa fa-plus mr-1"></i>Tambah Data Logistik
                        </a>
                    </div>

                    <!-- Filter -->
                    <form method="GET" class="flex flex-wrap gap-2 items-center mt-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama barang atau sumber" class="px-3 py-2 border rounded-lg text-sm">

                        <select name="kejadian_id" class="px-3 py-2 border rounded-lg text-sm">
                            <option value="">Semua Kejadian</option>
                            @foreach ($kejadians as $kejadian)
                                <option value="{{ $kejadian->id }}"
                                    {{ request('kejadian_id') == $kejadian->id ? 'selected' : '' }}>
                                    {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-black rounded-lg text-sm hover:bg-blue-500 transition">
                            🔍
                        </button>

                        @if (request()->has('search') && request('search') != '')
                            <a href="{{ route('logistik.index') }}"
                                class="w-10 h-10 flex items-center justify-center text-xl font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition">
                                ⟲
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Body Card -->
                <div class="flex-auto pt-4">

                    @if (session('success'))
                        <div class="mx-6 mb-4 p-3 rounded-lg bg-green-100 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="overflow-x-auto px-6">
                        <table class="w-full text-slate-500">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold">Nama Barang</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold">Satuan</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold">Stok</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold">Sumber</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold">Kejadian</th>
                                    <th class="px-4 py-3 text-center text-xs font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logistik as $item)
                                    <tr class="border-b">
                                        <td class="px-4 py-2 text-xs">
                                            {{ $logistik->firstItem() + $loop->index }}
                                        </td>
                                        <td class="px-4 py-2 text-xs">{{ $item->nama_barang }}</td>
                                        <td class="px-4 py-2 text-xs">{{ $item->satuan }}</td>
                                        <td class="px-4 py-2 text-xs">{{ $item->stok }}</td>
                                        <td class="px-4 py-2 text-xs">{{ $item->sumber ?? '-' }}</td>
                                        <td class="px-4 py-2 text-xs">
                                            @if ($item->kejadian)
                                                {{ $item->kejadian->jenis_bencana }} |
                                                {{ $item->kejadian->lokasi_text }} |
                                                {{ \Carbon\Carbon::parse($item->kejadian->tanggal)->format('d M Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.logistik_bencana.edit', $item) }}"
                                                    class="px-2 py-1 text-xs text-black bg-indigo-500 hover:bg-blue-600 rounded-lg font-semibold shadow-md transition whitespace-nowrap">
                                                    ✏️ Edit</a>

                                                <a href="{{ route('admin.logistik_bencana.show', $item) }}"
                                                    class="px-2 py-1 text-xs text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition font-semibold shadow-md whitespace-nowrap">
                                                    🔍 Detail</a>

                                                <form action="{{ route('admin.logistik_bencana.destroy', $item) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data logistik ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="px-2 py-1 text-xs text-black bg-red-600 hover:bg-red-700 rounded-lg font-semibold shadow-md transition whitespace-nowrap">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-4 text-center text-xs text-gray-400">
                                            Belum ada data logistik.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <!-- Pagination -->
                    <div class="w-full flex justify-center items-center gap-2 py-8 flex-wrap">

                        {{-- Previous --}}
                        @if ($logistik->onFirstPage())
                            <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                                style="background:#C40BB2">
                                ‹ Prev
                            </span>
                        @else
                            <a href="{{ $logistik->previousPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                                style="background:#C40BB2">
                                ‹ Prev
                            </a>
                        @endif

                        {{-- Pagination Logic --}}
                        @php
                            $start = max($logistik->currentPage() - 2, 1);
                            $end = min($logistik->currentPage() + 2, $logistik->lastPage());
                        @endphp

                        {{-- First Page --}}
                        @if ($start > 1)
                            <a href="{{ $logistik->url(1) }}" class="px-4 py-2 rounded-lg font-bold"
                                style="background:#e0e0e0">1</a>
                            <span class="px-2">...</span>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($logistik->getUrlRange($start, $end) as $page => $url)
                            @if ($page == $logistik->currentPage())
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
                        @if ($end < $logistik->lastPage())
                            <span class="px-2">...</span>
                            <a href="{{ $logistik->url($logistik->lastPage()) }}" class="px-4 py-2 rounded-lg font-bold"
                                style="background:#e0e0e0">
                                {{ $logistik->lastPage() }}
                            </a>
                        @endif

                        {{-- Next --}}
                        @if ($logistik->hasMorePages())
                            <a href="{{ $logistik->nextPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
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
            </div>
        </div>

    </div>
@endsection
