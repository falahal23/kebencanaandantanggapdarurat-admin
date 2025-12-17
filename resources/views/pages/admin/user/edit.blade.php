@extends('layouts.admin.app')

@section('content')
    <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:w-12/12">
            <div class="border-black/12.5 shadow-soft-xl relative flex flex-col break-words bg-white rounded-2xl">

                <!-- Header -->
                <div class="border-b border-gray-200 p-6 flex justify-between items-center">
                    <h6 class="text-lg font-semibold">🖊️Edit User</h6>
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Nama User</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                    placeholder="Masukkan nama user" required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                    placeholder="Masukkan email" required>
                            </div>

                            <!-- Foto Profil -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Foto Profil</label>

                                <img src="{{ $user->profile_picture
                                    ? asset('storage/' . $user->profile_picture)
                                    : asset('assets-admin/img/placeholder_user.png') }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets-admin/img/placeholder_user.png') }}';"
                                    class="w-20 h-20 object-cover rounded-full mb-3 border">

                                <input type="file" name="profile_picture"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300">

                                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                            </div>



                            <!-- Password -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Password Baru (Opsional)</label>
                                <input type="password" name="password"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <!-- Password Confirmation -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                    placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Role User</label>
                            <select name="role" class="w-full p-2 border rounded-lg focus:ring focus:ring-pink-300"
                                required>
                                <option value="">-- Pilih Role --</option>
                                <option value="Super Admin"
                                    {{ old('role', $user->role) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="User" {{ old('role', $user->role) == 'User' ? 'selected' : '' }}>User
                                </option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
