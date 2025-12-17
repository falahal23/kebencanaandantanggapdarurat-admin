<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('assets-admin/css/custom-sidebar.css') }}">

    <!-- Versi 6 Free -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-p1BmPZgIY9x+...==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4C+6Zw5qPcbK6Ra+qPp7A64kL4B8p6jWc5o6VbG6DRmY7wZkITzB8sH3Vf7+e8Exs3U9Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Awesome (ikon untuk tombol edit, hapus, dll) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-pVIx8WzY2YrC8YecV81+0pZphk5C+Y12gS3DPCzLAd4ZCbxzPz+qMjQXtkGcv7Klpq2B4W1DPp6zk+nbP3FJ3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Tambahkan ini PALING ATAS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-+E4Y6BOY5FGDBgbkY1RyDg9ptLrqtYzYJ8Z6h6jZWk28+AcbWBVJk3Z3UejB5aMg2xEDZB+2ZhMTlPuL/Y6FSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- File CSS lainnya -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/soft-ui-dashboard.css') }}">

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets-admin/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets-admin/img/favicon.png') }}">
    <title>Kebencanaan & Tanggap Darurat</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets-admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link href="{{ asset('assets-admin/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />

    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <style>
        .media-image {
            max-width: 400px;
            max-height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>

{{-- start Css --}}
@include('layouts.admin.css')
{{-- end css --}}

<script src="{{ asset('js/avatar-dropdown.js') }}"></script>

</head>

<body>
    <style>
        .media-image {
            max-width: 400px;
            max-height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
    <!-- Floating WhatsApp Button (Tailwind) -->
    <div id="wa-fab" class="fixed right-6 bottom-6 z-50">
        <button id="wa-button"
            class="flex items-center justify-center w-14 h-14 rounded-full shadow-lg focus:outline-none hover:scale-110 transition-transform"
            style="background: linear-gradient(135deg,#25D366,#128C7E);">
            <!-- Ikon WA -->
            <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.486 2 2 6.486 2 12c0 1.855..."></path>
            </svg>
        </button>
    </div>

    <!-- Modal -->
    <div id="wa-modal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-xl p-6 w-80 shadow-lg relative">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Kirim Pesan ke Admin</h3>
            <textarea id="wa-message" rows="3" class="w-full border border-gray-300 rounded-md p-2"
                placeholder="Tulis pesan kamu..."></textarea>
            <div class="mt-4 flex justify-between">
                <button id="wa-cancel" class="px-4 py-2 text-gray-600">Batal</button>
                <button id="wa-send" class="px-4 py-2 bg-green-500 text-white rounded-md">Kirim</button>
            </div>
            <button id="wa-close" class="absolute top-3 right-3 text-gray-400 text-lg">&times;</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const phoneNumber = "PHONE_NUMBER"; // <<< GANTI DI SINI
            const waButton = document.getElementById("wa-button");
            const waModal = document.getElementById("wa-modal");
            const waCancel = document.getElementById("wa-cancel");
            const waClose = document.getElementById("wa-close");
            const waSend = document.getElementById("wa-send");
            const waMessage = document.getElementById("wa-message");

            waButton.addEventListener("click", () => {
                waModal.classList.remove("hidden");
                waMessage.focus();
            });
            [waCancel, waClose].forEach(btn => btn.addEventListener("click", () => waModal.classList.add(
                "hidden")));

            waSend.addEventListener("click", () => {
                const msg = waMessage.value.trim();
                if (!msg) {
                    alert("Silakan tulis pesan dulu.");
                    return;
                }
                const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(msg)}`;
                window.open(url, "_blank");
                waModal.classList.add("hidden");
                waMessage.value = "";
            });
        });
    </script>


    {{-- satrt side bar --}}
    @include('layouts.admin.sidebar')
    {{-- end sidebar --}}

    {{-- Start Main Conten --}}
    <main class="content">

        {{-- satrt header --}}
        @include('layouts.admin.header')
        {{-- endheader --}}

        {{-- maincode --}}
        @yield('content')
        {{-- end maincode --}}

        {{-- start footer --}}
        @include('layouts.admin.footer')
        {{-- end foter --}}

    </main>

    {{-- starJs --}}
    <!-- Core -->
    @include('layouts.admin.js')
    {{-- endJs --}}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets-admin/js/plugins/avatar-dropdown.js') }}"></script>



    {{-- ✅ SUCCESS MESSAGE --}}
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
    @endif

    {{-- ✅ ERROR MESSAGE (Laravel Validation & Login gagal) --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif

    {{-- ✅ ERROR MESSAGE (session error) --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
<script src="{{ asset('js/avatar-dropdown.js') }}"></script>


</html>
