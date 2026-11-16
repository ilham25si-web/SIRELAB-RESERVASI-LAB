<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Reservasi Laboratorium PCR</title>
</head>
<body>
    <header>
        <strong>Reservasi Laboratorium PCR</strong>
        <span>{{ auth()->user()->nama }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </header>

    <main>
        @yield('isi')
    </main>
</body>
</html>