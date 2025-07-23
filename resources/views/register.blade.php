<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Pendaftaran Event 17 Agustus 2025</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    #kuponModal {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>




</head>

<body class="relative min-h-screen flex items-center justify-center p-4 bg-cover bg-center" style="background-image: url('/images/bg17an.jpg');">

  <div class="absolute inset-0 bg-black bg-opacity-40 z-0"></div>

  <div class="relative z-10 w-full max-w-md bg-white p-6 rounded-2xl shadow-2xl border-2 border-red-200">
  

  <div class="w-full max-w-md bg-white p-6 rounded-2xl shadow-2xl border-2 border-red-200">
    <h1 class="text-3xl font-bold text-center text-red-700 mb-4">Pendaftaran Acara 17 Agustus 2025</h1>
    <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
        <input name="nama" type="text"  class="w-full px-3 py-2 border rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-red-400"
               oninput="this.value = this.value.toUpperCase()" required>
      </div>
      
      <div>
        <label class="block text-sm font-bold text-gray-700 mb-1">ID Karyawan</label>
        <input name="id_karyawan" type="number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" required>
      </div>

      <div>
        <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
        <input name="email" type="email" placeholder="xxx@gmail.com"class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" required>
      </div>

      <div>
        <label class="block text-sm font-bold text-gray-700 mb-1">No WhatsApp</label>
        <input name="no_wa" type="text" placeholder="08xxx" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" required>
      </div>

      <button type="submit" class="w-full bg-red-600 text-white font-semibold py-2 rounded-xl hover:bg-red-700 transition">
        Daftar Sekarang 🎉
      </button>
    </form>

    <p class="text-center text-xs mt-4 text-gray-500">Powered by Panitia Hanggar Event System</p>
  </div>

  


@if($errors->any())
  <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
    <ul class="list-disc pl-5">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


@php
    // Alias session value agar konsisten dengan showModal()
    if (session('registered_nama') && session('registered_id')) {
        session()->flash('nama', session('registered_nama'));
        session()->flash('id_karyawan', session('registered_id'));
    }
@endphp




@if (session('nama') && session('id_karyawan'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
      showModal("{{ session('nama') }}", "{{ session('id_karyawan') }}");
  });
</script>
@endif



<script>
    function showModal(nama, id) {
        document.getElementById('modalNama').innerText = nama;
        document.getElementById('modalID').innerText = id;
        document.getElementById('successModal').classList.remove('hidden');
        document.getElementById('successModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('successModal').classList.remove('flex');
        document.getElementById('successModal').classList.add('hidden');
    }

    
</script>


@if(session('kupon'))
<!-- Modal Kupon Undian -->
<div id="kuponModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md text-center relative">
        <h2 class="text-xl font-bold text-red-700 mb-4">🎟️ Kupon Undian Anda</h2>

        <!-- Nomor Undian Besar -->
        <div class="text-4xl font-bold text-red-600 tracking-widest mb-4 border-y-4 border-red-200 py-2">
            {{ session('kupon.nomor_undian') }}
        </div>

        <!-- QR Code -->
        <div class="my-4">
            {!! QrCode::size(150)->generate(session('kupon.id_karyawan')) !!}
        </div>

        <!-- Info Peserta -->
        <div class="text-left text-sm text-gray-700 mt-2 mb-4">
            <p><strong>Nama:</strong> {{ session('kupon.nama') }}</p>
            <p><strong>ID Karyawan:</strong> {{ session('kupon.id_karyawan') }}</p>
        </div>

        <!-- Tombol -->
        <button onclick="document.getElementById('kuponModal').remove()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded mt-2">Tutup</button>
    </div>
</div>
@endif






</body>
</html>


