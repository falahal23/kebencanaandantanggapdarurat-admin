@extends('layouts.admin.app')

@section('title', 'Daftar Donasi Bencana')

@section('content')
    <div class="flex justify-between items-start mb-6 flex-wrap gap-4 pr-4 mt-4">

        {{-- HEADER + FILTER --}}
        <div class="mb-6 space-y-4">

            {{-- Header --}}
            <div class="flex items-center gap-4">
                <div
                    class="flex items-center justify-center w-12 h-12 rounded-xl
                       bg-blue-50 text-blue-600 shadow-sm">
                    <i class="fa fa-hand-holding-heart text-xl"></i>
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-slate-800 leading-tight">
                        Daftar Donasi Bencana
                    </h1>
                    <p class="text-sm text-slate-500">
                        Rekap dan pengelolaan donasi yang masuk
                    </p>
                </div>
            </div>

            {{-- Filter --}}
            <form method="GET" class="flex flex-wrap items-center gap-3">
                <form method="GET" action="{{ route('admin.donasi.index') }}"
                    class="flex flex-wrap items-center gap-3 mt-4">

                    {{-- SEARCH --}}
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari donatur atau jenis donasi..."
                    class="px-4 py-2 w-64 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">

                    {{-- FILTER JENIS DONASI --}}
                    <select name="jenis"
                        class="w-full sm:w-56 px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">Semua Jenis Donasi</option>

                        @foreach ($jenisList as $jenis)
                            <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>
                                {{ $jenis }}
                            </option>
                        @endforeach
                    </select>

                    {{-- TOMBOL CARI --}}
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition">
                        <i class="fa fa-search"></i>
                        Cari
                    </button>

                    {{-- RESET (MUNCUL SETELAH FILTER) --}}
                    @if (request()->filled('search') || request()->filled('jenis'))
                        <a href="{{ route('admin.donasi.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-semibold rounded-lg shadow transition">
                            <i class="fa fa-rotate-left"></i>
                            Reset
                        </a>
                    @endif
                </form>

        </div>

        {{-- TOMBOL TAMBAH (KANAN) --}}
        <div class="transform -translate-x-6">
            <a href="{{ route('admin.donasi.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5
               text-white text-sm font-semibold rounded-xl
               bg-gradient-to-r from-blue-600 to-cyan-400
               shadow hover:shadow-lg transition">
                <i class="fa fa-plus"></i>
                Tambah Donasi
            </a>
        </div>


    </div>

    {{-- NOTIFIKASI --}}
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
    <div class="bg-white shadow-soft-xl rounded-2xl p-6 overflow-x-auto w-full">
        <table class="min-w-[1100px] w-full text-sm text-slate-700 border-collapse">

            <!-- HEADER -->
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-600">
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">No</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Donatur</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Jenis</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Nilai Donasi</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Kejadian Bencana</th>
                    <th class="px-4 py-3 font-semibold text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y divide-slate-100">
                @forelse($donasi as $d)
                    <tr class="hover:bg-cyan-50/40 transition duration-200">

                        <!-- No -->
                        <td class="px-4 py-3 text-slate-500">
                            {{ $d->donasi_id }}
                        </td>

                        <!-- Donatur -->
                        <td class="px-4 py-3 font-semibold text-slate-800">
                            {{ $d->donatur_nama }}
                        </td>

                        <!-- Jenis -->
                        <td class="px-4 py-3">
                            @php
                                $jenis = strtolower($d->jenis);

                                $warna = match ($jenis) {
                                    'uang' => 'bg-green-100 text-green-700',
                                    'sembako' => 'bg-orange-100 text-orange-700',
                                    'pakaian' => 'bg-blue-100 text-blue-700',
                                    'obat-obatan' => 'bg-red-100 text-red-700',
                                    'logistik' => 'bg-purple-100 text-purple-700',
                                    default => 'bg-slate-100 text-slate-700',
                                };
                            @endphp

                            <span
                                class="inline-flex items-center gap-1 px-3 py-1
                 text-xs font-semibold rounded-full {{ $warna }}">
                                {{ ucfirst($d->jenis) }}
                            </span>
                        </td>


                        <!-- Nilai -->
                        <td class="px-4 py-3 font-semibold text-slate-800">
                            Rp {{ number_format($d->nilai, 0, ',', '.') }}
                        </td>

                        <!-- Kejadian -->
                        <td class="px-4 py-3 text-sm text-slate-600">
                            @if ($d->kejadian)
                                <div class="font-medium text-slate-700">
                                    {{ $d->kejadian->jenis_bencana }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    {{ $d->kejadian->lokasi_text }} •
                                    {{ \Carbon\Carbon::parse($d->kejadian->tanggal)->format('d M Y') }}
                                </div>
                            @else
                                <span class="text-slate-400 italic">Tidak terkait</span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <div class="flex justify-center gap-2">

                                <!-- Detail -->
                                <a href="{{ route('admin.donasi.show', $d->donasi_id) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5
                                      text-xs font-semibold text-white
                                      bg-slate-600 rounded-lg
                                      hover:bg-slate-700 transition shadow">
                                    <i class="fa fa-eye"></i>
                                    Detail
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('admin.donasi.edit', $d->donasi_id) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5
                                      text-xs font-semibold
                                      text-indigo-700 bg-indigo-100
                                      rounded-lg hover:bg-indigo-200 transition shadow">
                                    <i class="fa fa-pen"></i>
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('admin.donasi.destroy', $d->donasi_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus donasi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5
                                           text-xs font-semibold
                                           text-red-600 bg-red-100
                                           rounded-lg hover:bg-red-200 transition shadow">
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">
                            <i class="fa fa-circle-info text-lg block mb-1"></i>
                            Belum ada data donasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

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
                <a href="{{ $donasi->url(1) }}" class="px-4 py-2 rounded-lg font-bold" style="background:#e0e0e0">1</a>
                <span class="px-2">...</span>
            @endif

            {{-- Page Numbers --}}
            @foreach ($donasi->getUrlRange($start, $end) as $page => $url)
                @if ($page == $donasi->currentPage())
                    <span class="px-4 py-2 rounded-lg font-bold text-white" style="background:#333">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" class="px-4 py-2 rounded-lg font-bold" style="background:#e0e0e0">
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
