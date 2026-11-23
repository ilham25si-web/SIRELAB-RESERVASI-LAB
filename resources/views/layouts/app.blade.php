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
        @auth
        <div>
        <span>{{ auth()->user()->nama }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </div>
    @endauth
    @guest
    <div>
        <a href="{{ route('laboratorium.index') }}">Laboratorium</a>
        <a href="{{ route('login') }}">Masuk</a>
        <a href="{{ route('register') }}">Daftar</a>
    </div>
@endguest
    </header>

    <main>
        @if (session('sukses'))
            <div>{{ session('sukses') }}</div>
        @endif
        @yield('isi')

        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif
    </main>
</body>
</html>
