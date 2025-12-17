@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">

        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative flex flex-col rounded-2xl bg-white">

                <!-- Header -->
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b bg-white p-6 pb-0">
                    <div class="flex flex-wrap justify-between items-center -mx-3">
                        <div class="w-7/12 px-3">
                            <h6>Distribusi Logistik</h6>
                            <p class="mb-0 text-sm">
                                <i class="fa fa-check text-cyan-500"></i>
                                Semua data distribusi tercatat
                            </p>
                        </div>

                        <div class="w-5/12 px-3 text-right">
                            <a href="{{ route('admin.distribusi_logistik.create') }}"
                                class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow hover:shadow-lg transition">
                                <i class="fa fa-plus mr-1"></i> Tambah Distribusi
                            </a>
                        </div>
                    </div>
                    <form method="GET" class="flex gap-2 flex-wrap items-center mb-4 mx-6">

                        <!-- Search -->
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari logistik atau posko" class="px-3 py-2 border rounded-lg text-sm">

                        <!-- Filter Posko -->
                        <select name="posko_id" class="px-3 py-2 border rounded-lg text-sm">
                            <option value="">Semua Posko</option>
                            @foreach ($poskos as $posko)
                                <option value="{{ $posko->id }}"
                                    {{ request('posko_id') == $posko->id ? 'selected' : '' }}>
                                    {{ $posko->nama }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Submit -->
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-500 transition">
                            🔍
                        </button>

                        <!-- Reset -->
                        @if (request()->has('search') && request('search') != '')
                            <a href="{{ route('admin.distribusi_logistik.index') }}"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg shadow hover:bg-gray-400 transition text-sm">
                                ⟲
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
                        <table class="items-center w-full mb-0 text-slate-600">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xxs font-bold uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xxs font-bold uppercase">Logistik</th>
                                    <th class="px-6 py-3 text-left text-xxs font-bold uppercase">Posko</th>
                                    <th class="px-6 py-3 text-left text-xxs font-bold uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xxs font-bold uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xxs font-bold uppercase">Penerima</th>
                                    <th class="px-6 py-3 text-left text-xxs font-bold uppercase">Bukti</th>
                                    <th class="px-6py-3 text-center text-xxs font-bold uppercase">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($distribusi as $index => $d)
                                    <td class="px-6 py-3">
                                        <span class="text-xs font-semibold">
                                            {{ $distribusi->firstItem() + $loop->index }}
                                        </span>
                                    </td>


                                    {{-- Logistik --}}
                                    <td class="px-6 py-3">
                                        <span class="text-xs font-semibold">
                                            {{ $d->logistik->nama_barang ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- Posko --}}
                                    <td class="px-6 py-3">
                                        <span class="text-xs font-semibold">
                                            {{ $d->posko->nama ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- Jumlah --}}
                                    <td class="px-6 py-3">
                                        <span class="text-xs font-semibold">{{ $d->jumlah }}</span>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="px-6 py-3">
                                        <span class="text-xs font-semibold">
                                            {{ \Carbon\Carbon::parse($d->tanggal)->format('d M Y') }}
                                        </span>
                                    </td>

                                    {{-- Penerima --}}
                                    <td class="px-6 py-3">
                                        <span class="text-xs font-semibold">{{ $d->penerima }}</span>
                                    </td>

                                    {{-- Bukti --}}
                                    <td class="px-6 py-3">
                                        @if ($d->media)
                                            <a href="{{ $d->media->file_url }}" target="_blank"
                                                class="text-blue-600 underline text-xs">Lihat Bukti</a>
                                        @else
                                            <span class="text-slate-400 text-xs">-</span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center space-x-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.distribusi_logistik.edit', $d->distribusi_id) }}"
                                                class="px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-xs font-semibold shadow hover:shadow-lg transition">
                                                ✏️ Edit
                                            </a>

                                            {{-- Hapus --}}
                                            <form
                                                action="{{ route('admin.distribusi_logistik.destroy', $d->distribusi_id) }}"
                                                method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-rose-400 rounded-lg text-xs font-semibold shadow hover:shadow-lg transition">
                                                    🗑️ Hapus
                                                </button>
                                            </form>

                                            {{-- Tombol Detail --}}
                                            <a href="{{ route('admin.distribusi_logistik.show', $d->distribusi_id) }}"
                                                class="px-2 py-1 font-bold text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition">
                                                👁️ Detail
                                            </a>

                                        </div>
                                    </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-slate-400 text-xs py-4">
                                            Belum ada data distribusi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- pagiantion --}}
                    <div class="mt-6" style="display: flex; justify-content: center; align-items: center; gap: 20px;">

                        {{-- Previous --}}
                        @if ($distribusi->onFirstPage())
                            <span
                                style="padding: 10px 16px; background: #C40BB2; color: white; border-radius: 8px; opacity: 0.5;">
                                ‹ Previous
                            </span>
                        @else
                            <a href="{{ $distribusi->previousPageUrl() }}"
                                style="padding: 10px 16px; background: #C40BB2; color: white; border-radius: 8px; text-decoration: none;">
                                ‹ Previous
                            </a>
                        @endif


                        {{-- Page Numbers --}}
                        <div style="display: flex; gap: 10px;">
                            @for ($i = 1; $i <= $distribusi->lastPage(); $i++)
                                @if ($i == $distribusi->currentPage())
                                    {{-- Active Page --}}
                                    <span
                                        style="padding: 10px 16px; background: #4a4a4a; color: white; border-radius: 8px; font-weight: bold;">
                                        {{ $i }}
                                    </span>
                                @else
                                    {{-- Normal Page --}}
                                    <a href="{{ $distribusi->url($i) }}"
                                        style="padding: 10px 16px; background: #e0e0e0; color: #333; border-radius: 8px; text-decoration: none;">
                                        {{ $i }}
                                    </a>
                                @endif
                            @endfor
                        </div>


                        {{-- Next --}}
                        @if ($distribusi->hasMorePages())
                            <a href="{{ $distribusi->nextPageUrl() }}"
                                style="padding: 10px 16px; background: #007bff; color: white; border-radius: 8px; text-decoration: none;">
                                Next ›
                            </a>
                        @else
                            <span
                                style="padding: 10px 16px; background: #007bff; color: white; border-radius: 8px; opacity: 0.5;">
                                Next ›
                            </span>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    @endsection
