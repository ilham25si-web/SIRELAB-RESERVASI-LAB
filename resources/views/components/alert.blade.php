@if (session('sukses'))
    <div class="alert alert-sukses">{{ session('sukses') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif