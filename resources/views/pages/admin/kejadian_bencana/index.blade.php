@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

@extends('layouts.admin.app')

@section('title', 'Daftar Kejadian Bencana')

@section('content')

    <div class="w-full px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white shadow-xl rounded-xl ring-1 ring-gray-100">

            {{-- HEADER --}}
            <div class="p-6 border-b border-gray-200 flex justify-between items-center flex-wrap gap-4">

                <!-- KIRI : JUDUL -->
                <div class="flex flex-col gap-4">

                    {{-- JUDUL --}}
                    <div class="flex items-center gap-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-xl
                   bg-blue-50 text-blue-600 shadow-sm">
                            <i class="fa fa-triangle-exclamation text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-3xl font-bold text-slate-800 leading-tight">
                                Kejadian Bencana
                            </h2>
                            <p class="text-sm text-slate-500 mt-1">
                                Data kejadian bencana terbaru dan terverifikasi
                            </p>
                        </div>
                    </div>

                    {{-- SEARCH & FILTER --}}
                    <form method="GET" class="flex flex-wrap items-end gap-3">

                        {{-- Search --}}
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari jenis, lokasi, keterangan..."
                            class="px-4 py-2 w-64 rounded-xl border border-slate-300
                   text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">

                        {{-- Status --}}
                        <select name="status"
                            class="px-4 py-2 w-52 rounded-xl border border-slate-300
                   text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="sedang ditangani"
                                {{ request('status') == 'sedang ditangani' ? 'selected' : '' }}>
                                Sedang Ditangani
                            </option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                        </select>

                        {{-- Tanggal --}}
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                            class="px-4 py-2 rounded-xl border border-slate-300
                   text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">

                        {{-- Tombol Cari --}}
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5
                   bg-blue-600 text-white text-sm font-semibold
                   rounded-xl shadow hover:bg-blue-700 transition">
                            <i class="fa fa-search"></i>
                            Cari
                        </button>

                        {{-- Reset --}}
                        @if (request()->hasAny(['search', 'status', 'tanggal']))
                            <a href="{{ route('kejadian.index') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5
                       bg-slate-200 text-slate-700 text-sm font-semibold
                       rounded-xl hover:bg-slate-300 transition">
                                <i class="fa fa-rotate-left"></i>
                                Reset
                            </a>
                        @endif

                    </form>

                </div>



                <!-- KANAN : TOMBOL -->
                <a href="{{ route('kejadian.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5
              text-white text-sm font-semibold rounded-xl
              bg-gradient-to-r from-blue-600 to-cyan-400
              shadow hover:shadow-lg transition">
                    <i class="fa fa-plus"></i>
                    Tambah Kejadian
                </a>

            </div>


            {{-- TABLE --}}
            <div class="p-6 overflow-x-auto">
                <table class="min-w-full text-sm text-left text-slate-700 border-collapse">

                    <!-- HEADER -->
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600">
                            <th class="px-4 py-3 font-semibold">Jenis</th>
                            <th class="px-4 py-3 font-semibold">Tanggal</th>
                            <th class="px-4 py-3 font-semibold">Lokasi</th>
                            <th class="px-4 py-3 text-center font-semibold">Dampak</th>
                            <th class="px-4 py-3 text-center font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold">Keterangan</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($kejadian as $item)
                            <tr class="hover:bg-cyan-50/40 transition duration-200">

                                <!-- Jenis -->
                                <td class="p-4 font-semibold text-slate-800">
                                    {{ $item->jenis_bencana }}
                                </td>

                                <!-- Tanggal -->
                                <td class="p-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </td>

                                <!-- Lokasi -->
                                <td class="p-4">
                                    <div class="font-medium">{{ $item->lokasi_text }}</div>
                                    <div class="text-xs text-slate-500">
                                        RT {{ $item->rt }} / RW {{ $item->rw }}
                                    </div>
                                </td>

                                <!-- Dampak -->
                                <td class="p-4 text-center font-semibold">
                                    {{ $item->dampak }}
                                </td>

                                <!-- STATUS -->
                                <td class="p-4 text-center">
                                    @php
                                        $status = strtolower($item->status_kejadian);
                                    @endphp

                                    @if ($status == 'aktif')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full
                                         bg-red-100 text-red-600">
                                            🔴 Aktif
                                        </span>
                                    @elseif ($status == 'sedang ditangani')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full
                                         bg-green-100 text-green-600">
                                            🟢 Sedang Ditangani
                                        </span>
                                    @elseif ($status == 'selesai')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full
                                         bg-blue-100 text-blue-600">
                                            🔵 Selesai
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full
                                         bg-gray-100 text-gray-600">
                                            {{ $item->status_kejadian }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Keterangan -->
                                <td class="p-4 text-xs text-slate-600 max-w-xs truncate">
                                    {{ $item->keterangan ?? '-' }}
                                </td>

                                <!-- AKSI -->
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="flex gap-2 justify-center">

                                        <a href="{{ route('kejadian.show', $item->kejadian_id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5
                                      text-xs font-semibold text-white
                                      bg-slate-600 rounded-lg
                                      hover:bg-slate-700 transition">
                                            <i class="fa fa-eye"></i>
                                            Detail
                                        </a>

                                        <a href="{{ route('kejadian.edit', $item->kejadian_id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5
                                      text-xs font-semibold
                                      text-blue-600 bg-blue-100
                                      rounded-lg hover:bg-blue-200 transition">
                                            <i class="fa fa-pen"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('kejadian.destroy', $item->kejadian_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5
                                           text-xs font-semibold
                                           text-red-600 bg-red-100
                                           rounded-lg hover:bg-red-200 transition">
                                                <i class="fa fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>


            {{-- PAGINATION (STYLE ASLI) --}}
            <!-- Pagination -->
            <div class="w-full flex justify-center items-center gap-2 py-8 flex-wrap">

                {{-- Previous --}}
                @if ($kejadian->onFirstPage())
                    <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                        style="background:#C40BB2">
                        ‹ Prev
                    </span>
                @else
                    <a href="{{ $kejadian->previousPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                        style="background:#C40BB2">
                        ‹ Prev
                    </a>
                @endif

                {{-- Pagination Logic --}}
                @php
                    $start = max($kejadian->currentPage() - 2, 1);
                    $end = min($kejadian->currentPage() + 2, $kejadian->lastPage());
                @endphp

                {{-- First Page --}}
                @if ($start > 1)
                    <a href="{{ $kejadian->url(1) }}" class="px-4 py-2 rounded-lg font-bold"
                        style="background:#e0e0e0">1</a>
                    <span class="px-2">...</span>
                @endif

                {{-- Page Numbers --}}
                @foreach ($kejadian->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $kejadian->currentPage())
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
                @if ($end < $kejadian->lastPage())
                    <span class="px-2">...</span>
                    <a href="{{ $kejadian->url($kejadian->lastPage()) }}" class="px-4 py-2 rounded-lg font-bold"
                        style="background:#e0e0e0">
                        {{ $kejadian->lastPage() }}
                    </a>
                @endif

                {{-- Next --}}
                @if ($kejadian->hasMorePages())
                    <a href="{{ $kejadian->nextPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
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
