<!DOCTYPE html>
<html>

<head>
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
</head>

  {{-- start Css --}}
@include('layouts.admin.css')
    {{-- end css --}}
</head>

<body>

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

</body>

</html>
