<!-- Versi 6 Free -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-p1BmPZgIY9x+...==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">

            <nav>
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal">
                        <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                        aria-current="page">
                        Dashboard Admin
                    </li>
                </ol>
                <h6 class="mb-0 font-bold capitalize">Kebencanaan</h6>
            </nav>

            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">

                <div class="flex items-center md:ml-auto md:pr-4">
                    <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                        <span
                            class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                            class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Type here..." />
                    </div>
                </div>

                <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

                    <li class="flex items-center pl-4 xl:hidden">
                        <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500"
                            sidenav-trigger>
                            <div class="w-4.5 overflow-hidden">
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            </div>
                        </a>
                    </li>

                    <li class="flex items-center px-4">
                        <a href="javascript:;" class="p-0 text-sm transition-all ease-nav-brand text-slate-500">
                            <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                        </a>
                    </li>

                    <li class="relative flex items-center pr-2">
                        <p class="hidden transform-dropdown-show"></p>
                        <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500"
                            dropdown-trigger aria-expanded="false">
                            <i class="cursor-pointer fa fa-bell"></i>
                        </a>

                        <ul dropdown-menu
                            class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-44 before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                            <li class="relative mb-2">
                                <a class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                                    href="javascript:;">
                                    <div class="flex py-1">
                                        <div class="my-auto">
                                            <img src="{{ asset('assets-admin/img/team-2.jpg') }}"
                                                class="inline-flex items-center justify-center mr-4 text-sm text-white h-9 w-9 max-w-none rounded-xl"
                                                alt="Team Member">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-1 text-sm font-normal leading-normal"><span
                                                    class="font-semibold">New message</span> from Laur</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400"><i
                                                    class="mr-1 fa fa-clock"></i> 13 minutes ago</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @guest
                        <li class="flex items-center pl-4 lg:pl-2">
                            <a href="{{ route('login.index') }}"
                                class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500 hover:text-slate-700">
                                <i class="fa fa-user sm:mr-1"></i>
                                <span class="hidden sm:inline">Sign In</span>
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="relative flex items-right pr-25 mx-25" style="width: 4cm;">
                            <!-- Avatar -->
                            <div id="userDropdown" class="flex items-center cursor-pointer">
                                @if (Auth::user() && Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                        class="h-12 w-12 rounded-full shadow-md border border-gray-200"
                                        alt="{{ Auth::user()->name }}">
                                @else
                                    <img src="{{ asset('assets-admin/img/default-profile.png') }}"
                                        class="h-12 w-12 rounded-full shadow-md border border-gray-200" alt="">
                                @endif
                                <span class="ml-3 font-semibold text-slate-700 hidden sm:inline">
                                    {{ Auth::user()->name }}
                                </span>
                            </div>


                            <!-- Dropdown Menu -->
                            <ul id="userDropdownMenu"
                                class="absolute right-0 top-full mt-4 w-80 bg-white rounded-xl shadow-lg py-2 opacity-0 pointer-events-none transition-all duration-300 z-50 border border-gray-200">

                                <!-- My Profile -->
                                <li>
                                    <a href="#"
                                        class="flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-purple-100 hover:text-purple-700 rounded-lg">
                                        <span class="mr-3">👤</span> My Profile
                                    </a>
                                </li>

                                <!-- Message -->
                                <li>
                                    <a href="#"
                                        class="flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-purple-100 hover:text-purple-700 rounded-lg">
                                        <span class="mr-3">💬</span> Message
                                    </a>
                                </li>

                                <!-- Settings -->
                                <li>
                                    <a href="#"
                                        class="flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-purple-100 hover:text-purple-700 rounded-lg">
                                        <span class="mr-3">⚙️</span> Settings
                                    </a>
                                </li>

                                <!-- Date -->
                                <li
                                    class="flex items-center px-4 py-2 text-sm text-slate-700 rounded-lg hover:bg-purple-50">
                                    <span class="mr-3">📅</span> {{ now()->format('Y-m-d') }}
                                </li>

                                <!-- Time -->
                                <li
                                    class="flex items-center px-4 py-2 text-sm text-slate-700 rounded-lg hover:bg-purple-50">
                                    <span class="mr-3">⏰</span> <span id="dropdownClock"></span>
                                </li>

                                <hr class="my-2 border-t border-gray-200">

                                <!-- Logout -->
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="flex items-center px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 rounded-lg">
                                        <span class="mr-3">🚪</span> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <!-- JS Dropdown & Clock -->
                        <script>
                            const avatar = document.getElementById('userDropdown');
                            const menu = document.getElementById('userDropdownMenu');

                            avatar.addEventListener('click', function(e) {
                                e.stopPropagation();
                                menu.classList.toggle('opacity-0');
                                menu.classList.toggle('pointer-events-none');
                            });

                            document.addEventListener('click', function() {
                                menu.classList.add('opacity-0');
                                menu.classList.add('pointer-events-none');
                            });

                            function updateDropdownClock() {
                                const now = new Date();
                                const h = String(now.getHours()).padStart(2, '0');
                                const m = String(now.getMinutes()).padStart(2, '0');
                                const s = String(now.getSeconds()).padStart(2, '0');
                                document.getElementById('dropdownClock').textContent = `${h}:${m}:${s}`;
                            }

                            setInterval(updateDropdownClock, 1000);
                            updateDropdownClock();
                        </script>

                    @endauth

                </ul>
            </div>
        </div>
    </nav>
