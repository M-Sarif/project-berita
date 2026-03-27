<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Website')</title>

    {{-- Style tambahan dari halaman --}}
    @yield('styles')

</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Konten utama --}}
    @yield('content')

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Script tambahan --}}
    @yield('scripts')

</body>
</html>
