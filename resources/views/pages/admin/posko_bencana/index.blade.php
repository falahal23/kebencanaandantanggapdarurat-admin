@extends('layouts.admin.app')

@section('content')
    <div class="w-full px-6 py-6">

        <!-- Card Posko -->
        <div class="bg-white rounded-2xl shadow-soft-xl border-0">

            <!-- Header -->
            <div class="p-6 border-b flex justify-between items-center">
                <div>
                    <h6 class="text-lg font-semibold">🏕️ Posko Bencana</h6>
                    <p class="text-sm text-gray-500">
                        <i class="fa fa-check text-cyan-500"></i>
                        Semua data posko bencana terdaftar
                    </p>
                </div>

                <a href="{{ route('admin.posko.create') }}"
                    class="px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow hover:shadow-lg">
                    <i class="fa fa-plus mr-1"></i> Tambah Posko
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('posko.index') }}" method="GET"
                class="p-6 bg-gray-50 flex flex-wrap gap-3 items-center">

                <input type="text" name="search" value="{{ request('search') }}" class="flex-1 p-2 border rounded-lg"
                    placeholder="Cari nama, alamat, dll...">

                <select name="alamat" class="p-2 border rounded-lg">
                    <option value="">Semua Alamat</option>
                    @foreach ($alamatList as $alamat)
                        <option value="{{ $alamat }}" {{ request('alamat') == $alamat ? 'selected' : '' }}>
                            {{ $alamat }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
                    🔍
                </button>

                @if (request()->filled('search'))
                    <a href="{{ route('posko.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                        ⟲
                    </a>
                @endif
            </form>

            <!-- Table -->
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm text-slate-600 border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama Posko</th>
                            <th class="px-4 py-3 text-left">Alamat</th>
                            <th class="px-4 py-3 text-left">Kontak</th>
                            <th class="px-4 py-3 text-left">Penanggung Jawab</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($posko as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    {{ $posko->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-2">{{ $item->nama }}</td>
                                <td class="px-4 py-2">{{ $item->alamat }}</td>
                                <td class="px-4 py-2">{{ $item->kontak ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $item->penanggung_jawab ?? '-' }}</td>

                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.posko.show', $item) }}"
                                            class="px-3 py-1 text-xs font-semibold bg-gray-600 text-white rounded-lg">
                                            👁️ Detail
                                        </a>

                                        <a href="{{ route('admin.posko.edit', $item) }}"
                                            class="px-3 py-1 text-xs font-semibold bg-gradient-to-r from-yellow-400 to-yellow-600 text-black rounded-lg">
                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('admin.posko.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus posko ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 text-xs font-semibold bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-400">
                                    Belum ada data posko.
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
