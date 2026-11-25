<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('judul') - Reservasi Laboratorium PCR</title>
</head>
<body>
    @include('partials.navbar')

    <main>
        <x-alert />
        @yield('isi')
    </main>
</body>
</html>