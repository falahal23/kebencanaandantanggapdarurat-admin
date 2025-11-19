@extends('layouts.admin.app')
@section('content')

    <body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
        <main class="ease-soft-in-out xl:ml-100 relative h-full max-h-screen rounded-xl transition-all duration-200">
            <div class="w-full px-6 py-6 mx-auto">

                <!-- Kotak Sambutan -->
                <div id="welcome-box" class="max-w-2xl mx-auto mt-8 mb-6 p-6 rounded-2xl shadow-md animate-fade-in"
                    style="background-color: #e0f0ff; border-left: 6px solid #001f3f;">
                    <h2 id="welcome-message" class="text-lg font-semibold" style="color: #555;"></h2>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const userName = "{{ Auth::user()->name ?? 'Pengguna' }}";
                        const greetings = [
                            `👋 Halo ${name}, selamat datang kembali!`,
                            `✨ Selamat datang, ${name}! Semoga harimu menyenangkan.`,
                            `🌤️ Hai ${name}, semoga aktivitasmu berjalan lancar.`,
                            `💼 Halo ${name}, siap produktif hari ini?`
                        ];

                        const randomGreeting = greetings[Math.floor(Math.random() * greetings.length)];
                        const messageEl = document.getElementById("welcome-message");
                        const box = document.getElementById("welcome-box");
                        messageEl.textContent = "";

                        // efek ketik
                        let i = 0;

                        function typeEffect() {
                            if (i < randomGreeting.length) {
                                messageEl.textContent += randomGreeting.charAt(i);
                                i++;
                                setTimeout(typeEffect, 40);
                            } else {
                                // setelah selesai ketik, tunggu 5 detik, lalu hilang
                                setTimeout(() => {
                                    box.classList.add("fade-out");
                                    setTimeout(() => box.style.display = "none", 1000); // hapus setelah animasi
                                }, 5000);
                            }
                        }
                        typeEffect();
                    });
                </script>

                <style>
                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(-10px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    @keyframes fadeOut {
                        from {
                            opacity: 1;
                            transform: translateY(0);
                        }

                        to {
                            opacity: 0;
                            transform: translateY(-10px);
                        }
                    }

                    .animate-fade-in {
                        animation: fadeIn 1s ease-in-out;
                    }

                    .fade-out {
                        animation: fadeOut 1s ease-in-out forwards;
                    }
                </style>

                <!-- row 1 -->
                <div class="flex flex-wrap -mx-3">
                    <!-- card1 -->
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Kejadian
                                            </p>
                                            <h5 class="mb-0 font-bold">
                                                {{ $totalKejadian }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div
                                            class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-red-500 to-orange-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 m-auto mt-2.5 text-white"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                            </svg>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- card2 -->
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Kejadian Aktif
                                            </p>
                                            <h5 class="mb-0 font-bold">
                                                {{ $kejadianAktif }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div
                                            class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-600 to-lime-500">
                                            <i class="ni ni-check-bold text-lg relative top-3.5 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- card3 -->
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Posko</p>
                                            <h5 class="mb-0 font-bold">
                                                {{ $totalPosko }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div
                                            class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-600 to-cyan-500">
                                            <i class="ni ni-building text-lg relative top-3.5 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- card4 -->
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border hover:shadow-lg transition-shadow duration-300">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3 items-center">

                                    <!-- Teks -->
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-1 font-sans text-sm font-semibold text-slate-600 leading-normal">
                                                Total Donasi</p>
                                            <h5 class="mb-0 font-bold text-slate-800">
                                                Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>

                                    <!-- Icon -->
                                    <div class="px-3 text-right basis-1/3">
                                        <div class="px-3 text-right basis-1/3">
                                            <div
                                                class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-yellow-400 to-amber-500 shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 m-auto mt-2.5"
                                                    viewBox="0 0 24 24" fill="#16a34a"> <!-- hijau uang -->
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 14.5v.5a1 1 0 1 1-2 0v-.5a3 3 0 0 1-2-2.83V13a1 1 0 1 1 2 0v.17c0 .46.34.83.76.83h.48c.42 0 .76-.37.76-.83v-.09c0-.4-.26-.74-.63-.86L10.5 12c-1.09-.36-1.75-1.34-1.75-2.58 0-1.49 1.13-2.66 2.75-2.92V6a1 1 0 1 1 2 0v.5a3.001 3.001 0 0 1 2.5 2.96 1 1 0 1 1-2 0c0-.55-.45-1-1-1h-.5c-.55 0-1 .45-1 1v.09c0 .4.26.74.63.86l1.63.55c1.09.36 1.75 1.34 1.75 2.58 0 1.49-1.13 2.66-2.75 2.92z" />
                                                </svg>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="flex flex-wrap -mx-3 mt-4">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Stok Logistik
                                            </p>
                                            <h5 class="mb-0 font-bold">
                                                {{ $totalLogistik }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div
                                            class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-500 to-cyan-400 shadow-md">
                                            <i class="ni ni-box-2 text-lg relative top-3.5 text-yellow-300"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Stok</p>
                                            <h5 class="mb-0 font-bold">
                                                {{ $totalStokLogistik }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div
                                            class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-orange-500 to-amber-400 shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-7 h-7 m-auto mt-2.5 text-yellow-900" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M3 3h13a1 1 0 0 1 1 1v3h3a1 1 0 0 1 .8.4l3 4a1 1 0 0 1 .2.6V18a1 1 0 0 1-1 1h-2a3 3 0 1 1-6 0H9a3 3 0 1 1-6 0H1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm15 8V5H4v6h14zm-1 4a1 1 0 1 0 2 0h-2zm-10 0a1 1 0 1 0 2 0H7z" />
                                            </svg>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Distribusi
                                            </p>
                                            <h5 class="mb-0 font-bold">
                                                {{ $totalDistribusi }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div
                                            class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tr from-purple-500 to-pink-600 shadow-lg">
                                            <i class="ni ni-delivery-fast text-lg relative top-3.5 text-gray-900"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Penerima
                                            </p>
                                            <h5 class="mb-0 font-bold">
                                                {{ $totalPenerima }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div
                                            class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tr from-green-400 to-teal-600 shadow-lg">
                                            <i class="ni ni-single-02 text-lg relative top-3.5 text-gray-900"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- cards row 4 -->

                <div class="flex flex-wrap my-6 -mx-3">
                    <!-- card Kejadian Bencana -->
                    <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
                        <div
                            class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                                <div class="flex flex-wrap mt-0 -mx-3 justify-between items-center">
                                    <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                                        <h6>Kejadian Bencana</h6>
                                        <p class="mb-0 text-sm leading-normal">
                                            <i class="fa fa-check text-cyan-500"></i>
                                            Kejadian Bencana di Desa
                                            <span class="ml-1 font-semibold">TERBARU!</span>
                                        </p>
                                    </div>

                                    <!-- Tombol Tambah -->

                                </div>
                            </div>

                            <div class="flex-auto p-6 px-0 pb-2">
                                <div class="overflow-x-auto">
                                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                        <thead class="align-bottom bg-gray-100">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">
                                                    Jenis Bencana</th>
                                                <th
                                                    class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">
                                                    Tanggal</th>
                                                <th
                                                    class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">
                                                    Lokasi</th>
                                                <th
                                                    class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-600">
                                                    Dampak</th>
                                                <th
                                                    class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-600">
                                                    Status</th>


                                        </thead>
                                        <tbody>

                                            @foreach ($kejadian as $item)
                                                <tr>
                                                <tr>
                                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                                        <h6 class="mb-0 text-sm">{{ $item->jenis_bencana }}</h6>
                                                    </td>
                                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                                        <span
                                                            class="text-xs font-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                                    </td>
                                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                                        <span class="text-xs font-semibold">
                                                            {{ $item->lokasi_text }} (RT {{ $item->rt }}/RW
                                                            {{ $item->rw }})
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                                        <span class="text-xs font-semibold">{{ $item->dampak }}</span>
                                                    </td>
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                                        <span
                                                            class="text-xs font-bold
                                            @if ($item->status_kejadian == 'Selesai') text-green-600
                                            @elseif($item->status_kejadian == 'Sedang Ditangani') text-yellow-600
                                            @else text-red-600 @endif">
                                                            {{ $item->status_kejadian }}
                                                        </span>
                                                    </td>

                                                    </form>
                                </div>
                                </td>

                                </tr>
                                @endforeach
                                </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        </main>
        <div fixed-plugin>
            <a fixed-plugin-button
                class="bottom-7.5 right-7.5 text-xl z-990 shadow-soft-lg rounded-circle fixed cursor-pointer bg-white px-4 py-2 text-slate-700">
                <i class="py-2 pointer-events-none fa fa-cog"> </i>
            </a>
            <!-- -right-90 in loc de 0-->
            <div fixed-plugin-card
                class="z-sticky shadow-soft-3xl w-90 ease-soft -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white bg-clip-border px-2.5 duration-200">
                <div class="px-6 pt-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <div class="float-left">
                        <h5 class="mt-4 mb-0">Soft UI Configurator</h5>
                        <p>See our dashboard options.</p>
                    </div>
                    <div class="float-right mt-6">
                        <button fixed-plugin-close-button
                            class="inline-block p-0 mb-4 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 active:opacity-85 text-slate-700">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <!-- End Toggle Button -->
                </div>
                <hr class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                <div class="flex-auto p-6 pt-0 sm:pt-4">
                    <!-- Sidebar Backgrounds -->
                    <div>
                        <h6 class="mb-0">Sidebar Colors</h6>
                    </div>
                    <a href="javascript:void(0)">
                        <div class="my-2 text-left" sidenav-colors>
                            <span
                                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-purple-700 to-pink-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                                active-color data-color-from="purple-700" data-color-to="pink-500"
                                onclick="sidebarColor(this)"></span>
                            <span
                                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-gray-900 to-slate-800 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                                data-color-from="gray-900" data-color-to="slate-800" onclick="sidebarColor(this)"></span>
                            <span
                                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-blue-600 to-cyan-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                                data-color-from="blue-600" data-color-to="cyan-400" onclick="sidebarColor(this)"></span>
                            <span
                                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-green-600 to-lime-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                                data-color-from="green-600" data-color-to="lime-400" onclick="sidebarColor(this)"></span>
                            <span
                                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-500 to-yellow-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                                data-color-from="red-500" data-color-to="yellow-400" onclick="sidebarColor(this)"></span>
                            <span
                                class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-600 to-rose-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                                data-color-from="red-600" data-color-to="rose-400" onclick="sidebarColor(this)"></span>
                        </div>
                    </a>
                    <!-- Sidenav Type -->
                    <div class="mt-4">
                        <h6 class="mb-0">Sidenav Type</h6>
                        <p class="text-sm leading-normal">
                            Choose between 2 different sidenav types.
                        </p>
                    </div>
                    <div class="flex">
                        <button transparent-style-btn
                            class="inline-block w-full px-4 py-3 mb-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border border-transparent border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500 bg-fuchsia-500 hover:border-fuchsia-500"
                            data-class="bg-transparent" active-style>
                            Transparent
                        </button>
                        <button white-style-btn
                            class="inline-block w-full px-4 py-3 mb-2 ml-2 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
                            data-class="bg-white">
                            White
                        </button>
                    </div>
                    <p class="block mt-2 text-sm leading-normal xl:hidden">
                        You can change the sidenav type just on desktop view.
                    </p>
                    <!-- Navbar Fixed -->
                    <div class="mt-4">
                        <h6 class="mb-0">Navbar Fixed</h6>
                    </div>
                    <div class="min-h-6 mb-0.5 block pl-0">
                        <input navbarFixed
                            class="rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                            type="checkbox" />
                    </div>
                    <hr
                        class="h-px bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent sm:my-6" />

                    <a class="inline-block w-full px-6 py-3 mb-4 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none"
                        href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/soft-ui-dashboard/"
                        target="_blank">View documentation</a>
                    <div class="w-full text-center">
                        <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard-tailwind"
                            data-icon="octicon-star" data-size="large" data-show-count="true"
                            aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
                        <h6 class="mt-4">Thank you for sharing!</h6>
                        <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20Tailwind%20made%20by%20%40CreativeTim&hashtags=webdesign,dashboard,tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard-tailwind"
                            class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
                            target="_blank">
                            <i class="mr-1 fab fa-twitter"></i> Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard-tailwind"
                            class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
                            target="_blank">
                            <i class="mr-1 fab fa-facebook-square"></i> Share
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
