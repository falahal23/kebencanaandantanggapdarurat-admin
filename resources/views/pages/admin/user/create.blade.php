@extends('layouts.admin.app') {{-- Sesuaikan dengan layout utama kamu --}}

@section('title', 'Tambah User')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-pink-600 mb-6">➕ Tambah User Baru</h2>

        {{-- Notifikasi Error atau Success --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            {{-- Input Nama --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border border-pink-300 rounded-lg px-4 py-2 focus:ring focus:outline-none"
                    placeholder="Masukkan nama lengkap">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Email --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-pink-300 rounded-lg px-4 py-2 focus:ring focus:outline-none"
                    placeholder="Masukkan email">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password"
                    class="w-full border border-pink-300 rounded-lg px-4 py-2 focus:ring focus:outline-none"
                    placeholder="Masukkan password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full border border-pink-300 rounded-lg px-4 py-2 focus:ring focus:outline-none"
                    placeholder="Ulangi password">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('user.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">⬅ Kembali</a>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85
                        hover:scale-102 tracking-tight-soft bg-x-25">💾Simpan
                        Data </button>

                </div>
        </form>
    </div>
@endsection
