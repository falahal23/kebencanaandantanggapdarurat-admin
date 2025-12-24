@extends('layouts.admin.app')

@section('content')
    <div class="w-full px-6 py-6">

        <!-- Card Posko -->
        <div class="bg-white rounded-2xl shadow-soft-xl border-0">

            <!-- Header -->
            <div class="p-6 border-b flex flex-col gap-5">

                <!-- HEADER -->
                <div class="flex justify-between items-center flex-wrap gap-4">

                    <!-- KIRI : JUDUL + LOGO -->
                    <div class="flex items-center gap-4">
                        <div
                            class="flex items-center justify-center w-11 h-11 rounded-xl
                       bg-cyan-50 text-cyan-600 shadow-sm">
                            <i class="fa fa-campground text-lg"></i>
                        </div>

                        <div>
                            <h6 class="text-2xl font-semibold text-slate-800 leading-tight">
                                Posko Bencana
                            </h6>
                            <p class="text-sm text-slate-500 flex items-center gap-2 mt-1">
                                <i class="fa fa-circle-check text-cyan-500"></i>
                                Semua data posko bencana telah tercatat
                            </p>
                        </div>
                    </div>

                    <!-- KANAN : TOMBOL TAMBAH -->
                    <a href="{{ route('admin.posko.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5
                   text-white font-semibold text-sm
                   rounded-xl bg-gradient-to-r from-blue-600 to-cyan-400
                   shadow hover:shadow-lg transition">
                        <i class="fa fa-plus"></i>
                        Tambah Posko
                    </a>

                </div>

                <!-- SEARCH & FILTER -->
                <form action="{{ route('posko.index') }}" method="GET" class="flex flex-wrap items-end gap-3">

                    {{-- Search --}}
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama posko, alamat, penanggung jawab..."
                        class="px-4 py-2 w-72 rounded-xl border border-slate-300
                   text-sm focus:ring-2 focus:ring-blue-400
                   focus:border-blue-400 transition">

                    {{-- Filter Alamat --}}
                    <select name="alamat"
                        class="px-4 py-2 w-56 rounded-xl border border-slate-300
                   text-sm focus:ring-2 focus:ring-blue-400
                   focus:border-blue-400 transition">
                        <option value="">Semua Alamat</option>
                        @foreach ($alamatList as $alamat)
                            <option value="{{ $alamat }}" {{ request('alamat') == $alamat ? 'selected' : '' }}>
                                {{ $alamat }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Tombol Cari --}}
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5
                   bg-blue-600 text-white text-sm font-semibold
                   rounded-xl shadow hover:bg-blue-700 transition">
                        <i class="fa fa-search"></i>
                        Cari
                    </button>

                    {{-- Reset (MUNCUL SETELAH PENCARIAN) --}}
                    @if (request()->filled('search') || request()->filled('alamat'))
                        <a href="{{ route('posko.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5
                      bg-slate-200 text-slate-700 text-sm font-semibold
                      rounded-xl hover:bg-slate-300 transition">
                            <i class="fa fa-rotate-left"></i>
                            Reset
                        </a>
                    @endif

                </form>

            </div>


            <!-- Table -->
            <div class="p-6 overflow-x-auto">
                <table class="min-w-full text-sm text-left text-slate-700 border-collapse">

                    <!-- HEADER -->
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600">
                            <th class="px-4 py-3 font-semibold">No</th>
                            <th class="px-4 py-3 font-semibold">Nama Posko</th>
                            <th class="px-4 py-3 font-semibold">Alamat</th>
                            <th class="px-4 py-3 font-semibold">Kontak</th>
                            <th class="px-4 py-3 font-semibold">Penanggung Jawab</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($posko as $item)
                            <tr class="hover:bg-cyan-50/40 transition duration-200">

                                <!-- NO -->
                                <td class="p-4 font-medium text-slate-600">
                                    {{ $posko->firstItem() + $loop->index }}
                                </td>

                                <!-- NAMA POSKO -->
                                <td class="p-4 font-semibold text-slate-800">
                                    {{ $item->nama }}
                                </td>

                                <!-- ALAMAT -->
                                <td class="p-4 text-slate-600 max-w-xs truncate">
                                    {{ $item->alamat }}
                                </td>

                                <!-- KONTAK -->
                                <td class="p-4">
                                    @if ($item->kontak)
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1
                                       text-xs font-semibold
                                       bg-blue-100 text-blue-600
                                       rounded-full">
                                            📞 {{ $item->kontak }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endif
                                </td>

                                <!-- PENANGGUNG JAWAB -->
                                <td class="p-4">
                                    {{ $item->penanggung_jawab ?? '-' }}
                                </td>

                                <!-- AKSI -->
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.posko.show', $item) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5
                                       text-xs font-semibold text-white
                                       bg-slate-600 rounded-lg
                                       hover:bg-slate-700 transition">
                                            <i class="fa fa-eye"></i>
                                            Detail
                                        </a>

                                        <a href="{{ route('admin.posko.edit', $item) }}"
                                            class="px-3 py-1.5 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition shadow">
                                            <i class="fa fa-pen"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.posko.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus posko ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-100 rounded-lg hover:bg-red-200 transition">
                                                <i class="fa fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400 text-sm">
                                    <i class="fa fa-inbox mb-2 block text-lg"></i>
                                    Belum ada data posko
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="w-full flex justify-center items-center gap-2 py-8 flex-wrap">

                {{-- Previous --}}
                @if ($posko->onFirstPage())
                    <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                        style="background:#C40BB2">
                        ‹ Prev
                    </span>
                @else
                    <a href="{{ $posko->previousPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                        style="background:#C40BB2">
                        ‹ Prev
                    </a>
                @endif

                {{-- Pagination Logic --}}
                @php
                    $start = max($posko->currentPage() - 2, 1);
                    $end = min($posko->currentPage() + 2, $posko->lastPage());
                @endphp

                {{-- First Page --}}
                @if ($start > 1)
                    <a href="{{ $posko->url(1) }}" class="px-4 py-2 rounded-lg font-bold" style="background:#e0e0e0">1</a>
                    <span class="px-2">...</span>
                @endif

                {{-- Page Numbers --}}
                @foreach ($posko->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $posko->currentPage())
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
                @if ($end < $posko->lastPage())
                    <span class="px-2">...</span>
                    <a href="{{ $posko->url($posko->lastPage()) }}" class="px-4 py-2 rounded-lg font-bold"
                        style="background:#e0e0e0">
                        {{ $posko->lastPage() }}
                    </a>
                @endif

                {{-- Next --}}
                @if ($posko->hasMorePages())
                    <a href="{{ $posko->nextPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
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
@endsection
