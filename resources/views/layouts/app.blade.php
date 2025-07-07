<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event 17 Agustus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- atau sesuaikan jika belum pakai Vite --}}
</head>
<body class="bg-gray-100 text-gray-800">

    @yield('content')

    {{-- Tambahkan baris ini untuk mengeksekusi script halaman --}}
    @yield('scripts')
</body>
</html>
