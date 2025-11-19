@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <!-- Card Posko Bencana -->
        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">

                <!-- Header Card -->
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                    <div class="flex flex-wrap mt-0 -mx-3 justify-between items-center">
                        <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                            <h6>Posko Bencana</h6>
                            <p class="mb-0 text-sm leading-normal">
                                <i class="fa fa-check text-cyan-500"></i>
                                Semua data posko bencana terdaftar
                            </p>
                        </div>

                        <!-- Tombol Tambah -->
                        <div class="flex-none w-5/12 max-w-full px-3 text-right">
                            <a href="{{ route('admin.posko.create') }}"
                                class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                <i class="fa fa-plus mr-1"></i> Tambah Posko
                            </a>
                        </div>
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

                    <!-- Table Posko -->
                    <div class="overflow-x-auto mx-6">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">No</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Nama Posko
                                    </th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Alamat</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Kontak</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">Penanggung
                                        Jawab</th>
                                    <th class="px-10 py-3 font-bold text-center uppercase text-xxs text-slate-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posko as $index => $item)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $index + 1 }}</span>
                                        </td>

                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->nama }}</span>
                                        </td>

                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->alamat }}</span>
                                        </td>

                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->kontak ?? '-' }}</span>
                                        </td>

                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <span class="text-xs font-semibold">{{ $item->penanggung_jawab ?? '-' }}</span>
                                        </td>


                                        <!-- Aksi -->
                                        <td class="p-2 text-center align-middle border-b whitespace-nowrap">
                                            <div class="flex justify-center space-x-2">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('admin.posko.edit', $item) }}"
                                                    class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                                                    ✏️ Edit
                                                </a>
                                    

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('admin.posko.destroy', $item) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus posko ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-block px-4 py-2 text-white bg-gradient-to-r from-red-600 to-rose-400 rounded-lg text-xs font-semibold shadow-md hover:shadow-lg transition">
                                                        🗑️ Hapus
                                                    </button>

                                                    <a href="{{ route('admin.posko.show', $item) }}"
                                                    class="px-2 py-1 font-bold text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition">
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
                    <div class="flex justify-end mt-4 mx-6">
                        {{ $posko->links('pagination::tailwind') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
