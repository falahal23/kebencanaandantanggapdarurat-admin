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
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #004e92, #000428);
        }

        .wrapper {
            display: flex;
            width: 85%;
            max-width: 1100px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        .left {
            flex: 1;
            background: #f8faff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .left img {
            width: 70%;
            max-width: 320px;
            margin-bottom: 25px;
        }

        .left h1 {
            color: #004e92;
            font-size: 1.8rem;
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
            color: #004e92;
            font-weight: 600;
            margin-bottom: 25px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: all 0.3s;
        }

        input:focus {
            border-color: #004e92;
            box-shadow: 0 0 5px rgba(0, 78, 146, 0.4);
        }

        .forgot-password {
            display: block;
            font-size: 14px;
            color: #004e92;
            text-align: right;
            margin-bottom: 10px;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-sign {
            width: 100%;
            padding: 12px;
            background-color: #004e92;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-sign:hover {
            background-color: #006be0;
        }

        .sign-up-section {
            margin-top: 25px;
            text-align: center;
        }

        .sign-up-section a {
            color: #004e92;
            font-weight: 500;
            text-decoration: none;
        }

        .sign-up-section a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Bagian Kiri -->
        <div class="left">
            <img src="{{ asset('assets-admin/img/apple-icon.png') }}"alt="Kebencanaan">
            <h1>Sistem Kebencanaan & Tanggap Darurat</h1>
            <p>Membantu koordinasi cepat antara petugas, relawan, dan masyarakat dalam menghadapi situasi bencana secara
                terintegrasi dan efisien.</p>
        </div>

        <!-- Bagian Kanan -->
        <div class="right">
            <h2>Sign In</h2>

            <!-- Pesan sukses atau error -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

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

    <!-- Volt JS -->
    <script src="{{ asset('assets-admin/js/soft-ui-dashboard-tailwind.min.js') }}"></script>

</body>

</html>
