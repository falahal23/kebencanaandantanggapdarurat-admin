@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full px-3 mt-0">
            <div class="shadow-soft-xl relative flex flex-col bg-white border-0 rounded-2xl">

                {{-- Header --}}
                <div class="flex items-center justify-between p-6 pb-0">
                    <div>
                        <h6 class="text-lg font-semibold text-pink-600">Manajemen User</h6>
                        <p class="text-sm text-gray-500">
                            <i class="fa fa-users text-pink-400"></i> Data akun pengguna sistem
                        </p>
                    </div>
                    <a href="{{ route('user.create') }}"
                        class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                        <i class="fa fa-user-plus mr-2 text-lg"></i>
                        <span>✚ Tambah User</span>
                    </a>
                </div>
                <form method="GET" class="flex flex-wrap gap-3 items-center p-6 pt-0">

                    <div class="p-6">
                        <form action="{{ route('user.index') }}" method="GET"
                            class="flex flex-wrap items-center gap-2 mb-4">
                            {{-- Search --}}
                            <input type="text" name="search" placeholder="Cari nama atau email"
                                value="{{ request('search') }}"
                                class="border rounded px-3 py-2 text-sm flex-1 min-w-[200px]">

                            {{-- Tombol Cari --}}
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-black rounded-lg shadow hover:bg-blue-700 transition text-sm">
                                🔍
                            </button>

                            {{-- Tombol Reset --}}
                            @if (request()->has('search') && request('search') != '')
                                <a href="{{ route('user.index') }}"
                                    class="px-4 py-2 bg-gray-300 text-black-700 rounded-lg shadow hover:bg-gray-400 transition text-sm">
                                    ⟲
                                </a>
                            @endif
                        </form>

                    </div>


                    {{-- Notifikasi --}}
                    <div class="p-6">
                        @if (session('success'))
                            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    {{-- Tabel --}}
                    <div class="p-6 pt-0">
                        <div class="overflow-x-auto">
                            <table class="w-full mb-0 text-slate-600 border-collapse">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold uppercase">Email</th>
                                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Password</th>
                                        <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataUser as $user)
                                        <tr class="border-b">
                                            <td class="px-6 py-3 text-sm">{{ $user->name }}</td>
                                            <td class="px-6 py-3 text-sm">{{ $user->email }}</td>
                                            <td class="px-6 py-3 text-sm">{{ $user->password }}</td>


                                            </td>
                                            <td class="px-0 py-0 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="inline-block px-3 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                                        <i class="bi bi-pencil-square"></i>✏️Edit
                                                    </a>
                                            </td>

                                            {{-- Tombol Hapus --}}
                                            <td class="px-0 py-0 text-center">
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-block px-3 py-2 text-white bg-gradient-to-r from-red-600 to-Rose-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                                        <i class="bi bi-trash"></i>🗑️Hapus
                                                    </button>
                                                </form>
                                            </td>
                        </div>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-sm text-gray-500">
                                Belum ada data user.
                            </td>
                        </tr>
                        @endforelse
                        </tbody>
                        </table>
                    </div>
            </div>
           <div class="mt-6 flex justify-center">
                        {{ $dataUser->links() }}
                    </div>
        </div>
    </div>
    </div>
@endsection
