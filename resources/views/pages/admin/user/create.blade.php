@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-pink-600 mb-6">Tambah User Baru</h2>

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

        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
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

            {{-- Upload Foto Profil --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-medium">Foto Profil (Optional)</label>
                <input type="file" name="profile_picture"
                    class="w-full border border-pink-300 rounded-lg px-4 py-2 bg-white focus:ring focus:outline-none">
                @error('profile_picture')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilih Role --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-medium">Role</label>
                <select name="role"
                    class="w-full border border-pink-300 rounded-lg px-4 py-2 focus:ring focus:outline-none">
                    <option value="">-- Pilih Role --</option>
                    <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('user.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    ⬅ Kembali
                </a>

                <button type="submit"
                    class="inline-block px-6 py-3 font-bold text-white rounded-lg bg-gradient-to-r from-pink-600 to-pink-400 shadow-md hover:shadow-lg hover:scale-105 transition">
                    💾 Simpan Data
                </button>
            </div>
        </form>
    </div>
@endsection
