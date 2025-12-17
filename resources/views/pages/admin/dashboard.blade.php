@extends('layouts.admin.app')
@section('content')

    <body class="m-0 font-sans text-base antialiasing font-normal leading-default bg-gray-50 text-slate-500">
        <main class="ease-soft-in-out xl:ml-100 relative h-full max-h-screen rounded-xl transition-all duration-200">
            <div class="w-full px-6 py-6 mx-auto">

                {{-- <div id="welcome-box" class="max-w-2xl mx-auto mt-8 mb-6 p-6 rounded-2xl shadow-md animate-fade-in"
                    style="background-color: #e0f0ff; border-left: 6px solid #001f3f;">
                    <h2 id="welcome-message" class="text-lg font-semibold" style="color: #555;"></h2>
                </div> --}}

                {{-- <script>
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
                </script> --}}

                {{-- <style>
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
                </style> --}}

                <div class="flex flex-wrap -mx-3">
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

                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border hover:shadow-lg transition-shadow duration-300">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3 items-center">

                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-1 font-sans text-sm font-semibold text-slate-600 leading-normal">
                                                Total Donasi</p>
                                            <h5 class="mb-0 font-bold text-slate-800">
                                                Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="px-3 text-right basis-1/3">
                                        <div class="px-3 text-right basis-1/3">
                                            <div
                                                class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-yellow-400 to-amber-500 shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 m-auto mt-2.5"
                                                    viewBox="0 0 24 24" fill="#16a34a"> <path
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

                <div class="flex flex-wrap my-6 -mx-3">

                    <div class="w-full max-w-full px-3 mb-6 xl:mb-0 xl:w-1/2">
                        <div class="relative overflow-hidden rounded-2xl shadow-xl" style="height: 337px;">
                            {{-- Ubah width: 600px menjadi w-full, dan atur tinggi agar proporsional --}}
                            <div class="flex transition-transform duration-700 ease-in-out h-full" id="slideshow">
                                <img src="{{ asset('assets-admin/img/slideshow/bantuan1.jpg') }}"
                                    class="w-full h-full object-cover flex-shrink-0" style="min-width:100%">

                                <img src="{{ asset('assets-admin/img/slideshow/bantuan2.jpg') }}"
                                    class="w-full h-full object-cover flex-shrink-0" style="min-width:100%">

                                <img src="{{ asset('assets-admin/img/slideshow/distribusi1.jpg') }}"
                                    class="w-full h-full object-cover flex-shrink-0" style="min-width:100%">

                                <img src="{{ asset('assets-admin/img/slideshow/distribusi2.jpg') }}"
                                    class="w-full h-full object-cover flex-shrink-0" style="min-width:100%">

                                <img src="{{ asset('assets-admin/img/slideshow/relawan1.jpg') }}"
                                    class="w-full h-full object-cover flex-shrink-0" style="min-width:100%">

                                <img src="{{ asset('assets-admin/img/slideshow/relawan2.jpg') }}"
                                    class="w-full h-full object-cover flex-shrink-0" style="min-width:100%">
                            </div>

                            <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-3">
                                <span
                                    class="slide-indicator w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
                                <span
                                    class="slide-indicator w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
                                <span
                                    class="slide-indicator w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
                                <span
                                    class="slide-indicator w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
                                <span
                                    class="slide-indicator w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
                                <span
                                    class="slide-indicator w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
                            </div>

                            <button id="prevSlide"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 backdrop-blur-sm text-white p-3 rounded-full transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button id="nextSlide"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 backdrop-blur-sm text-white p-3 rounded-full transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const slideshow = document.getElementById("slideshow");
                                const indicators = document.querySelectorAll(".slide-indicator");
                                const prevBtn = document.getElementById("prevSlide");
                                const nextBtn = document.getElementById("nextSlide");
                                const totalSlides = slideshow.children.length;
                                let index = 0;
                                let autoSlide;

                                function updateSlide(newIndex) {
                                    index = (newIndex + totalSlides) % totalSlides;
                                    slideshow.style.transform = `translateX(-${index * 100}%)`;

                                    indicators.forEach((dot, i) => {
                                        if (i === index) {
                                            dot.style.opacity = "1";
                                            dot.style.transform = "scale(1.2)";
                                        } else {
                                            dot.style.opacity = "0.5";
                                            dot.style.transform = "scale(1)";
                                        }
                                    });
                                }

                                function startAutoSlide() {
                                    autoSlide = setInterval(() => {
                                        updateSlide(index + 1);
                                    }, 4000);
                                }

                                function resetAutoSlide() {
                                    clearInterval(autoSlide);
                                    startAutoSlide();
                                }

                                // Auto slide
                                startAutoSlide();

                                // Manual navigation
                                prevBtn.addEventListener("click", () => {
                                    updateSlide(index - 1);
                                    resetAutoSlide();
                                });

                                nextBtn.addEventListener("click", () => {
                                    updateSlide(index + 1);
                                    resetAutoSlide();
                                });

                                // Click indicator
                                indicators.forEach((dot, i) => {
                                    dot.addEventListener("click", () => {
                                        updateSlide(i);
                                        resetAutoSlide();
                                    });
                                });

                                // Initialize first slide
                                updateSlide(0);
                            });
                        </script>
                    </div>

                    <div class="w-full max-w-full px-3 xl:w-1/2">
                        <div
                            class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border h-full">
                            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                                <h6 class="text-lg font-semibold">Statistik Logistik & Donasi</h6>
                                <p class="text-sm leading-normal text-slate-500">
                                    <i class="fa fa-arrow-up text-green-500"></i>
                                    Perbandingan Data
                                </p>
                            </div>
                            <div class="flex-auto p-4 pt-0">
                                <div class="h-full">
                                    {{-- Canvas Chart.js --}}
                                    <canvas id="logisticChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-wrap my-8 -mx-3">
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

                                            @foreach ($kejadian->take(5) as $item)
                                                <tr>
                                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                                        <h6 class="mb-0 text-sm">{{ $item->jenis_bencana }}</h6>
                                                    </td>

                                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                                        <span class="text-xs font-semibold">
                                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                                        </span>
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
    </body>

    {{-- Tambahkan CDN Chart.js dan Script untuk Grafik --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('logisticChart').getContext('2d');

            // Data Dummy, menggunakan data dari PHP untuk nilai total
            const totalDonasi = {{ $totalDonasi }}; // Nilai Rupiah, akan disederhanakan untuk grafik
            const totalStokLogistik = {{ $totalStokLogistik }}; // Nilai total stok (satuan)
            const totalDistribusi = {{ $totalDistribusi }}; // Nilai total distribusi (satuan)

            // Sederhanakan data donasi (misalnya bagi 1 juta untuk skala)
            const donasiSkalaJuta = totalDonasi / 1000000;

            const data = {
                labels: ['Total Donasi (Juta Rp)', 'Total Stok (Unit)', 'Total Distribusi (Paket)'],
                datasets: [{
                    label: 'Perbandingan Data Kunci',
                    data: [donasiSkalaJuta, totalStokLogistik, totalDistribusi],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.8)', // Amber/Yellow untuk Donasi
                        'rgba(3, 169, 244, 0.8)', // Blue/Cyan untuk Stok
                        'rgba(156, 39, 176, 0.8)' // Purple/Pink untuk Distribusi
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(3, 169, 244, 1)',
                        'rgba(156, 39, 176, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Penting agar tinggi 300px bekerja
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Perbandingan Donasi, Stok & Distribusi',
                            font: {
                                size: 14
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nilai (Juta Rp/Unit/Paket)'
                            }
                        }
                    }
                },
            };

            new Chart(ctx, config);
        });
    </script>

    </html>
@endsection
