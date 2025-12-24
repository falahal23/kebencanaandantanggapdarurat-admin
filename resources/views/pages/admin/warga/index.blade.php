@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <!-- card Data Warga -->
        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">

                <!-- Header Card -->
                <div class="flex justify-between items-center flex-wrap gap-4">

                    <!-- KIRI : JUDUL + LOGO -->
                    <div class="flex items-center gap-4">
                        <div
                            class="flex items-center justify-center w-11 h-11 rounded-xl
               bg-cyan-50 text-cyan-600 shadow-sm">
                            <i class="fa fa-users text-lg"></i>
                        </div>

                        <div>
                            <h6 class="text-2xl font-semibold text-slate-800 leading-tight">
                                Data Warga
                            </h6>
                            <p class="text-sm text-slate-500 flex items-center gap-2 mt-1">
                                <i class="fa fa-circle-check text-cyan-500"></i>
                                Semua data warga telah tercatat
                            </p>
                        </div>
                    </div>

                    <!-- KANAN : TOMBOL TAMBAH -->
                    <a href="{{ route('admin.warga.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5
               text-white font-semibold text-sm
               rounded-xl bg-gradient-to-r from-blue-600 to-cyan-400
               shadow hover:shadow-lg transition">
                        <i class="fa fa-plus"></i>
                        Tambah Warga
                    </a>

                </div>
            </div>


            <div class="p-6">
                <form action="{{ route('warga.index') }}" method="GET" class="flex flex-wrap gap-2 items-center">
                    {{-- Search --}}
                    <input type="text" name="search" placeholder="Cari nama, no. KTP atau email"
                        value="{{ request('search') }}" class="border rounded px-3 py-2 text-sm w-full md:w-1/3">

                    {{-- Filter Jenis Kelamin --}}
                    <select name="jenis_kelamin" class="border rounded px-3 py-2 text-sm">
                        <option value="">-- Semua Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>

                    {{-- Filter Agama --}}
                    <select name="agama" class="border rounded px-3 py-2 text-sm">
                        <option value="">-- Semua Agama --</option>
                        <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen
                        </option>
                        <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik
                        </option>
                        <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                        </option>
                    </select>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition text-sm">
                        🔍
                    </button>

                    @if (request()->has('search') && request('search') != '')
                        <a href="{{ route('warga.index') }}"
                            class="px-4 py-2 bg-gray-300 text-black rounded-lg shadow hover:bg-gray-400 transition text-sm">
                            ⟲
                        </a>
                    @endif
                </form>
            </div>


        </div>

        <!-- Body Card -->
        <div class="flex-auto p-6 px-0 pb-2">

            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="mb-4 mx-6 p-3 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Warga -->
            <div class="overflow-x-auto mx-6">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">No</th>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">No. KTP</th>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Nama</th>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Jenis
                                Kelamin</th>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Agama</th>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Pekerjaan
                            </th>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Telepon</th>
                            <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Email</th>
                            <th class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($warga as $index => $item)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $warga->firstItem() + $index }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $item->no_ktp }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $item->nama }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $item->jenis_kelamin }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $item->agama }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $item->pekerjaan ?? '-' }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $item->telp ?? '-' }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="text-xs font-semibold">{{ $item->email ?? '-' }}</span>
                                </td>
                                <td class="p-2 text-center align-middle border-b whitespace-nowrap">
                                    <div class="flex justify-center space-x-4">

                                        <!-- Tombol Edit -->
                                        <div class="flex items-center gap-2">

                                            <!-- Tombol Edit -->
                                            <div class="flex items-center gap-2">

                                                <!-- Tombol Edit -->
                                                <a href="{{ route('warga.edit', $item->warga_id) }}"
                                                    class="px-3 py-1.5 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition shadow">
                                                    ✏️ Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-100 rounded-lg hover:bg-red-200 transition">
                                                        <i class="fa fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>


                                        </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-slate-400 text-xs py-4">Belum ada data
                                    warga.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Warga --}}
            <div class="w-full flex justify-center items-center gap-3 py-8 flex-wrap">

                {{-- Previous --}}
                @if ($warga->onFirstPage())
                    <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                        style="background:#5a00ea">
                        ‹ Prev
                    </span>
                @else
                    <a href="{{ $warga->previousPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                        style="background:#5a00ea; text-decoration:none;">
                        ‹ Prev
                    </a>
                @endif

                {{-- Pagination Logic --}}
                @php
                    $start = max($warga->currentPage() - 2, 1);
                    $end = min($warga->currentPage() + 2, $warga->lastPage());
                @endphp

                {{-- First Page --}}
                @if ($start > 1)
                    <a href="{{ $warga->url(1) }}" class="px-4 py-2 rounded-lg font-bold"
                        style="background:#e0e0e0; text-decoration:none;">
                        1
                    </a>
                    <span class="px-2 font-bold">...</span>
                @endif

                {{-- Page Numbers --}}
                @foreach ($warga->getUrlRange($start, $end) as $page => $url)
                    @if ($page == $warga->currentPage())
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
                @if ($end < $warga->lastPage())
                    <span class="px-2 font-bold">...</span>
                    <a href="{{ $warga->url($warga->lastPage()) }}" class="px-4 py-2 rounded-lg font-bold"
                        style="background:#e0e0e0; text-decoration:none;">
                        {{ $warga->lastPage() }}
                    </a>
                @endif

                {{-- Next --}}
                @if ($warga->hasMorePages())
                    <a href="{{ $warga->nextPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
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
    </div>
@endsection
