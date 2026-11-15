<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login - Reservasi Laboratorium</title>
</head>
<body>
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.proses') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <button type="submit">Masuk</button>
    </form>
</body>
</html>