<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Volt Premium - Sign in page (Tailwind Version)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt Premium Bootstrap Dashboard - Sign in page">
    <meta name="author" content="Themesberg">
    <meta name="description" content="Volt Pro converted to Tailwind CSS">

    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets-admin')}}/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets-admin')}}/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets-admin')}}/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="{{asset('assets-admin')}}/assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="{{asset('assets-admin')}}/assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <script src="https://cdn.tailwindcss.com"></script>

    <link type="text/css" href="{{asset('assets-admin')}}/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link type="text/css" href="{{asset('assets-admin')}}/vendor/notyf/notyf.min.css" rel="stylesheet">

    <style>
        .bg-signin-illustration {
            background-image: url("{{asset('assets-admin')}}/img/illustrations/signin.svg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <main>
        <section class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl w-full space-y-8">

                <div class="flex flex-col items-center justify-center bg-signin-illustration">
                    <div class="w-full flex items-center justify-center">
                        @yield('content')
                    </div>
                </div>

            </div>
        </section>
    </main>

    <script src="{{asset('assets-admin')}}/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="{{asset('assets-admin')}}/vendor/notyf/notyf.min.js"></script>

    </body>
</html>
