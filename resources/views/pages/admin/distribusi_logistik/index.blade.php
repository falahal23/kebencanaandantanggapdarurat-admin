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
                                    <th class="px-6 py-3 text-left text-xxs font
                                    <th class="px-6 py-3 text-center text-xxs font-bold uppercase">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($distribusi as $index => $d)
                                    <tr class="border-b">
                                        <td class="px-6 py-3">
                                            <span class="text-xs font-semibold">{{ $index + 1 }}</span>
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
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                    <div class="mt-6 flex justify-center">
                    {{ $distribusi->links() }}
                </div>
                </div>
            </div>
        </div>
    @endsection
