<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Sign In</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets-admin/img/favicon.png') }}">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('assets-admin/fonts/nucleo-icons.ttf') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('assets-admin/css/soft-ui-dashboard-tailwind.css') }}" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #007bff, #00c6ff);
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 380px;
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        h2 {
            margin-bottom: 20px;
            color: #007bff;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s;
        }

        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .forgot-password {
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-sign {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
            margin-top: 10px;
        }

        .btn-sign:hover {
            background-color: #0056b3;
        }

        .sign-up-section {
            margin-top: 30px;
        }

        .sign-up-section h3 {
            color: #333;
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
    </style>
</head>

<body>

    <div class="container">
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

            <a href="#" class="forgot-password">Forgot Your Password?</a>
            <button type="submit" class="btn-sign">SIGN IN</button>

            <div class="sign-up-section">
                <a href="{{ route('user.create') }}" class="forgot-password">Mau Registrasi?</a>

                </a>
            </div>

        </form>


        <!-- Core -->
        <script src="{{ asset('assets-admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets-admin/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets-admin/js/core/bootstrap.min.js') }}"></script>

        <!-- Volt JS -->
        <script src="{{ asset('assets-admin/js/soft-ui-dashboard-tailwind.min.js') }}"></script>

</body>

</html>
