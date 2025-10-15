<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Sign In</title>
    <style>
        /* Variabel CSS untuk Warna */
        :root {
            --primary-color: #6a1b9a;
            --secondary-color: #9c27b0;
            --background-light: #f0f2f5;
            --text-dark: #333;
            --text-light: #fff;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
        }

        .container {
            display: flex;
            width: 800px;
            height: 450px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .sign-in-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .sign-in-section h2 {
            font-size: 32px;
            font-weight: bold;
            color: var(--text-dark);
            margin-bottom: 30px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-icons a {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .sign-in-section p {
            color: #888;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .form-group {
            width: 100%;
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--secondary-color);
        }

        .forgot-password {
            font-size: 12px;
            color: #888;
            text-decoration: none;
            display: block;
            margin-bottom: 25px;
            text-align: left;
            width: 100%;
        }

        .btn-sign-in {
            background-color: var(--primary-color);
            color: var(--text-light);
            padding: 10px 40px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-sign-in:hover {
            background-color: var(--secondary-color);
        }

        .sign-up-section {
            flex: 1;
            background-color: var(--primary-color);
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
            border-radius: 20px;
            position: relative;
        }

        .sign-up-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--primary-color);
            border-top-left-radius: 60%;
            border-bottom-left-radius: 0;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            z-index: 0;
        }

        .sign-up-section * {
            position: relative;
            z-index: 1;
        }

        .sign-up-section h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .sign-up-section p {
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .btn-sign-up {
            background-color: transparent;
            color: var(--text-light);
            padding: 10px 30px;
            border: 2px solid var(--text-light);
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-sign-up:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Pesan error & success */
        .alert {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 6px;
            width: 100%;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="sign-in-section">
            <h2>Sign In</h2>

            <!-- Pesan sukses atau error -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.process') }}" style="width: 100%;">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <a href="#" class="forgot-password">Forgot Your Password?</a>

                <button type="submit" class="btn-sign-in">SIGN IN</button>
            </form>
        </div>

        <div class="sign-up-section">
            <h3>Hello, Friend!</h3>
            <p>Register with your personal details to use all of site features.</p>
            <button class="btn-sign-up">SIGN UP</button>
        </div>
    </div>

</body>
</html>
