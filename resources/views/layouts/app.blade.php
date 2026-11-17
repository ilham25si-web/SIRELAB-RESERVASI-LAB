<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Reservasi Laboratorium PCR</title>
</head>
<body>
    <header>
        <strong>Reservasi Laboratorium PCR</strong>
        <div>
        <span>{{ auth()->user()->nama }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </div>
    </header>

    <main>
        @yield('isi')
    </main>
</body>
</html>