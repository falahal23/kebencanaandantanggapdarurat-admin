<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Sign In - Kebencanaan & Tanggap Darurat</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets-admin/img/favicon.png') }}">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('assets-admin/css/soft-ui-dashboard-tailwind.css') }}" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* ===== BACKGROUND ===== */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;

            /* Background gambar */
            background: url("{{ asset('assets-admin/img/login.jpg') }}") no-repeat center center;
            background-size: cover;
        }

        /* Overlay gelap */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .wrapper {
            position: relative;
            z-index: 1;
            display: flex;
            width: 85%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        .left {
            flex: 1;
            background: rgba(240, 244, 255, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px 40px;
        }

        .left img {
            width: 65%;
            max-width: 300px;
            margin-bottom: 20px;
        }

        .left h1 {
            color: #1e3a8a;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 10px;
        }

        .left p {
            text-align: center;
            max-width: 380px;
            color: #333;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .right {
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            text-align: center;
            color: #1e3a8a;
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        input {
            width: 100%;
            padding: 14px;
            margin: 12px 0;
            border-radius: 10px;
            border: 1px solid #ccc;
            outline: none;
            transition: all 0.3s;
        }

        input:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 8px rgba(30, 58, 138, 0.4);
        }

        .forgot-password {
            display: block;
            font-size: 14px;
            color: #1e3a8a;
            text-align: right;
            margin-bottom: 10px;
            text-decoration: none;
        }

        .btn-sign {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-sign:hover {
            background: linear-gradient(90deg, #3b82f6, #1e3a8a);
        }

        .sign-up-section {
            margin-top: 25px;
            text-align: center;
        }

        .sign-up-section a {
            color: #1e3a8a;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
        }

        .sign-up-section a:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .left {
                display: none;
            }

            .wrapper {
                width: 90%;
            }

            .right {
                padding: 40px 20px;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Bagian Kiri -->
        <div class="left">
            <img src="{{ asset('assets-admin/img/apple-icon.png') }}" alt="Kebencanaan">
            <h1>Sistem Kebencanaan & Tanggap Darurat</h1>
            <p>Membantu koordinasi cepat antara petugas, relawan, dan masyarakat.</p>
        </div>

        <!-- Bagian Kanan -->
        <div class="right">
            <h2>Sign In</h2>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <a href="#" class="forgot-password">Lupa Password?</a>
                <button type="submit" class="btn-sign">SIGN IN</button>

                <div class="sign-up-section">
                    <a href="{{ route('user.create') }}">Mau Registrasi?</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets-admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/soft-ui-dashboard-tailwind.min.js') }}"></script>

    <!-- SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif
</body>

</html>
