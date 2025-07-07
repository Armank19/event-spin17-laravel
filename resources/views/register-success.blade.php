@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-10 text-center border border-red-200">
    <h2 class="text-2xl font-bold text-red-700 mb-4">🎉 Pendaftaran Berhasil!</h2>
    <p class="text-gray-700 mb-6">Berikut adalah kupon undian Anda untuk event 17 Agustus:</p>

    @if (!empty($nomor_undian))
    <div class="text-4xl font-extrabold text-red-600 tracking-wider border-y-4 border-dashed border-red-300 py-5 my-6 bg-red-50 rounded-lg">
        {{ $nomor_undian }}
    </div>
    @else
    <div class="text-red-600 font-semibold">Nomor undian belum tersedia.</div>
    @endif

    @if (!empty($id_karyawan))
    <div class="my-6 flex justify-center">
        {!! QrCode::size(150)->generate($id_karyawan) !!}
    </div>
    @endif

    <div class="text-left text-gray-700 text-base mt-4 space-y-2 bg-gray-50 p-4 rounded-lg">
        <p><strong>👤 Nama:</strong> {{ $nama ?? '-' }}</p>
        <p><strong>🆔 ID Karyawan:</strong> {{ $id_karyawan ?? '-' }}</p>
    </div>

    <div class="mt-8">
        <a href="{{ route('register.show') }}" class="inline-block px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
            ⬅️ Daftarkan Peserta Lain
        </a>
    </div>
</div>
@endsection
