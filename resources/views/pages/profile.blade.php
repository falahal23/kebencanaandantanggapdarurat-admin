<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Falahal Nabil Haqiqi - Tailwind CSS</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .profile-header {
            background-color: #1a73e8;
            color: white;
            padding: 3rem 0;
            border-radius: 0 0 10px 10px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        .section-card {
            border-left: 5px solid #1a73e8;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Header Profil -->
    <div class="profile-header text-center mb-12">
        <div class="container mx-auto px-4">
            <img src="{{ asset('assets-admin/img/profile.png') }}"
            class="profile-img rounded-full mx-auto mb-4" alt="Foto Profil">
            <h1 class="text-4xl font-extrabold">FALAHAL NABIL HAQIQI</h1>
            <p class="text-xl font-light">Mahasiswa | Politeknik Caltex Riau (PCR)</p>
            <div class="inline-block bg-[#00bcd4] text-white py-1 px-3 mt-2 rounded-full text-sm font-medium">
                <i class="fas fa-graduation-cap mr-1"></i>
                Prodi Sistem Informasi (Jurusan Teknologi Informasi)
            </div>

            <div class="mt-6 text-sm flex flex-wrap justify-center gap-4">
                <span><i class="fas fa-envelope mr-1"></i> falahal24si@mahasiswa.pcr.ac.id</span>
                <span><i class="fas fa-phone mr-1"></i> 081266007367</span>
                <span><i class="fab fa-linkedin mr-1"></i>
                    <a href="https://www.linkedin.com/in/falahal-nabil-haqiqi" class="hover:underline">LinkedIn Profil</a>
                </span>
            </div>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

            <!-- Kiri -->
            <div class="md:col-span-8">

                <!-- Tentang Saya -->
                <div class="bg-white p-6 shadow-lg rounded-lg mb-8">
                    <h3 class="text-2xl font-semibold text-[#1a73e8] mb-4">
                        <i class="fas fa-user-circle mr-2"></i> Tentang Saya
                    </h3>
                    <p class="text-gray-700 text-justify">
                        Saya adalah mahasiswa aktif di Politeknik Caltex Riau program studi <strong>Sistem Informasi</strong>. Saya memiliki fokus pada pengembangan perangkat lunak dan manajemen basis data, dengan keahlian khusus dalam membangun sistem informasi untuk kebutuhan tanggap bencana, seperti manajemen donasi dan logistik.
                    </p>
                </div>

                <!-- Pengalaman Proyek/Organisasi -->
                <h3 class="text-2xl font-semibold text-[#1a73e8] mb-4"><i class="fas fa-briefcase mr-2"></i> Pengalaman Proyek/Organisasi</h3>
                <div class="bg-white p-4 shadow-md rounded-lg mb-4 section-card">
                    <h5 class="text-lg font-bold">Pengembang Sistem Informasi Kebencanaan</h5>
                    <p class="text-sm text-gray-500 mb-1">Periode Proyek | Politeknik Caltex Riau</p>
                    <ul class="list-disc list-inside text-gray-700 text-sm ml-4">
                        <li>Mengembangkan modul inti untuk sistem kebencanaan (Donasi, Posko, Logistik) menggunakan framework web modern.</li>
                        <li>Berfokus pada efisiensi user interface (UI) untuk admin dan pengguna akhir dalam situasi darurat.</li>
                    </ul>
                </div>

                <!-- Pendidikan -->
                <h3 class="text-2xl font-semibold text-[#1a73e8] mb-4 mt-8"><i class="fas fa-graduation-cap mr-2"></i> Pendidikan</h3>
                <div class="bg-white p-4 shadow-md rounded-lg mb-4 section-card">
                    <h5 class="text-lg font-bold">Politeknik Caltex Riau (PCR)</h5>
                    <p class="text-sm text-gray-500 mb-1">Prodi Sistem Informasi | Jurusan Teknologi Informasi</p>
                    <p class="text-sm text-gray-600 mb-0">Saat ini berfokus pada: Pengembangan Aplikasi Web, Basis Data, dan Analisis Sistem.</p>
                </div>

            </div>

            <!-- Kanan -->
            <div class="md:col-span-4">

                <!-- Kemampuan Teknis -->
                <div class="bg-white p-6 shadow-lg rounded-lg mb-8">
                    <h5 class="text-xl font-semibold text-[#1a73e8] mb-4"><i class="fas fa-code mr-2"></i> Kemampuan Teknis</h5>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Sistem Informasi</span>
                        <span class="bg-green-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">PHP & Laravel</span>
                        <span class="bg-cyan-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Basis Data (MySQL)</span>
                        <span class="bg-gray-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Bootstrap & Tailwind</span>
                        <span class="bg-yellow-500 text-gray-900 text-xs font-medium px-2.5 py-0.5 rounded-full">Git & GitHub</span>
                    </div>
                </div>

                <!-- Tautan -->
                <div class="bg-white p-6 shadow-lg rounded-lg">
                    <h5 class="text-xl font-semibold text-[#1a73e8] mb-4"><i class="fas fa-link mr-2"></i> Tautan</h5>
                    <ul class="divide-y divide-gray-200">
                        <li class="py-2">
                            <i class="fab fa-github mr-2 text-gray-800"></i>
                            <a href="[LINK_GITHUB_ANDA]" class="text-gray-700 hover:text-blue-500">Lihat Kode di GitHub</a>
                        </li>
                        <li class="py-2">
                            <i class="fas fa-globe mr-2 text-gray-500"></i>
                            <a href="[LINK_PROYEK_ANDA]" class="text-gray-700 hover:text-blue-500">Aplikasi Kebencanaan (Portofolio)</a>
                        </li>
                        <li class="py-2">
                            <i class="fab fa-instagram mr-2 text-pink-600"></i>
                            <a href="[LINK_INSTAGRAM_ANDA]" class="text-gray-700 hover:text-pink-600">Instagram</a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

</body>
</html>
