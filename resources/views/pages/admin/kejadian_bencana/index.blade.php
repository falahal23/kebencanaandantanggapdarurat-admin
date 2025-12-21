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
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Kejadian Bencana</h2>
                    <p class="text-sm text-gray-500">Data Kejadian Bencana Terbaru</p>
                </div>

                <a href="{{ route('kejadian.create') }}"
                    class="px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow">
                    + Tambah Kejadian
                </a>
            </div>

            {{-- TABLE --}}
            <div class="p-6 overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700 border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Jenis</th>
                            <th class="px-4 py-3 font-semibold">Tanggal</th>
                            <th class="px-4 py-3 font-semibold">Lokasi</th>
                            <th class="px-4 py-3 text-center font-semibold">Dampak</th>
                            <th class="px-4 py-3 text-center font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold">Keterangan</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($kejadian as $item)
                            <tr class="hover:bg-blue-50/30 transition">

                                <td class="p-4 font-semibold">
                                    {{ $item->jenis_bencana }}
                                </td>

                                <td class="p-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </td>

                                <td class="p-4">
                                    <div class="font-medium">{{ $item->lokasi_text }}</div>
                                    <div class="text-xs text-gray-500">
                                        (RT {{ $item->rt }}/RW {{ $item->rw }})
                                    </div>
                                </td>

                                <td class="p-4 text-center font-semibold">
                                    {{ $item->dampak }}
                                </td>

                                <td class="p-4 text-center">
                                    {{ $item->status_kejadian }}
                                </td>

                                <td class="p-4 text-xs text-gray-600 max-w-xs">
                                    {{ $item->keterangan ?? '-' }}
                                </td>

                                {{-- AKSI --}}
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="flex flex-row gap-2 justify-center items-center">

                                        <a href="{{ route('kejadian.show', $item->kejadian_id) }}"
                                            class="px-3 py-1.5 text-xs font-semibold text-white bg-gray-600 rounded-md hover:bg-gray-700 transition">
                                            👁️ Detail
                                        </a>

                                        <a href="{{ route('kejadian.edit', $item->kejadian_id) }}"
                                            class="px-3 py-1.5 text-xs font-semibold text-black bg-blue-100 rounded-md">
                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('kejadian.destroy', $item->kejadian_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-semibold text-black bg-blue-100 rounded-md">
                                                🗑️ Hapus
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
                    <a href="{{ $kejadian->url(1) }}" class="px-4 py-2 rounded-lg font-bold" style="background:#e0e0e0">1</a>
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
