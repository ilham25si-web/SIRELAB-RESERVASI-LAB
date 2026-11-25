<header>
    <strong><a href="{{ route('beranda') }}">Reservasi Laboratorium PCR</a></strong>

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