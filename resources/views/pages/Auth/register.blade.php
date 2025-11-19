@extends('layouts.admin.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ✅ ERROR REGISTER --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif

    {{-- ✅ SUCCESS REGISTER --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
        <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Register User Baru</h2>

            <!-- Flash message sukses -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Flash message error -->
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan nama">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan email">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan password">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Ulangi password">
                </div>

                <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 px-4 rounded font-semibold transition-colors">
                    Daftar
                </button>

                <p class="text-center text-gray-500 mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-pink-500 hover:underline">Login di sini</a>
                </p>
            </form>
        </div>
    @endsection
