@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 px-6">
        <!-- Card Posko Bencana -->
<div class="w-full max-w-full px-8 mt-0 lg:w-12/12 lg:flex-none">
            <div class="flex flex-wrap my-6 mx-6"
class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 bg-white bg-clip-border p-6"

                {{-- <!-- Header Card --> --}}
                 class="border-black/12.5 mb-0 rounded-t-2xl bg-white p-6 pb-0">

                    <div class="flex flex-wrap -mx-3 justify-between items-center">
                        <div class="flex-none w-7/12 px-3 lg:w-1/2">
                            <h6>Posko Bencana</h6>
                            <p class="mb-0 text-sm">
                                <i class="fa fa-check text-cyan-500"></i>
                                Semua data posko bencana terdaftar
                            </p>
                        </div>

                        <!-- Tombol Tambah -->
                        <div class="flex-none w-5/12 px-3 text-right">
                            <a href="{{ route('admin.posko.create') }}"
                                class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                <i class="fa fa-plus mr-1"></i> ✚ Tambah Posko
                            </a>
                        </div>
                    </div>

                    <!-- SEARCH & FILTER -->
                    <form action="{{ route('posko.index') }}" method="GET"
                        class="mt-6 bg-white px-4 py-4 rounded-lg shadow flex flex-wrap items-center gap-3">

                        <!-- Input Pencarian -->
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="flex-1 p-2 border rounded-lg" placeholder="Cari nama, alamat, dll...">

                        <!-- Filter Alamat -->
                        <select name="alamat" class="p-2 border rounded-lg">
                            <option value="">Semua Alamat</option>
                            @foreach ($alamatList as $alamat)
                                <option value="{{ $alamat }}" {{ request('alamat') == $alamat ? 'selected' : '' }}>
                                    {{ $alamat }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Tombol Search -->
                        <button type="submit"
                            class="px-4 py-2 bg-gray-700 text-white rounded-lg text-lg shadow hover:bg-gray-800">
                            🔍
                        </button>

                        <!-- Tombol Reset -->
                        @if (request()->filled('search'))
                            <a href="{{ route('posko.index') }}"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg shadow hover:bg-gray-400">
                                ⟲
                            </a>
                        @endif
                    </form>
                </>

                <!-- Body Card -->
                <div class="flex-auto p-6 px-0 pb-2">

                    <!-- Pesan Sukses -->
                    @if (session('success'))
                        <div class="mb-4 mx-6 p-3 rounded-lg bg-green-100 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="overflow-x-auto mx-6">
                        <table class="items-center w-full mb-0 border-gray-200 text-slate-500">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left font-bold uppercase text-xxs">No</th>
                                    <th class="px-6 py-3 text-left font-bold uppercase text-xxs">Nama Posko</th>
                                    <th class="px-6 py-3 text-left font-bold uppercase text-xxs">Alamat</th>
                                    <th class="px-6 py-3 text-left font-bold uppercase text-xxs">Kontak</th>
                                    <th class="px-6 py-3 text-left font-bold uppercase text-xxs">Penanggung Jawab</th>
                                    <th class="px-10 py-3 text-center font-bold uppercase text-xxs">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($posko as $item)
                                    <tr>
                                        <td class="p-2 border-b text-xs">
                                            {{ $posko->firstItem() + $loop->index }}
                                        </td>

                                        <td class="p-2 border-b text-xs">{{ $item->nama }}</td>
                                        <td class="p-2 border-b text-xs">{{ $item->alamat }}</td>
                                        <td class="p-2 border-b text-xs">{{ $item->kontak ?? '-' }}</td>
                                        <td class="p-2 border-b text-xs">{{ $item->penanggung_jawab ?? '-' }}</td>

                                        <td class="p-2 border-b text-center">
                                            <div class="flex justify-center space-x-2">

                                                <a href="{{ route('admin.posko.edit', $item) }}"
                                                    class="px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-xs font-semibold shadow hover:shadow-lg">
                                                    ✏️ Edit
                                                </a>

                                                <form action="{{ route('admin.posko.destroy', $item) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus posko ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-rose-400 rounded-lg text-xs font-semibold shadow hover:shadow-lg">
                                                        🗑️ Hapus
                                                    </button>

                                                    <a href="{{ route('admin.posko.show', $item) }}"
                                                        class="px-2 py-1 font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700">
                                                        👁️ Lihat Detail
                                                    </a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-slate-400 text-xs py-4">
                                            Belum ada data posko.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="w-full flex justify-center items-center gap-3 py-10">

                        {{-- Previous --}}
                        @if ($posko->onFirstPage())
                            <span
                                style="
                            padding: 10px 20px;
                            border-radius: 10px;
                            background: #C40BB2;
                            color: white;
                            font-weight: bold;
                            opacity: 0.5;
                            cursor: not-allowed;
                        ">
                                ‹ Previous
                            </span>
                        @else
                            <a href="{{ $posko->previousPageUrl() }}"
                                style="
                            padding: 10px 20px;
                            border-radius: 10px;
                            background: #C40BB2;
                            color: white;
                            font-weight: bold;
                            text-decoration: none;
                        ">
                                ‹ Previous
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($posko->getUrlRange(1, $posko->lastPage()) as $page => $url)
                            @if ($page == $posko->currentPage())
                                <span
                                    style="
                                padding: 10px 15px;
                                background: #333;
                                color: white;
                                border-radius: 10px;
                                font-weight: bold;
                            ">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    style="
                                padding: 10px 15px;
                                background: #e0e0e0;
                                color: #333;
                                border-radius: 10px;
                                font-weight: bold;
                                text-decoration: none;
                            ">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($posko->hasMorePages())
                            <a href="{{ $posko->nextPageUrl() }}"
                                style="
                            padding: 10px 20px;
                            border-radius: 10px;
                            background: #669be6;
                            color: white;
                            font-weight: bold;
                            text-decoration: none;
                        ">
                                Next ›
                            </a>
                        @else
                            <span
                                style="
                            padding: 10px 20px;
                            border-radius: 10px;
                            background: #669be6;
                            color: white;
                            font-weight: bold;
                            opacity: 0.5;
                            cursor: not-allowed;
                        ">
                                Next ›
                            </span>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
