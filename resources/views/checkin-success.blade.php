@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-10 text-center border border-red-200">
    <h2 class="text-2xl font-bold text-green-700 mb-4">✅ Check-In Berhasil!</h2>
    <p class="text-gray-700 mb-6">Kupon undian Anda telah aktif untuk event 17 Agustus:</p>

    <!-- Nomor Undian -->
    <div class="text-3xl font-extrabold text-red-600 tracking-wide border-y-4 border-dashed border-red-300 py-5 my-6 bg-red-50 rounded-lg">
        {{ $nomor_undian }}
    </div>

    <!-- Info Peserta -->
    <div class="text-left text-gray-700 text-base mt-4 space-y-2 bg-gray-50 p-4 rounded-lg">
        <p><strong>👤 Nama:</strong> {{ $nama }}</p>
        <p><strong>🆔 ID Karyawan:</strong> {{ $id_karyawan }}</p>
    </div>

    <div class="mt-8">
        <a href="{{ route('checkin') }}" class="inline-block px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
            ⬅️ Check-In Peserta Lain
        </a>
    </div>
</div>
@endsection
