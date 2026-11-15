<body>
    <h1>Dashboard Pengguna</h1>
    <p>Halo, {{ auth()->user()->nama }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Keluar</button>
    </form>
</body>