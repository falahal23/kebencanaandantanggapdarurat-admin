@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <!-- Card Logistik Bencana -->
        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">

                <!-- Header Card -->
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                    <div class="flex flex-wrap mt-0 -mx-3 justify-between items-center">
                        <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                            <h6>Logistik Bencana</h6>
                            <p class="mb-0 text-sm leading-normal">
                                <i class="fa fa-check text-cyan-500"></i>
                                Semua data logistik terdaftar
                            </p>
                        </div>

                        <!-- Tombol Tambah -->
                        <div class="flex-none w-5/12 max-w-full px-3 text-right">
                            <a href="{{ route('admin.logistik_bencana.create') }}"
                                class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                <i class="fa fa-plus mr-1"></i>Tambah Data Logistik
                            </a>
                        </div>
                    </div>
                    <form method="GET" class="flex flex-wrap gap-2 items-center mb-4 mx-6">

                        <!-- Search -->
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama barang atau sumber" class="px-3 py-2 border rounded-lg text-sm">

                        <!-- Filter Kejadian -->
                        <select name="kejadian_id" class="px-3 py-2 border rounded-lg text-sm">
                            <option value="">Semua Kejadian</option>
                            @foreach ($kejadians as $kejadian)
                                <option value="{{ $kejadian->id }}"
                                    {{ request('kejadian_id') == $kejadian->id ? 'selected' : '' }}>
                                    {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Submit -->
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-black rounded-lg text-sm hover:bg-blue-500 transition">
                            🔍
                        </button>

                        <!-- Reset -->
                        @if (request()->has('search') && request('search') != '')
                            <a href="{{ route('logistik.index') }}"
                                class="w-12 h-12 flex items-center justify-center text-xl font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition duration-150">
                                ⟲
                            </a>
                        @endif
                    </form>

                </div>



                <!-- Body Card -->
                <div class="flex-auto p-6 px-0 pb-2">

                    <!-- Pesan Sukses -->
                    @if (session('success'))
                        <div class="mb-4 mx-6 p-3 rounded-lg bg-green-100 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table Logistik -->
                    <div class="overflow-x-auto mx-6">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">No</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Nama Barang
                                    </th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Satuan</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Stok</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Sumber</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Kejadian
                                    </th>
                                    <th class="px-10 py-3 font-bold text-center uppercase text-xxs text-slate-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logistik as $item)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">
                                                {{ $logistik->firstItem() + $loop->index }}
                                            </span>
                                        </td>


                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->nama_barang }}</span>
                                        </td>


                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->satuan }}</span>
                                        </td>

                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->stok }}</span>
                                        </td>

                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->sumber ?? '-' }}</span>
                                        </td>

                                        {{-- Data Kejadian --}}
                                        <td class="px-4 py-2">
                                            @if ($item->kejadian)
                                                {{ $item->kejadian->jenis_bencana }} |
                                                {{ $item->kejadian->lokasi_text }} |
                                                {{ \Carbon\Carbon::parse($item->kejadian->tanggal)->format('d M Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>



                                        <!-- Aksi -->

                                        <td class="p-2 text-center align-middle border-b whitespace-nowrap">
                                            <div class="flex justify-center space-x-2">

                                                <a href="{{ route('admin.logistik_bencana.edit', $item) }}"
                                                    class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                                                    ✏️ Edit
                                                </a>
                                                {{-- tombol lihat --}}

                                                <a href="{{ route('admin.logistik_bencana.show', $item) }}"
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-500 text-black text-xs font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-purple-700 hover:to-pink-600 transition-all duration-200 ease-in-out">
                                                    <i class="fa fa-eye mr-1"></i>Lihat
                                                </a>


                                                <form action="{{ route('admin.logistik_bencana.destroy', $item) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data logistik ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="inline-block px-4 py-2 text-white bg-gradient-to-r from-red-600 to-rose-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-slate-400 text-xs py-4">
                                            Belum ada data logistik.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6" style="display: flex; justify-content: center; align-items: center; gap: 10px;">

                        {{-- Previous --}}
                        @if ($logistik->onFirstPage())
                            <span
                                style="
                padding: 10px 20px;
                border-radius: 10px;
                background: #C40BB2;
                color: white;
                font-weight: bold;
                opacity: 0.5;
                cursor: not-allowed;
                margin-right: 20px; /* Jarak dari nomor halaman */
            ">
                                ‹ Previous
                            </span>
                        @else
                            <a href="{{ $logistik->previousPageUrl() }}"
                                style="
                padding: 10px 20px;
                border-radius: 10px;
                background: #C40BB2;
                color: white;
                font-weight: bold;
                text-decoration: none;
                margin-right: 20px; /* Jarak dari nomor halaman */
            ">
                                ‹ Previous
                            </a>
                        @endif


                        {{-- NOMOR HALAMAN --}}
                        @foreach ($logistik->getUrlRange(1, $logistik->lastPage()) as $page => $url)
                            @if ($page == $logistik->currentPage())
                                <span
                                    style="
                    padding: 10px 15px;
                    background: #333; /* Warna untuk halaman aktif */
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
                    background: #e0e0e0; /* Warna untuk halaman tidak aktif */
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
                        @if ($logistik->hasMorePages())
                            <a href="{{ $logistik->nextPageUrl() }}"
                                style="
                padding: 10px 20px;
                border-radius: 10px;
                background: #669be6; /* Warna biru Next */
                color: white;
                font-weight: bold;
                text-decoration: none;
                margin-left: 20px; /* Jarak dari nomor halaman */
            ">
                                Next ›
                            </a>
                        @else
                            <span
                                style="
                padding: 10px 20px;
                border-radius: 10px;
                background: #669be6; /* Warna biru Next */
                color: white;
                font-weight: bold;
                opacity: 0.5;
                cursor: not-allowed;
                margin-left: 20px; /* Jarak dari nomor halaman */
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
