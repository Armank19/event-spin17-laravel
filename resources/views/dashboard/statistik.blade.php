@extends('dashboard.layout')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold text-red-700 mb-6">📊 Statistik Peserta</h1>

  {{-- Grid 4 Statistik --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Total Peserta -->
    <div class="bg-white border border-red-200 rounded-2xl shadow p-6 text-center">
      <p class="text-gray-500 text-sm mb-1">Total Peserta</p>
      <h2 class="text-3xl font-bold text-red-600">{{ $totalPeserta }}</h2>
    </div>

    <!-- Sudah Check-in -->
    <div class="bg-white border border-green-200 rounded-2xl shadow p-6 text-center">
      <p class="text-gray-500 text-sm mb-1">Sudah Check-in</p>
      <h2 class="text-3xl font-bold text-green-600">{{ $belumCheckin }}</h2>
    </div>

    <!-- Belum Check-in -->
    <div class="bg-white border border-yellow-200 rounded-2xl shadow p-6 text-center">
      <p class="text-gray-500 text-sm mb-1">Belum Check-in</p>
      <h2 class="text-3xl font-bold text-yellow-500">{{ $totalCheckin }}</h2>
    </div>

    <!-- Persentase Kehadiran -->
    <div class="bg-white border border-blue-200 rounded-2xl shadow p-6 text-center">
      <p class="text-gray-500 text-sm mb-1">Persentase Kehadiran</p>
      <h2 class="text-3xl font-bold text-blue-600">{{ $persentase }}%</h2>
    </div>
  </div>

  {{-- Chart Diagram --}}
  <div class="bg-white border rounded-2xl shadow p-6 max-w-3xl mx-auto">
    <h2 class="text-lg font-semibold text-center text-blue-700 mb-4">📈 Diagram Kehadiran</h2>
    <div class="relative h-64 w-full">
      <canvas id="kehadiranChart"></canvas>
    </div>
  </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('kehadiranChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Sudah Check-in', 'Belum Check-in'],
      datasets: [{
        label: 'Kehadiran',
        data: [{{ $belumCheckin }}, {{ $totalCheckin }}],
        backgroundColor: ['#22c55e', '#facc15'], // hijau dan kuning
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
        }
      }
    }
  });
</script>
@endsection
