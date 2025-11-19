<aside
    class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="javascript:;" target="_blank">

            <img src="{{ asset('assets-admin/img/logo-ct.png') }}"
                class="inline transition-all duration-200 ease-nav-brand" style="height: 55px; width: auto;"
                alt="main_logo">

            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Tanggap Darurat</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="py-2.7 shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors"
                    href="{{ route('dashboard') }}" class="nav-link">
                    <div
                        class="bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="opacity-60"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                            </path>
                                            <path class=""
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                </a>
            </li>


            </li>

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Fitur Utama
                </h6>
            </li>
            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('kejadian_bencana.index') }}" class="nav-link">
                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center text-center xl:p-2.5">
                        <!-- Ikon Bencana / Peringatan -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="text-slate-800 opacity-70" viewBox="0 0 24 24">
                            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z" />
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Kejadian Bencana</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.posko.index') }}">
                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center text-center xl:p-2.5">
                        <!-- Ikon Posko / Tenda Darurat -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="text-slate-800 opacity-70" viewBox="0 0 24 24">
                            <path d="M3 19h18l-9-15-9 15zm9-11.3L17.6 17H6.4L12 7.7zM10 17h4v2h-4v-2z" />
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Posko Bencana</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:bg-gray-100 rounded-lg"
                    href="{{ route('admin.donasi.index') }}">
                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <!-- Icon tumpukan uang abu-abu diperbesar proporsional -->
                        <svg width="24px" height="24px" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="8" y="28" width="32" height="8" rx="2" fill="#757575" />
                            <rect x="10" y="24" width="28" height="8" rx="2" fill="#B0B0B0" />
                            <rect x="12" y="20" width="24" height="8" rx="2" fill="#E0E0E0" />
                            <line x1="12" y1="24" x2="36" y2="24" stroke="#616161"
                                stroke-width="1" />
                            <line x1="12" y1="28" x2="36" y2="28" stroke="#616161"
                                stroke-width="1" />
                            <text x="24" y="27" text-anchor="middle" fill="#424242" font-size="9" font-family="Arial"
                                font-weight="normal">$</text>
                        </svg>
                    </div>
                    <span
                        class="ml-2 duration-300 opacity-100 pointer-events-none ease-soft text-slate-700 font-normal">
                        Donasi Bencana
                    </span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a href="{{ route('logistik.index') }}"
                    class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:bg-blue-50 rounded-lg">

                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white text-center xl:p-2.5">
                        <!-- Ikon Logistik (Truk Pengiriman) -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="#334155" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect>
                            <path d="M16 8h4l3 3v5h-7z"></path>
                            <circle cx="5.5" cy="18.5" r="1.5"></circle>
                            <circle cx="18.5" cy="18.5" r="1.5"></circle>
                        </svg>
                    </div>

                    <span
                        class="ml-1 font-normal duration-300 opacity-100 pointer-events-none ease-soft text-slate-700">
                        Logistik Bencana
                    </span>
                </a>
            </li>

            <!-- Distribusi Logistik -->
            <li class="mt-0.5 w-full">
                <a href="{{ route('logistik.index') }}"
                    class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:bg-blue-50 rounded-lg">

                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white text-center xl:p-2.5">
                        <!-- Ikon Logistik (Gudang / Box) -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="#334155" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 3h18v4H3z"></path>
                            <path d="M3 7l9 6 9-6"></path>
                            <path d="M3 7v14h18V7"></path>
                        </svg>
                    </div>

                    <span class="ml-1 font-normal text-slate-700">
                        Distribusi Logistik
                    </span>
                </a>
            </li>


            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">
                    Master data
                </h6>
            </li>
            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('warga.index') }}" class="nav-link">
                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center text-center xl:p-2.5">
                        <!-- Ikon Warga (People / Community) -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="text-slate-800 opacity-70" viewBox="0 0 24 24">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05C16.5 13.67 19 14.84 19 16.5V19h5v-2.5C24 14.17 19.33 13 16 13z" />
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Warga</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('user.index') }}" class="nav-link">
                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center text-center xl:p-2.5">
                        <!-- Ikon User -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="text-slate-800 opacity-70" viewBox="0 0 24 24">
                            <path d="M12 12c2.67 0 8 1.34 8 4v4H4v-4c0-2.66 5.33-4 8-4zm0-2a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">User</span>
                </a>
            </li>



            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">
                    Account pages
                </h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('logout') }}" method="GET" class="inline"
                    class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Log Out</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="mx-4">
        <p
            class="invisible hidden text-gray-800 text-red-500 text-red-600 after:bg-gradient-to-tl after:from-gray-900 after:to-slate-800 after:from-blue-600 after:to-cyan-400 after:from-red-500 after:to-yellow-400 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-rose-400 after:from-slate-600 after:to-slate-300 text-lime-500 text-cyan-500 text-slate-400 text-fuchsia-500">
        </p>
        <div class="after:opacity-65 after:bg-gradient-to-tl after:from-slate-600 after:to-slate-300 relative flex min-w-0 flex-col items-center break-words rounded-2xl border-0 border-solid border-blue-900 bg-white bg-clip-border shadow-none after:absolute after:top-0 after:bottom-0 after:left-0 after:z-10 after:block after:h-full after:w-full after:rounded-2xl after:content-['']"
            sidenav-card>
            <div class="mb-7.5 absolute h-full w-full rounded-2xl bg-cover bg-center"
                style="background-image: url('{{ asset('assets-admin/img/curved-images/white-curved.jpeg') }}');">
            </div>
        </div>
    </div>
</aside>
