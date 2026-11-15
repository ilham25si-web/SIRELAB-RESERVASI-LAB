<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Halo, {{ auth()->user()->nama }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Keluar</button>
    </form>
</body>
</html>