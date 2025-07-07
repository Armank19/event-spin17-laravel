<!-- resources/views/dashboard/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - 17an Event</title>
    @vite('resources/css/app.css') <!-- Pastikan Tailwind di-compile -->
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 text-white min-h-screen p-6">
            <h2 class="text-2xl font-bold mb-8">Dashboard</h2>
            <nav class="space-y-4">
                <a href="{{ route('dashboard.statistik') }}" class="block hover:underline">Statistik</a>
                <a href="{{ route('dashboard.spin') }}" class="block hover:underline">Spin</a>
                <a href="{{ route('dashboard.participant') }}" class="block hover:underline">Participant</a>
                
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
