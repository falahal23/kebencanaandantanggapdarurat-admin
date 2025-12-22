<aside
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-2xl rounded-2xl overflow-y-auto transition-transform duration-300 ease-in-out xl:translate-x-0">

    <!-- Logo -->
    <div class="flex items-center justify-center py-8 px-6">
        <img src="{{ asset('assets-admin/img/logo-ct.png') }}" alt="Logo" class="h-16 w-auto mr-3">
        <span class="text-2xl font-extrabold text-gray-800 tracking-tight">GuardianNet</span>
    </div>
    <hr class="border-t border-gray-200 my-4">

    <!-- Menu -->
    <ul class="flex flex-col px-2 space-y-3">
        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-5 py-4 font-semibold text-white bg-gradient-to-r from-purple-600 to-pink-500 rounded-2xl shadow-lg hover:from-purple-700 hover:to-pink-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
                <span class="text-lg">Dashboard</span>
            </a>
        </li>

        <!-- Fitur Utama Header -->
        <li class="mt-6 mb-2 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Fitur Utama</li>

        <!-- Kejadian Bencana -->
        <li>
            <a href="{{ route('kejadian_bencana.index') }}"
               class="flex items-center gap-3 px-5 py-4 text-gray-700 rounded-2xl hover:bg-red-50 hover:text-red-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 21h22L12 2 1 21z"/>
                    <path d="M12 16v-2"/>
                    <path d="M12 12v-4"/>
                </svg>
                <span class="text-lg font-medium">Kejadian Bencana</span>
            </a>
        </li>

        <!-- Posko Bencana -->
        <li>
            <a href="{{ route('admin.posko.index') }}"
               class="flex items-center gap-3 px-5 py-4 text-gray-700 rounded-2xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 19h18l-9-15-9 15z"/>
                    <path d="M10 17h4v2h-4z"/>
                </svg>
                <span class="text-lg font-medium">Posko Bencana</span>
            </a>
        </li>

        <!-- Donasi Bencana -->
        <li>
            <a href="{{ route('admin.donasi.index') }}"
               class="flex items-center gap-3 px-5 py-4 text-gray-700 rounded-2xl hover:bg-green-50 hover:text-green-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M11 11h2v6h-2z"/>
                    <path d="M11 17h2v2h-2z"/>
                </svg>
                <span class="text-lg font-medium">Donasi Bencana</span>
            </a>
        </li>

        <!-- Logistik Bencana -->
        <li>
            <a href="{{ route('logistik.index') }}"
               class="flex items-center gap-3 px-5 py-4 text-gray-700 rounded-2xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="5" cy="16" r="2"/>
                    <circle cx="19" cy="16" r="2"/>
                    <path d="M1 3h14v10H1z"/>
                    <path d="M16 3h7l3 3v5h-7z"/>
                </svg>
                <span class="text-lg font-medium">Logistik Bencana</span>
            </a>
        </li>

        <!-- Distribusi Logistik -->
        <li>
            <a href="{{ route('distribusi.index') }}"
               class="flex items-center gap-3 px-5 py-4 text-gray-700 rounded-2xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h18v4H3z"/>
                    <path d="M3 7l9 6 9-6"/>
                    <path d="M3 7v14h18V7"/>
                </svg>
                <span class="text-lg font-medium">Distribusi Logistik</span>
            </a>
        </li>

        <!-- Master Data Header -->
        <li class="mt-6 mb-2 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Master Data</li>

        <!-- Warga -->
        <li>
            <a href="{{ route('warga.index') }}"
               class="flex items-center gap-3 px-5 py-4 text-gray-700 rounded-2xl hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3z"/>
                    <path d="M8 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3z"/>
                    <path d="M1 20v-1.5C1 16.17 5.67 15 8 15s7 1.17 7 3.5V20H1z"/>
                </svg>
                <span class="text-lg font-medium">Warga</span>
            </a>
        </li>

        <!-- User -->
        <li>
            <a href="{{ route('user.index') }}"
               class="flex items-center gap-3 px-5 py-4 text-gray-700 rounded-2xl hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 12c2.67 0 8 1.34 8 4v4H4v-4c0-2.66 5.33-4 8-4z"/>
                    <path d="M12 6a4 4 0 100-8 4 4 0 000 8z"/>
                </svg>
                <span class="text-lg font-medium">User</span>
            </a>
        </li>
    </ul>
</aside>
