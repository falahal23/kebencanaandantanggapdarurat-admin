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

                {{-- Pencarian --}}
                <div class="p-6">
                    <form action="{{ route('user.index') }}" method="GET" class="flex flex-wrap items-center gap-2 mb-4">
                        <input type="text" name="search" placeholder="Cari nama atau email"
                            value="{{ request('search') }}" class="border rounded px-3 py-2 text-sm flex-1 min-w-[200px]">

                        {{-- Filter Role --}}
                        <select name="role" class="border rounded px-3 py-2 text-sm">
                            <option value="">-- Semua Role --</option>
                            <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="User" {{ request('role') == 'User' ? 'selected' : '' }}>User</option>
                        </select>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition text-sm">
                            🔍
                        </button>

                        @if (request()->has('search') || request()->has('role'))
                            <a href="{{ route('user.index') }}"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg shadow hover:bg-gray-400 transition text-sm">
                                ⟲
                            </a>
                        @endif
                    </form>
                </div>

                {{-- Notifikasi --}}
                <div class="px-6">
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
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Foto</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase">Role</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase">Password</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataUser as $user)
                                    <tr class="border-b">
                                        {{-- FOTO PROFIL --}}
                                        <td class="px-6 py-3">
                                            @if ($user->profile_picture)
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                    class="w-12 h-12 rounded-full object-cover shadow" alt="Foto Profil">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                                    class="w-12 h-12 rounded-full object-cover shadow" alt="Avatar">
                                            @endif
                                        </td>

                                        {{-- NAMA --}}
                                        <td class="px-6 py-3 text-sm">
                                            {{ $user->name }}
                                        </td>

                                        {{-- EMAIL --}}
                                        <td class="px-6 py-3 text-sm">
                                            {{ $user->email }}
                                        </td>

                                        {{-- ROLE --}}
                                        <td class="px-6 py-3 text-sm text-center">
                                            {{ $user->role }}
                                        </td>

                                        {{-- PASSWORD --}}
                                        <td class="px-6 py-3 text-sm text-gray-400 text-center">
                                            *****
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="px-6 py-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="inline-block px-3 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow hover:shadow-lg transition">
                                                    ✏️ Edit
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-block px-3 py-2 text-white bg-gradient-to-r from-red-600 to-rose-400 rounded-lg text-sm font-semibold shadow hover:shadow-lg transition">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 text-center text-sm text-gray-500">
                                            Belum ada data user.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="mt-6" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                    {{-- Previous --}}
                    @if ($dataUser->onFirstPage())
                        <span
                            style="
                                padding: 10px 20px;
                                border-radius: 10px;
                                background: #C40BB2;
                                color: white;
                                font-weight: bold;
                                opacity: 0.5;
                                cursor: not-allowed;
                                margin-right: 20px;
                            ">
                            ‹ Previous
                        </span>
                    @else
                        <a href="{{ $dataUser->previousPageUrl() }}"
                            style="
                                padding: 10px 20px;
                                border-radius: 10px;
                                background: #C40BB2;
                                color: white;
                                font-weight: bold;
                                text-decoration: none;
                                margin-right: 20px;
                            ">
                            ‹ Previous
                        </a>
                    @endif

                    {{-- NOMOR HALAMAN --}}
                    @foreach ($dataUser->getUrlRange(1, $dataUser->lastPage()) as $page => $url)
                        @if ($page == $dataUser->currentPage())
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
                    @if ($dataUser->hasMorePages())
                        <a href="{{ $dataUser->nextPageUrl() }}"
                            style="
                                padding: 10px 20px;
                                border-radius: 10px;
                                background: #669be6;
                                color: white;
                                font-weight: bold;
                                text-decoration: none;
                                margin-left: 20px;
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
                                margin-left: 20px;
                            ">
                            Next ›
                        </span>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
