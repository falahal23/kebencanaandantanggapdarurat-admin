@extends('layouts.admin.app')

@section('title', 'Detail User')

@section('content')
    <div class="max-w-7xl mx-auto bg-white shadow-2xl rounded-3xl p-12">

        <!-- HEADER -->
        <div class="relative mb-12">

            <!-- Background Header -->
            <div
                class="absolute inset-0 rounded-3xl
                   bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-800
                   shadow-xl">
            </div>

            <div class="relative p-10 flex items-center justify-between text-white">
                <div>
                    <h2 class="text-4xl font-extrabold tracking-tight text-black">
                        Detail User
                    </h2>
                    <p class="text-base opacity-90 mt-2">
                        Informasi lengkap akun pengguna sistem
                    </p>
                </div>

                <span
                    class="px-6 py-2 text-sm font-semibold
                       bg-white/10 backdrop-blur
                       rounded-full border border-white/20">
                    User Profile
                </span>
            </div>
        </div>

        <!-- BODY -->
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-12">

            <!-- FOTO PROFIL -->
            <div class="flex flex-col items-center">
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                        class="w-56 h-56 rounded-full object-cover
                            border-4 border-indigo-800 shadow-xl">
                @else
                    <div
                        class="w-56 h-56 rounded-full flex items-center justify-center
                           bg-gradient-to-br from-indigo-100 to-purple-100
                           text-indigo-900 text-7xl font-extrabold shadow-xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <p class="mt-5 text-sm text-gray-500 tracking-wide">
                    Foto Profil Pengguna
                </p>
            </div>

            <!-- DATA USER -->
            <div class="xl:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Nama -->
                    <div>
                        <label class="text-sm font-semibold text-gray-600">
                            Nama Lengkap
                        </label>
                        <div
                            class="mt-2 px-6 py-4 text-lg
                               border border-gray-200 rounded-xl bg-gray-50">
                            {{ $user->name }}
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-semibold text-gray-600">
                            Email
                        </label>
                        <div
                            class="mt-2 px-6 py-4 text-lg
                               border border-gray-200 rounded-xl bg-gray-50">
                            {{ $user->email }}
                        </div>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="text-sm font-semibold text-gray-600">
                            Role
                        </label>
                        <div class="mt-2">
                            <span
                                class="inline-flex items-center
                                   px-8 py-3 rounded-xl
                                   text-white text-base font-semibold
                                   shadow
                                   {{ $user->role == 'Super Admin'
                                       ? 'bg-gradient-to-r from-purple-900 to-indigo-800'
                                       : ($user->role == 'Admin'
                                           ? 'bg-slate-700'
                                           : 'bg-emerald-700') }}">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>

                    <!-- Tanggal Dibuat -->
                    <div>
                        <label class="text-sm font-semibold text-gray-600">
                            Dibuat Pada
                        </label>
                        <div
                            class="mt-2 px-6 py-4 text-lg
                               border border-gray-200 rounded-xl bg-gray-50">
                            {{ $user->created_at->format('d M Y H:i') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center mt-16">

            <a href="{{ route('user.index') }}"
                class="px-8 py-4 text-base font-semibold
                  bg-gray-200 rounded-xl
                  hover:bg-gray-300 transition">
                Kembali
            </a>

            <a href="{{ route('user.edit', $user->id) }}"
                class="px-10 py-4 text-base font-semibold text-white rounded-xl
                  bg-gradient-to-r from-indigo-900 to-purple-800
                  hover:shadow-xl hover:scale-105 transition">
                ✏️ Edit User
            </a>
        </div>

    </div>
@endsection
