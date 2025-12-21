@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12">
            <div class="border-black/12.5 shadow-soft-xl relative flex flex-col break-words bg-white rounded-2xl">

                <!-- Header -->
                <div class="border-b border-gray-200 p-6 flex justify-between items-center">
                    <h3 class="text-2xl font-bold tracking-wide">
                        🖊️ Edit User
                    </h3>

                    <a href="{{ route('user.index') }}"
                        class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                        Kembali
                    </a>
                </div>


                <!-- Body Form -->
                <div class="p-6">
                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="list-disc pl-5 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Alert Success / Error --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            ✅ {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                            ❌ {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Nama -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Nama User</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300" required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300" required>
                            </div>

                            <!-- Foto Profil (full width) -->
                            <div class="md:col-span-2">
                                <label class="block mb-2 font-medium">Upload Foto (opsional)</label>
                                <div class="flex gap-3 items-center">
                                    <!-- Preview foto kecil -->
                                    <img src="{{ asset('assets-admin/img/slideshow/placeholder_user.png') }}"
                                        class="w-16 h-16 rounded-full border object-cover" alt="Avatar">

                                    <!-- Input file lebih ringkas -->
                                    <input type="file" name="profile_picture"
                                        class="text-sm file:text-smfile:px-3 file:py-1file:rounded-md file:borderfile:bg-gray-100 file:hover:bg-gray-200">
                                </div>
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Password Baru</label>
                                <input type="password" name="password"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                    placeholder="Ulangi password">
                            </div>

                            <!-- Role -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Role User</label>
                                <select name="role" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                    required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Super Admin" {{ $user->role == 'Super Admin' ? 'selected' : '' }}>Super
                                        Admin</option>
                                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>

                            <!-- Tombol -->
                            <div class="flex items-end justify-end">
                                <button type="submit"
                                    class="px-6 py-3 text-xs font-bold text-white rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-105 transition">
                                    Update User
                                </button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
