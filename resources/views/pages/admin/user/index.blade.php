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
                        <span>Tambah User</span>
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
                            <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin
                            </option>
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
                                                <img src="{{ Storage::url($user->profile_picture) }}"
                                                    class="w-12 h-12 rounded-full object-cover shadow" alt="Foto Profil">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
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
                                                <a href="{{ route('admin.user.show', $user) }}"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-white bg-slate-600 rounded-lg hover:bg-slate-700 transition">
                                                    <i class="fa fa-eye"></i>
                                                    Detail
                                                </a>
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="px-3 py-1.5 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition shadow">
                                                    ✏️ Edit
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-100 rounded-lg hover:bg-red-200 transition">
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

                {{-- Pagination Data User --}}
                <div class="w-full flex justify-center items-center gap-3 py-8 flex-wrap">

                    {{-- Previous --}}
                    @if ($dataUser->onFirstPage())
                        <span class="px-4 py-2 rounded-lg font-bold text-white opacity-50 cursor-not-allowed"
                            style="background:#C40BB2">
                            ‹ Prev
                        </span>
                    @else
                        <a href="{{ $dataUser->previousPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                            style="background:#C40BB2; text-decoration:none;">
                            ‹ Prev
                        </a>
                    @endif

                    {{-- Pagination Logic --}}
                    @php
                        $start = max($dataUser->currentPage() - 2, 1);
                        $end = min($dataUser->currentPage() + 2, $dataUser->lastPage());
                    @endphp

                    {{-- First Page --}}
                    @if ($start > 1)
                        <a href="{{ $dataUser->url(1) }}" class="px-4 py-2 rounded-lg font-bold"
                            style="background:#e0e0e0; text-decoration:none;">
                            1
                        </a>
                        <span class="px-2 font-bold">...</span>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($dataUser->getUrlRange($start, $end) as $page => $url)
                        @if ($page == $dataUser->currentPage())
                            <span class="px-4 py-2 rounded-lg font-bold text-white" style="background:#333">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg font-bold"
                                style="background:#e0e0e0; text-decoration:none;">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Last Page --}}
                    @if ($end < $dataUser->lastPage())
                        <span class="px-2 font-bold">...</span>
                        <a href="{{ $dataUser->url($dataUser->lastPage()) }}" class="px-4 py-2 rounded-lg font-bold"
                            style="background:#e0e0e0; text-decoration:none;">
                            {{ $dataUser->lastPage() }}
                        </a>
                    @endif

                    {{-- Next --}}
                    @if ($dataUser->hasMorePages())
                        <a href="{{ $dataUser->nextPageUrl() }}" class="px-4 py-2 rounded-lg font-bold text-white"
                            style="background:#669be6; text-decoration:none;">
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
    </div>
@endsection
