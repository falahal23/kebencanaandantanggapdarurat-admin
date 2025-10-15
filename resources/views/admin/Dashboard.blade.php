<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kebencanaan dan Tanggap Darurat</title>
    <!-- Memuat Tailwind CSS untuk styling yang cepat dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font Inter yang modern */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        :root {
            --color-primary: #ef4444; /* Merah untuk Darurat */
            --color-secondary: #10b981; /* Hijau untuk Kesiapsiagaan */
            --color-dark: #1f2937;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        /* Styling Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--color-dark);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 10;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 0;
            transition: all 0.2s;
            border-radius: 0 50px 50px 0; /* Bentuk elegan */
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar a.active {
            background-color: var(--color-primary);
            font-weight: 600;
        }

        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--color-secondary); /* Warna hijau untuk kontras */
        }

        /* Styling Konten Utama */
        .main-content {
            margin-left: 280px; /* Sebesar lebar sidebar */
            padding: 2rem;
            transition: margin-left 0.3s;
        }

        /* Styling Kartu KPI */
        .kpi-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 6px solid;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .kpi-value {
            font-size: 2.25rem;
            font-weight: 700;
            margin-top: 0.25rem;
        }

        .kpi-title {
            font-weight: 500;
            color: #6b7280;
        }

        /* Utility class untuk ikon Placeholder (karena tidak bisa import Font Awesome) */
        .icon {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .alert-bar {
            background-color: #fecaca;
            color: #991b1b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Media Query untuk Responsif Mobile */
        @media (max-width: 1024px) {
            .sidebar {
                width: 0;
                overflow-x: hidden;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-title">KABENCAANA</div>

        <nav class="space-y-2">
            <!-- Link Dashboard Aktif -->
            <a href="#" class="active">
                <span class="icon">&#9776;</span> <!-- Ikon: Dashboard -->
                Dashboard Utama
            </a>

            <a href="#">
                <span class="icon">&#9888;</span> <!-- Ikon: Peringatan -->
                Laporan Bencana
            </a>

            <a href="#">
                <span class="icon">&#9992;</span> <!-- Ikon: Logistik (Pesawat Kargo) -->
                Alokasi Sumber Daya
            </a>

            <a href="#">
                <span class="icon">&#128100;</span> <!-- Ikon: Grup Relawan -->
                Manajemen Relawan
            </a>

            <a href="#">
                <span class="icon">&#9874;</span> <!-- Ikon: Peta (Gereja/Monumen) -->
                Peta Lokasi Rawan
            </a>

            <a href="#" class="mt-8">
                <span class="icon">&#9994;</span> <!-- Ikon: Pengaturan (Tangan) -->
                Pengaturan Akun
            </a>

            <!-- Logout Section -->
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left flex items-center p-3 text-red-400 hover:bg-red-500 hover:text-white rounded-r-full transition duration-200">
                    <span class="icon text-xl">&#10145;</span> <!-- Ikon: Keluar -->
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Dashboard Operasi Tanggap Darurat
            </h1>
            <p class="text-gray-500">Ringkasan status kebencanaan terkini dan metrik utama.</p>
        </div>

        <!-- Notifikasi Darurat (Menggunakan struktur dari success/error Anda) -->
        @if(session('success'))
            <div class="alert-bar bg-green-100 text-green-700">
                <span class="icon text-2xl">&#9989;</span>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
             <div class="alert-bar">
                <span class="icon text-2xl">&#9888;</span>
                {{ session('error') }}
            </div>
        @else
            <div class="alert-bar">
                <span class="icon text-2xl">&#9888;</span>
                Perhatian: Tidak ada status darurat aktif yang terdeteksi dalam 24 jam terakhir.
            </div>
        @endif

        <!-- KPI Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <!-- Kartu 1: Bencana Aktif (Primary: Merah) -->
            <div class="kpi-card" style="border-left-color: var(--color-primary);">
                <div class="kpi-title">Bencana Aktif</div>
                <div class="kpi-value text-red-600">3</div>
                <p class="text-xs text-gray-400 mt-1">Status 24 jam terakhir</p>
            </div>

            <!-- Kartu 2: Relawan Bertugas (Secondary: Hijau) -->
            <div class="kpi-card" style="border-left-color: var(--color-secondary);">
                <div class="kpi-title">Relawan Bertugas</div>
                <div class="kpi-value text-green-600">45</div>
                <p class="text-xs text-gray-400 mt-1">Relawan di lapangan</p>
            </div>

            <!-- Kartu 3: Korban Terdampak (Warning: Kuning) -->
            <div class="kpi-card" style="border-left-color: #f59e0b;">
                <div class="kpi-title">Korban Terdampak</div>
                <div class="kpi-value text-yellow-600">1.200</div>
                <p class="text-xs text-gray-400 mt-1">Dalam 7 hari terakhir</p>
            </div>

            <!-- Kartu 4: Stok Bantuan (Info: Biru) -->
            <div class="kpi-card" style="border-left-color: #3b82f6;">
                <div class="kpi-title">Stok Bantuan (Kg)</div>
                <div class="kpi-value text-blue-600">5.8 Tonn</div>
                <p class="text-xs text-gray-400 mt-1">Persediaan logistik utama</p>
            </div>
        </div>

        <!-- Area Konten Detail (Tabel Ringkasan) -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Bencana Utama</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Bencana</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Kab. A, Kec. Merah</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Banjir Bandang</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Siaga 1
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 hover:text-blue-800 cursor-pointer">Lihat Detail</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Kota B, Kel. Hijau</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Gempa Ringan</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pemulihan
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 hover:text-blue-800 cursor-pointer">Lihat Detail</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Utama Kembali ke "Data" -->
            <div class="text-center mt-8">
                <a href="{{ url('/kdt') }}" class="inline-block py-2 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                    Lanjut ke Halaman Data (KDT)
                </a>
            </div>
        </div>
    </div>

</body>
</html>
