@extends('layouts.admin.app')

@section('title', 'Daftar Donasi Bencana')

@section('content')
    <div class="container mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Daftar Donasi Bencana</h1>
            <a href="{{ route('admin.donasi.create') }}"
                class="inline-block px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-semibold shadow hover:shadow-lg transition">
                <i class="fa fa-plus mr-1"></i> Tambah Donasi
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabel Donasi --}}
        <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600 border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 whitespace-nowrap">ID</th>
                        <th class="px-4 py-2 whitespace-nowrap">Donatur</th>
                        <th class="px-4 py-2 whitespace-nowrap">Jenis</th>
                        <th class="px-4 py-2 whitespace-nowrap">Nilai</th>
                        <th class="px-4 py-2 whitespace-nowrap">Kejadian</th>
                        <th class="px-4 py-2 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($donasi as $d)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $d->donasi_id }}</td>
                            <td class="px-4 py-2">{{ $d->donatur_nama }}</td>
                            <td class="px-4 py-2">{{ $d->jenis }}</td>
                            <td class="px-4 py-2">{{ number_format($d->nilai, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if ($d->kejadian)
                                    {{ $d->kejadian->jenis_bencana }} |
                                    {{ $d->kejadian->lokasi_text }} |
                                    {{ \Carbon\Carbon::parse($d->kejadian->tanggal)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>

                                <td class="px-4 py-3 text-center">
                                        <div class="flex flex-row justify-center items-center gap-1.5">

                                            {{-- Tombol Lihat Detail (Warna Netral/Gray) --}}
                                            <a href="{{ route('admin.donasi.show', $d->donasi_id) }}"
                                                class="px-2 py-1 text-xs text-white rounded-lg bg-gray-600 hover:bg-gray-700 transition font-semibold shadow-md whitespace-nowrap">
                                                🔍 Detail
                                            </a>

                                            {{-- Tombol Edit (Warna Primer/Indigo) --}}
                                            <a href="{{ route('admin.donasi.edit', $d->donasi_id) }}"
                                                class="px-2 py-1 text-xs text-black bg-indigo-500 hover:bg-blue-600 rounded-lg font-semibold shadow-md transition whitespace-nowrap">
                                                ✏️ Edit
                                            </a>

                                            {{-- Tombol Hapus (Warna Bahaya/Red) --}}
                                            <form action="{{ route('admin.donasi.destroy', $d->donasi_id) }}" method="POST"
                                                class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus donasi ini secara permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs text-black bg-red-600 hover:bg-red-700 rounded-lg font-semibold shadow-md transition whitespace-nowrap">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data donasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $donasi->links() }}
            </div>
        </div>

    </div>
@endsection
