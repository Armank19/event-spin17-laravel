@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 relative overflow-hidden"
     style="background-image: url('/images/bgspinjuga.jpg'); background-size: cover; background-position: center;">


    <!-- Konten utama -->
    <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">

        {{-- SPIN --}}
        <div class="bg-white p-6 rounded-2xl shadow-md border border-red-200">
            <h2 class="text-2xl font-bold text-red-700 mb-4">🎯 Spin Undian</h2>

            <div id="winner-display" class="text-center text-5xl font-black text-red-700 py-6 border-y border-dashed border-red-400 bg-red-100 rounded-xl mb-6 transition-all duration-300 scale-100">
                🎁 Tekan SPIN untuk memulai
            </div>

            <div class="flex justify-center">
                <button id="spinButton" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg text-lg font-bold transition-all">
                    🔄 SPIN
                </button>
            </div>

            <div class="mt-6 text-center">
                <label for="spinDuration" class="block mb-1 text-gray-700">Set Durasi Spin (detik)</label>
                <input type="number" id="spinDuration" value="3" min="1" class="w-24 mx-auto p-2 border rounded-lg text-center">
            </div>
        </div>

        {{-- HISTORY --}}
        <div class="bg-gray-100 p-6 rounded-2xl shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">🎁 Log Pemenang</h3>
            <div class="border rounded px-4 py-2 max-h-[300px] overflow-y-auto bg-white scrollbar-thin scrollbar-thumb-red-400 scrollbar-track-red-100" id="winnerLog">

                @forelse ($winners as $winner)
                    <div class="mb-2 text-gray-800">🎉 {{ $winner->nomor_undian }}</div>
                @empty
                    <div class="text-gray-500">Belum ada pemenang.</div>
                @endforelse
            </div>

            <form action="{{ route('spin.clear') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="bg-red-100 hover:bg-red-500 hover:text-white text-red-600 px-4 py-2 rounded w-full font-medium">
                    🗑️ Clear History
                </button>
            </form>
        </div>

    </div>
</div>
@endsection


@section('scripts')

@php
    $nomorSudahMenang = \App\Models\LogPemenang::pluck('nomor_undian')->toArray();
    $eligibleNomors = $nomorUndians->diff($nomorSudahMenang)->values();
@endphp

<script>
document.addEventListener("DOMContentLoaded", function () {
    const spinButton = document.getElementById("spinButton");
    const winnerDisplay = document.getElementById("winner-display");
    const timerInput = document.getElementById("spinDuration");

    // Ambil daftar nomor undian check-in dari backend
    const nomorUndians = @json($eligibleNomors);


    spinButton.addEventListener("click", function () {
        if (nomorUndians.length === 0) {
            winnerDisplay.textContent = "❌ Tidak ada peserta check-in!";
            return;
        }

        let timer = parseInt(timerInput.value) || 3;
        let duration = timer * 1000;
        let interval = 80;
        let spinInterval;

        // Animasi: acak dari nomor undian valid
        spinInterval = setInterval(() => {
            const randomIndex = Math.floor(Math.random() * nomorUndians.length);
            const fakeNomor = nomorUndians[randomIndex];
            winnerDisplay.textContent = `🎰 ${fakeNomor}`;
        }, interval);

        // Setelah durasi selesai, ambil pemenang asli dari backend
        setTimeout(() => {
            clearInterval(spinInterval);
            fetch("{{ route('spin.perform') }}")
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        winnerDisplay.textContent = `🎉 ${data.nomor_undian}`;
                        winnerDisplay.classList.add("animate-bounce", "text-green-600", "scale-110");
                        setTimeout(() => window.location.reload(), 7000);
                    } else {
                        winnerDisplay.textContent = "❌ Tidak ada peserta check-in.";
                        winnerDisplay.classList.remove("text-green-600");
                        winnerDisplay.classList.add("text-gray-500");
                    }
                })
                .catch(() => {
                    winnerDisplay.textContent = "⚠️ Nomor sudah menang.";
                });
        }, duration);
    });
});
</script>





@endsection


