@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-lg rounded-2xl p-6 mt-10 text-center border border-red-200">
    <h2 class="text-2xl font-bold text-red-700 mb-4">📸 Check-In Peserta</h2>
    <p class="text-gray-600 mb-4">Masukkan ID Karyawan atau scan QR Code</p>

    <!-- Form Manual -->
    <form method="POST" action="{{ route('checkin.submit') }}" class="space-y-4">
        @csrf
        @if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-center">
        {{ session('error') }}
    </div>
@endif

        <input type="text" name="id_karyawan" id="id_karyawan" placeholder="ID Karyawan"
            class="w-full px-4 py-2 border rounded-lg" required>

        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold">
            ✅ Check-In
        </button>
    </form>

    <!-- atau -->
    <div class="my-4 text-gray-500 font-medium">atau</div>

    <!-- Tombol Scan -->
    <button id="scanButton"
        class="w-full bg-white text-red-600 border border-red-500 hover:bg-red-50 py-2 rounded-lg font-semibold">
        📷 Scan QR Code
    </button>

    <!-- Container Scanner -->
    <div id="reader" class="mt-6 hidden"></div>
</div>

<!-- Script Scanner -->
<!-- Tambahkan ini di bawah tag div#reader -->
<div id="scan-result" class="mt-4 hidden">
    <p class="text-gray-700">QR ditemukan: <span id="qrText" class="font-bold text-green-700"></span></p>
    <button id="useResult" class="mt-2 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
        Gunakan QR Ini
    </button>
</div>

<!-- Script Scanner -->
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    let html5QrCode;
    let lastDecodedText = "";

    document.addEventListener('DOMContentLoaded', function () {
        const scanButton = document.getElementById('scanButton');
        const reader = document.getElementById('reader');
        const scanResult = document.getElementById('scan-result');
        const qrText = document.getElementById('qrText');
        const useResultBtn = document.getElementById('useResult');
        const inputKaryawan = document.getElementById('id_karyawan');

        scanButton.addEventListener('click', function () {
            reader.classList.remove('hidden');
            scanResult.classList.add('hidden');
            qrText.textContent = "";
            lastDecodedText = "";

            html5QrCode = new Html5Qrcode("reader");

            html5QrCode.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: 250 },
                (decodedText) => {
                    if (decodedText === lastDecodedText) return; // ignore repeated scan
                    lastDecodedText = decodedText;

                    qrText.textContent = decodedText;
                    scanResult.classList.remove('hidden');
                },
                (errorMessage) => {
                    // optional: console.log(errorMessage);
                }
            ).catch(err => {
                alert("Tidak bisa mengakses kamera. Periksa izin browser atau coba browser lain.");
                console.error(err);
            });
        });

        useResultBtn.addEventListener('click', function () {
            if (lastDecodedText) {
                inputKaryawan.value = lastDecodedText;
                html5QrCode.stop().then(() => {
                    document.getElementById('reader').classList.add('hidden');
                    scanResult.classList.add('hidden');
                }).catch(err => {
                    console.error("Gagal menghentikan kamera:", err);
                });
            }
        });
    });
</script>

@endsection
