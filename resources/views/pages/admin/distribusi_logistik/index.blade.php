@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">

        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative flex flex-col rounded-2xl bg-white">

                <!-- Header -->
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b bg-white p-6 pb-4">

                    <!-- HEADER -->
                    <div class="flex flex-wrap justify-between items-center gap-4">

                        <!-- KIRI : ICON + JUDUL -->
                        <div class="flex items-center gap-4">

                            <!-- LOGO -->
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-xl
                bg-cyan-50 text-cyan-600 shadow-sm">
                                <i class="fa fa-truck-moving text-xl"></i>
                            </div>

                            <!-- TITLE -->
                            <div>
                                <h1 class="text-3xl font-bold text-slate-800 leading-tight whitespace-nowrap">
                                    Daftar Distribusi Logistik
                                </h1>
                                <p class="text-sm text-slate-500">
                                    Rekap dan pengelolaan distribusi logistik
                                </p>
                            </div>
                        </div>

                        <!-- KANAN : TOMBOL TAMBAH -->
                        <div>
                            <a href="{{ route('admin.distribusi_logistik.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5
                text-white text-sm font-semibold
                bg-gradient-to-r from-blue-600 to-cyan-400
                rounded-xl shadow hover:shadow-lg transition">
                                <i class="fa fa-plus"></i>
                                Tambah Distribusi
                            </a>
                        </div>

                    </div>

                    <form method="GET" class="flex flex-wrap items-end gap-3 mb-6">

                        {{-- Search --}}
                        <form method="GET" class="flex flex-wrap items-end gap-3 mb-6">

                            {{-- Search --}}
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama logistik atau posko..."
                                class="px-4 py-2 w-64 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">

                            {{-- Filter Posko --}}
                            <select name="posko_id"
                                class="px-4 py-2 w-56 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                                <option value="">Semua Posko</option>
                                @foreach ($posko as $posko)
                                    <option value="{{ $posko->posko_id ?? $posko->id }}"
                                        {{ request('posko_id') == ($posko->posko_id ?? $posko->id) ? 'selected' : '' }}>
                                        {{ $posko->nama }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Tombol Cari --}}
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl shadow hover:bg-blue-700 transition">
                                <i class="fa fa-search"></i>
                                Cari
                            </button>

                            {{-- Reset --}}
                            @if (request()->hasAny(['search', 'posko_id']))
                                <a href="{{ route('admin.distribusi_logistik.index') }}"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-300 transition">
                                    <i class="fa fa-rotate-left"></i>
                                    Reset
                                </a>
                            @endif

                        </form>

                </div>


                <div class="p-6 px-0 pb-2">

                    {{-- Alert sukses --}}
                    @if (session('success'))
                        <div class="mb-4 mx-6 p-3 rounded-lg bg-green-100 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel --}}
                    <div class="overflow-x-auto mx-6">
                        <table class="w-full text-sm text-slate-600 border-collapse">

                            <!-- HEADER -->
                            <thead class="bg-slate-100 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Logistik</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Posko</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Penerima</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
                                </tr>
                            </thead>

                            <!-- BODY -->
                            <tbody class="divide-y divide-slate-100 bg-white">

                                @forelse ($distribusi as $d)
                                    <tr class="hover:bg-cyan-50/40 transition">

                                        <!-- NO -->
                                        <td class="px-6 py-3 font-semibold text-slate-700">
                                            {{ $distribusi->firstItem() + $loop->index }}
                                        </td>

                                        <!-- LOGISTIK -->
                                        <td class="px-6 py-3 font-medium text-slate-800">
                                            {{ $d->logistik->nama_barang ?? '-' }}
                                        </td>

                                        <!-- POSKO -->
                                        <td class="px-6 py-3">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold
                            bg-blue-100 text-blue-700 rounded-md">
                                                {{ $d->posko->nama ?? '-' }}
                                            </span>
                                        </td>

                                        <!-- JUMLAH -->
                                        <td class="px-6 py-3 font-semibold">
                                            {{ $d->jumlah }}
                                        </td>

                                        <!-- TANGGAL -->
                                        <td class="px-6 py-3 text-xs text-slate-600 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($d->tanggal)->format('d M Y') }}
                                        </td>

                                        <!-- PENERIMA -->
                                        <td class="px-6 py-3 text-xs">
                                            {{ $d->penerima }}
                                        </td>

                                        <!-- AKSI -->
                                        <td class="px-6 py-3 text-center">
                                            <div class="flex justify-center gap-2 flex-wrap">

                                                <!-- DETAIL -->
                                                <a href="{{ route('admin.distribusi_logistik.show', $d->distribusi_id) }}"
                                                    class="px-3 py-1.5 text-xs font-semibold  text-white bg-slate-600 rounded-lg hover:bg-slate-700 transition-colors flex items-center justify-center gap-1">
                                                    <span>👁️</span> Detail
                                                </a>

                                                <!-- EDIT -->
                                                <a href="{{ route('admin.distribusi_logistik.edit', $d->distribusi_id) }}"
                                                    class="px-3 py-1.5 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition shadow">
                                                    <span>✏️</span> Edit
                                                </a>

                                                <!-- HAPUS -->
                                                <form
                                                    action="{{ route('admin.distribusi_logistik.destroy', $d->distribusi_id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1.5 text-xs font-semibold bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition shadow">
                                                        <span>🗑️</span> Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="py-6 text-center text-slate-400 text-sm">
                                            <i class="fa fa-circle-info block mb-1"></i>
                                            Belum ada data distribusi.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>


                    {{-- Pagination --}}
                    <div class="w-full flex justify-center items-center gap-3 py-8 flex-wrap">

                        {{-- Previous --}}
                        @if ($distribusi->onFirstPage())
                            <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                                style="background:#C40BB2">
                                ‹ Prev
                            </span>
                        @else
                            <a href="{{ $distribusi->previousPageUrl() }}"
                                class="px-4 py-2 rounded-lg font-bold text-white"
                                style="background:#C40BB2; text-decoration:none;">
                                ‹ Prev
                            </a>
                        @endif

                        {{-- Pagination Logic --}}
                        @php
                            $start = max($distribusi->currentPage() - 2, 1);
                            $end = min($distribusi->currentPage() + 2, $distribusi->lastPage());
                        @endphp

                        {{-- First Page --}}
                        @if ($start > 1)
                            <a href="{{ $distribusi->url(1) }}" class="px-4 py-2 rounded-lg font-bold"
                                style="background:#e0e0e0; text-decoration:none;">
                                1
                            </a>
                            <span class="px-2 font-bold">...</span>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($distribusi->getUrlRange($start, $end) as $page => $url)
                            @if ($page == $distribusi->currentPage())
                                <span class="px-4 py-2 rounded-lg font-bold text-white" style="background:#4a4a4a">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 rounded-lg font-bold"
                                    style="background:#e0e0e0; text-decoration:none;">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Last Page --}}
                        @if ($end < $distribusi->lastPage())
                            <span class="px-2 font-bold">...</span>
                            <a href="{{ $distribusi->url($distribusi->lastPage()) }}"
                                class="px-4 py-2 rounded-lg font-bold" style="background:#e0e0e0; text-decoration:none;">
                                {{ $distribusi->lastPage() }}
                            </a>
                        @endif

                        {{-- Next --}}
                        @if ($distribusi->hasMorePages())
                            <a href="{{ $distribusi->nextPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                                style="background:#007bff; text-decoration:none;">
                                Next ›
                            </a>
                        @else
                            <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                                style="background:#007bff">
                                Next ›
                            </span>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    @endsection
