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
                            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                                <i class="fa fa-boxes-stacked text-cyan-500"></i>
                                Logistik Bencana
                            </h1>

                            <p class="mt-1 text-sm text-gray-500 flex items-center gap-2">
                                <i class="fa fa-check text-cyan-500"></i>
                                Semua data logistik telah terdaftar dan terkelola
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
                                <option value="{{ $kejadian->kejadian_id }}"
                                    {{ request('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                                    {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                                </option>
                            @endforeach
                        </select>


                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-black rounded-lg text-sm hover:bg-blue-500 transition">
                            🔍
                        </button>

                        @if (request()->hasAny(['search', 'status', 'tanggal']))
                            <a href="{{ route('logistik.index') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5
                       bg-slate-200 text-slate-700 text-sm font-semibold
                       rounded-xl hover:bg-slate-300 transition">
                                <i class="fa fa-rotate-left"></i>
                                Reset
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
                        <table class="w-full text-sm text-slate-600 border-separate border-spacing-y-2">

                            <!-- HEADER -->
                            <thead>
                                <tr class="text-xs uppercase tracking-wide text-slate-500">
                                    <th class="px-4 py-3 text-left">No</th>
                                    <th class="px-4 py-3 text-left">Nama Barang</th>
                                    <th class="px-4 py-3 text-left">Satuan</th>
                                    <th class="px-4 py-3 text-left">Stok</th>
                                    <th class="px-4 py-3 text-left">Sumber</th>
                                    <th class="px-4 py-3 text-left">Kejadian</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <!-- BODY -->
                            <tbody>
                                @forelse ($logistik as $item)
                                    <tr class="bg-white shadow-sm hover:shadow-md transition rounded-lg">

                                        <!-- No -->
                                        <td class="px-4 py-3 text-xs text-slate-500 rounded-l-lg">
                                            {{ $logistik->firstItem() + $loop->index }}
                                        </td>

                                        <!-- Nama -->
                                        <td class="px-4 py-3 font-semibold text-slate-800">
                                            {{ $item->nama_barang }}
                                        </td>

                                        <!-- Satuan (BADGE WARNA) -->
                                        <td class="px-4 py-3">
                                            @php
                                                $satuan = strtolower($item->satuan);

                                                $warna = match (true) {
                                                    str_contains($satuan, 'dus'),
                                                    str_contains($satuan, 'box')
                                                        => 'bg-green-100 text-green-700',

                                                    str_contains($satuan, 'kg') => 'bg-red-100 text-red-700',

                                                    str_contains($satuan, 'liter'),
                                                    str_contains($satuan, 'ltr')
                                                        => 'bg-blue-100 text-blue-700',

                                                    str_contains($satuan, 'pcs') => 'bg-purple-100 text-purple-700',

                                                    default => 'bg-gray-100 text-gray-700',
                                                };
                                            @endphp

                                            <span class="px-2 py-1 text-xs font-semibold rounded-md {{ $warna }}">
                                                {{ strtoupper($item->satuan) }}
                                            </span>
                                        </td>

                                        <!-- Stok -->
                                        <td class="px-4 py-3 font-semibold text-slate-700">
                                            {{ $item->stok }}
                                        </td>

                                        <!-- Sumber -->
                                        <td class="px-4 py-3 text-slate-600">
                                            {{ $item->sumber ?? '-' }}
                                        </td>

                                        <!-- Kejadian -->
                                        <td class="px-4 py-3 text-xs text-slate-600">
                                            @if ($item->kejadian)
                                                <div class="font-semibold text-slate-700">
                                                    {{ $item->kejadian->jenis_bencana }}
                                                </div>
                                                <div class="text-slate-400">
                                                    {{ $item->kejadian->lokasi_text }} •
                                                    {{ \Carbon\Carbon::parse($item->kejadian->tanggal)->format('d M Y') }}
                                                </div>
                                            @else
                                                <span class="italic text-slate-400">-</span>
                                            @endif
                                        </td>

                                        <!-- AKSI -->
                                        <td class="px-4 py-3 text-center rounded-r-lg">
                                            <div class="flex justify-center gap-2">

                                                <a href="{{ route('admin.logistik_bencana.show', $item) }}"
                                                    class="px-3 py-1.5 text-xs font-semibold bg-slate-600 text-white rounded-lg  hover:bg-slate-700 transition shadow">
                                                    👁️ Detail
                                                </a>

                                                <a href="{{ route('admin.logistik_bencana.edit', $item) }}"
                                                    class="px-3 py-1.5 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition shadow">
                                                    ✏️ Edit
                                                </a>

                                                <form action="{{ route('admin.logistik_bencana.destroy', $item) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data logistik ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="px-3 py-1.5 text-xs font-semibold bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition shadow">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-sm text-slate-400">
                                            <i class="fa fa-box-open text-lg mb-1 block"></i>
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
